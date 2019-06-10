<?php
require_once "Database.php";

class User
{
  private $database;
  protected static $user = null;

  public function __construct()
  {
    $this->database = Database::initializeDatabase();
  }

  public function checkIfEmailIdExists($email)
  {
    $sql = 'SELECT * FROM users WHERE email = ?';
    $stmt = $this->database->executeSql($sql, [$email]);
    return $stmt->rowcount();
  }

  public function login($email, $password)
  {
    $sql = 'SELECT * FROM users WHERE email = ? && password = ?';
    $stmt = $this->database->executeSql($sql, [$email, $password]);

    $count = $stmt->rowcount();
    if ($count > 0) {
      $user = $stmt->fetch();
      return $user['email'];
    } else return false;
  }

  public function register($name, $email, $password)
  {
    $sql = 'INSERT INTO users(name, email, password) VALUES(?,?,?)';
    $stmt = $this->database->executeSql($sql, [$name, $email, $password]);
  }

  public function getUser()
  {
    if (!isset($_SESSION['email'])) {
      throw new Exception("User not logged in.");
    }

    if (isset(self::$user)) {
      return self::$user;
    }

    $sql = 'SELECT * FROM users WHERE email = ?';
    $stmt = $this->database->executeSql($sql, [$_SESSION['email']]);

    $count = $stmt->rowcount();
    if ($count > 0) {
      self::$user = $stmt->fetch();
      return self::$user;
    }
    throw new Exception("User not found.");
  }
}
