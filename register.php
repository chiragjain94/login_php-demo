<?php
include_once "config/db.php";
$message = "";
$messageCss = "d-none";

if (isset($_POST["submit"])) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  //Base conditions to first check for null values and show appropriate validation.
  if (empty($name)) {
    $message = "Enter name<br>";
    $messageCss = "d-block";
  }
  if (empty($email)) {
    $message .= "Enter email id<br>";
    $messageCss = "d-block";
  }
  if (empty($password)) {
    $message .= "Enter password <br>";
    $messageCss = "d-block";
  }

  if (!empty($name) && (!empty($email)) && (!empty($password))) {
    if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
      $sql = 'INSERT INTO users(name, email, password) VALUES(?,?,?)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$name, $email, $password]);
      echo 'User Added';
    } else echo "Enter correct email addresss";
  }
}
?>

<?php require_once "inc/header.php"; ?>

<h2>Register</h2>
<h4 class="alert p-0 alert-danger <?php echo "$messageCss"; ?>"><?php echo "$message"; ?></h4>

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
    <input type="text" class="form-control" name="password" value="<?php echo isset($_POST['password']) ? $password : ''; ?>">
  </div>
  <input type="submit" name="submit" class="btn btn-success">
</form>
<?php require_once "inc/footer.php"; ?>