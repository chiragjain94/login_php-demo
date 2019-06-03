<?php
session_start();
echo 'Welcome ' . $_SESSION['username'] . ' to our website';

?>
<br />
<a href="index.php">Logout</a>