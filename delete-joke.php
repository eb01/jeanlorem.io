<?php

session_start();

if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])) {

	// DB Connect
	require_once __DIR__.'/application/bdd_connection.php';

	// If $_GET has a value, , we retrieve all the jokes IDs for check if $_GET value exists in DB
	if(!empty($_GET["joke_ID"])) {
		// Query for retrieve all the jokes IDs
		$query = $pdo->prepare
		(
			'SELECT
				joke_ID
			 FROM jokes'
		);

		$query->execute();

		$jokes = $query->fetchAll(PDO::FETCH_COLUMN, 0);

		// We check if the joke exists in DB before query process
		if(in_array($_GET["joke_ID"], $jokes)) {

			// Query for delete THE joke
			$query = $pdo->prepare
			(
				'DELETE FROM jokes
				 WHERE joke_ID = ?'
			);	 

			$query->execute(array($_GET["joke_ID"]));

			// Prepare flashbag success message and redirect to admin panel
			$_SESSION['successDeleteJokeMessage'] = "Blague/citation correctement supprimée";
			header("Location: admin");
			exit;
		};
	}

	//Else redirect to admin panel
	else {
		header("Location: admin");
		exit;
	};

// Else, redirect to homepage
} else {
	header('Location: /');
	exit;
};

// No routing because this is a "trigger page"

?>