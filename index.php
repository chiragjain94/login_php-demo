<?php
require_once "inc/loginlogic.php";
require_once "inc/header.php";
?>

<h2>Login</h2>
<h4 class="alert p-0 alert-danger <?php echo "$messageCss"; ?>"><?php echo "$message"; ?></h4>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
<a class="btn btn-info mt-3" href="register.php">New User, Register Now</a>
<?php require_once "inc/footer.php"; ?>