<?php
require_once "../init.php";

unset($_SESSION["email"]);
header("location:/login/page/login.php");
