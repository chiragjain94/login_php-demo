<?php
require_once "inc/loginlogic.php";
require_once "inc/header.php";
?>

<?php
session_start();
echo 'Welcome ' . $_SESSION['username'] . ' to our website';

?>
<br />
<a href="index.php">Logout</a>

<?php require_once "inc/footer.php"; ?>