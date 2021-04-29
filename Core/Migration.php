<?php 

namespace Mubangizi\Core;

abstract class Migration{

    protected \PDO $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public abstract function up();
    public abstract function down();
}