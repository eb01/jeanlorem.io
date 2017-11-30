<?php

session_start();

// If user is logged
if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])) {

    // DB Connect
	require_once __DIR__.'/application/bdd_connection.php';

	// Query used for retrieve all the jokes and their respectives usernames
	$query = $pdo->prepare
	(
		'SELECT
			joke_ID,
			joke_content,
			joke_audience,
			joke_tagType,
			joke_dateCreation,
			joke_dateLastEdit,
			user_username
		 FROM 
		 	jokes
		 INNER JOIN users
		 ON jokes.user_ID = users.user_ID
		 ORDER BY joke_ID
		'
	);

	$query->execute();

	$jokes = $query->fetchAll(PDO::FETCH_ASSOC);

	// Page details (for the head)
	$title = "Admin | Jean Lorem";
	$description = "Panneau d'administration de Jean Lorem";

	// Routing
	$template = "admin";
	include 'layout.php';

// Else, redirect to homepage
} else {
	header('Location: /');
	exit;
};