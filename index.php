<?php
require_once "config/db.php";
$message = "";
$messageCss = "d-none";

if (isset($_POST["submit"])) {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  //Base conditions to first check for null values and show appropriate validation.
  if (empty($email)) {
    $message = "Enter email id<br>";
    $messageCss = "d-block";
  }
  if (empty($password)) {
    $message .= "Enter password<br>";
    $messageCss = "d-block";
  }

  if (!empty($email) && (!empty($password))) {
    if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
      $sql = 'SELECT * FROM users WHERE email = ? && password = ?';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$email, $password]);

      //Check if the entered value is available in database
      $count = $stmt->rowcount();

      if ($count > 0) {
        session_start();
        $user = $stmt->fetch();
        //Store the username in session to echo it on next page.
        $_SESSION['username'] = $user['name'];
        header("location:success.php");
      } else {
        $message = "User not found. Enter correct details";
        $messageCss = "d-block";
      }
    } else {
      $message = "Incorrect email id";
      $messageCss = "d-block";
    }
  }
}
?>

<?php require_once "inc/header.php"; ?>

<a href="">Home</a>
<h2>Login</h2>
<h4 class="alert p-0 alert-danger <?php echo "$messageCss"; ?>"><?php echo "$message"; ?></h4>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- <div class=" form-group">
                <label>Name</label>
                <input type="text" class="form-control">
              </div> -->
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