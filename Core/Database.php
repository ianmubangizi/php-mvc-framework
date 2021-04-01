<?php

namespace Mubangizi\Core;

use \PDO;

class Database {
  
  public PDO $_pdo;
  
  public function __construct(array $config){
    $dsn = $config['DATABASE_DSN'] ?? '';
    $this->_pdo = new PDO($dsn);
    $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}