<?php
require_once "init.php";

echo $twig->render('index.twig', array('heading' => 'Home Page'));
