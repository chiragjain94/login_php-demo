<?php
require_once "classes/Database.php";

class User
{
  private $database;
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

    //Check if the entered value is available in database
    $count = $stmt->rowcount();

    if ($count > 0) {
      $user = $stmt->fetch();
      $_SESSION['username'] = $user['name'];
      return true;
    } else return false;
  }

  public function register($name, $email, $password)
  {
    $sql = 'INSERT INTO users(name, email, password) VALUES(?,?,?)';
    $stmt = $this->database->executeSql($sql, [$name, $email, $password]);
  }
}
