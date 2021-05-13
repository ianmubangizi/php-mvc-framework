<?php

namespace Mubangizi\Core;

use Mubangizi\Core\Exception\HttpException;
use \PDO;

class Database
{

  public PDO $db;

  public function __construct(array $config)
  {
    try {
      $dsn = $config['DATABASE_DSN'] ?? '';
      $this->db = new PDO($dsn);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->apply_migrations();
    } catch (\PDOException $error) {
      Application::log("Error:[PDOException] - Message:[{$error->getMessage()}] Location:[{$error->getFile()}:{$error->getLine()}]");
      throw new HttpException('Could not connect to Database', 500);
    }
  }

  public function apply_migrations()
  {
    $this->create_migrations_table();
    $migration_folder = Application::$ROOT_DIR . '/migrations';
    $migration_files = scandir($migration_folder);
    $applied_migrations = $this->get_applied_migrations();
    $migrations = array_diff($migration_files, $applied_migrations, ['.', '..']);

    foreach ($migrations as $migration_file) {
      require_once "$migration_folder/$migration_file";
      $migration_name = pathinfo($migration_file, PATHINFO_FILENAME);
      $new_migrations[] = $migration_file;
      $migration = new $migration_name($this->db);
      Application::log("Applying $migration_name migration.");
      $migration->up();
      Application::log("Applied $migration_name migration.");
    }

    if (!empty($new_migrations)) {
      $this->save_migrations($new_migrations);
      $count = count($new_migrations);
      $text = $count > 1 ? 's' : '';
      Application::log("Applied [$count] migration$text");
    } else {
      Application::log('All migrations are applied');
    }
  }

  public function create_migrations_table()
  {
    $this->db->exec("CREATE TABLE IF NOT EXISTS migrations (
      id INT(10) AUTO_INCREMENT PRIMARY KEY,
      migration VARCHAR(255),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );");
  }

  public function get_applied_migrations()
  {
    $statement = $this->db->prepare("SELECT migration FROM migrations");
    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_COLUMN);
  }

  public function save_migrations(array $migrations)
  {
    $migrations = array_map(fn ($migration) => "('$migration')", $migrations);
    $migrations = implode(',', $migrations);
    $statement = $this->db->prepare("INSERT INTO migrations (migration) VALUES $migrations;");
    return $statement->execute();
  }
}
