 <?php
	require_once "config.php";

	// Set DSN
	$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
	// Create a PDO instance
	$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

	// echo $dsn;
