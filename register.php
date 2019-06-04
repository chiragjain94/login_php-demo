<?php
require_once "config/db.php";
require_once "classes/Database.php";

$message = "";
$messageCss = "d-none";

if (isset($_POST["submit"])) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $password2 = htmlspecialchars($_POST['password2']);

  //Base conditions to first check for null values and show appropriate validation.
  if (empty($name)) {
    $message = "Enter name<br>";
    $messageCss = "d-block alert-danger";
  }
  if (empty($email)) {
    $message .= "Enter email id<br>";
    $messageCss = "d-block alert-danger";
  }
  if (empty($password) || empty($password2)) {
    $message .= "Enter password <br>";
    $messageCss = "d-block alert-danger";
  }

  if (!empty($name) && (!empty($email)) && (!empty($password)) && (!empty($password2))) {
    if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
      if (!CheckIfEmailIdExists($email, $pdo)) {
        if ($password == $password2) {
          $passwordEncrypt = md5($email . $password);
          $sql = 'INSERT INTO users(name, email, password) VALUES(?,?,?)';
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$name, $email, $passwordEncrypt]);
          $message = "User Added";
          $messageCss = "d-block alert-success";
        } else {
          $message = "Passwords don't match.";
          $messageCss = "d-block alert-danger";
        }
      } else {
        $message = "The email id exists";
        $messageCss = "d-block alert-danger";
      }
    } else {
      $message = "Enter valid email addresss";
      $messageCss = "d-block alert-danger";
    }
  }
}

function CheckIfEmailIdExists($email)
{
  $sql = 'SELECT * FROM users WHERE email = ?';
  $database = Database::initializeDatabase();
  $stmt = $database->executeSql($sql, [$email]);
  return $stmt->rowcount();
}
?>

<?php require_once "inc/header.php"; ?>

<h2>Register</h2>
<h4 class="alert p-0 <?php echo "$messageCss"; ?>"><?php echo "$message"; ?></h4>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" value="<?php echo isset($_POST['password']) ? $password : ''; ?>">
  </div>
  <div class="form-group">
    <label>Re-enter Password</label>
    <input type="password" class="form-control" name="password2" value="<?php echo isset($_POST['password2']) ? $password2 : ''; ?>">
  </div>
  <input type="submit" name="submit" class="btn btn-success">
</form>
<?php require_once "inc/footer.php"; ?>