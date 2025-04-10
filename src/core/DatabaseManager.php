<?php

namespace ShuffleLunchService;

use PDO;
use PDOException;

class DatabaseManager
{
  protected $pdo;

  public function dbConnect($params)
  {
    try {
      $pdo = new PDO('mysql:host=' . $params['hostname'] . ';dbname=' . $params['database'] .  ';
      charset=utf8mb4', $params['username'], $params['password']);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $this->pdo = $pdo;
    } catch (PDOException $e) {
      error_log('Error: fail to databaseAccess') . PHP_EOL;
      error_log($e->getMessage());
    }
  }
}
