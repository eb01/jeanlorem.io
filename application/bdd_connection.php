<?php 

// DB config
$dsn = "mysql:host=localhost;dbname=";
$user = "";
$password = "";

// DB safe connection
try {
	$pdo = new PDO($dsn, $user, $password);
	// Characters type
	$pdo->exec("SET NAMES UTF8");
}
catch (PDOException $e) {
	echo $e->getMessage();
}