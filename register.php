<?php
require_once "config/config.php";
require_once "classes/User.php";

$message = "";
$messageCss = "d-none";

if (isset($_POST["submit"])) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $password2 = htmlspecialchars($_POST['password2']);

  if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $user = new User;
    if (!$user->CheckIfEmailIdExists($email)) {
      if ($password == $password2) {
        $passwordEncrypt = md5($email . $password);
        $user->register($name, $email, $passwordEncrypt);
        $message = "User Added";
        $messageCss = "d-block alert-success";
        $name = $email = $password = $password2 = "";
      } else {
        $message = "Password doesn't match";
        $messageCss = "d-block alert-danger";
      }
    } else {
      $message = "User already exists";
      $messageCss = "d-block alert-danger";
    }
  }
}


?>

<?php require_once "inc/header.php"; ?>

<h2>Register</h2>
<h4 class="alert p-0 <?php echo "$messageCss"; ?>"><?php echo "$message"; ?></h4>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>" required>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" value="<?php echo isset($_POST['password']) ? $password : ''; ?>" required>
  </div>
  <div class="form-group">
    <label>Re-enter Password</label>
    <input type="password" class="form-control" name="password2" value="<?php echo isset($_POST['password2']) ? $password2 : ''; ?>" required>
  </div>
  <input type="submit" name="submit" class="btn btn-success">
</form>
<?php require_once "inc/footer.php"; ?>