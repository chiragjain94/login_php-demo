<?php
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
        header("location:index.php");
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
