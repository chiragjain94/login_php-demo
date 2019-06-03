<?php
session_start();
unset($_SESSION["username"]);
header("location:index.php");
// session_unset();
// echo $_SESSION['username'];
