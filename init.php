<?php
session_start();
require_once "config/config.php";
require_once "vendor/autoload.php";
require_once "classes/View.php";
require_once "classes/User.php";

View::initializeTwig();
$twig = View::getTwig();

if (isset($_SESSION['email'])) {
  $user = new User;
  $userDetails = $user->getUser();
  $isLoggedIn = true;
  $twig->addGlobal("isLoggedIn", $isLoggedIn);
  $twig->addGlobal("userDetails", $userDetails);
}
