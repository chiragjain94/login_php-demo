<?php
require_once "classes/User.php";

if (isset($_POST["submit"])) {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  //Base condition to check if all the values are filled properly.
  $user = new User;

  if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
    if ($user->login($email, $password)) {
      header("location:index.php");
    } else {
      $message = "User not found";
      $messageCss = "d-block alert-danger";
    };
  } else {
    $message = "Enter valid email id";
    $messageCss = "d-block alert-danger";
  };
}

require_once "inc/header.php";
?>

<h2>Login</h2>
<h4 class="alert p-0 d-none <?php echo "$messageCss"; ?>"><?php echo "$message"; ?></h4>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" value="<?php echo isset($_POST['password']) ? $password : ''; ?>" required>
  </div>
  <input type="submit" name="submit" class="btn btn-success">
</form>
<a class="btn btn-info mt-3" href="register.php">New User, Register Now</a>
<?php require_once "inc/footer.php"; ?>