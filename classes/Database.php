<?php
require_once ROOT_URL . '/config/config.php';
class Database
{
  private static $instance;
  private static $pdo;

  public static function initializeDatabase()
  {
    if (!isset(self::$instance)) {
      self::$instance = new Database();
      self::$instance->initPDO();
    }
    return self::$instance;
  }

  private function initPDO()
  {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    self::$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
  }

  public function executeSql($sql, array $params)
  {
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }
}
