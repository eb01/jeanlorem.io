<?php

session_start();

// If user is logged
if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])) {

	// DB Connect
	require_once __DIR__.'/application/bdd_connection.php';

	// ***CASE 1*** : If the form is empty, first we retrieve all the jokes IDs for check if $_GET value exists in DB
	if(empty($_POST)) {

		// Query for retrieve all the jokes IDs
		$query = $pdo->prepare
		(
			'SELECT
				joke_ID
			 FROM jokes'
		);

		$query->execute();

		$jokes = $query->fetchAll(PDO::FETCH_COLUMN, 0);
	
		// We check if the joke exists in DB before query process. In the view, we will pre-filled the inputs with these datas.
		if(in_array($_GET["joke_ID"], $jokes)) {

			// Query for retrieve THE joke
			$query = $pdo->prepare
			(
				'SELECT 
					joke_content, 
					joke_audience,
					joke_tagType 
				 FROM jokes
				 WHERE joke_ID = ?'
			);

			$query->execute(array($_GET["joke_ID"]));

			// This returns false if joke doesn't exist in DB
			$joke = $query->fetch(PDO::FETCH_ASSOC);

		// Else, redirect to admin panel
		} else {
			header('Location: admin');
			exit;
		};
	}

	// ***CASE 2*** : Else, this is the case where the form is filled so we update the DB (after form data treatments)
	else {

		// For more lisibility 
		$jokeTagType = $_POST["joke-tagtype"];
		$jokeAudience = $_POST["joke-audience"];
		$jokeContent = $_POST["joke-content"];

		// Prepare form data treatment on characters length range
		switch ($jokeTagType) {
			case 'paragraph':
			$charMinLength = 101;
			$charMaxLength = 700;
			break;
			case 'header':
			$charMinLength = 8;
			$charMaxLength = 100;
			break;
		};

		// First query : we retrieve all the jokes IDs for check if $_POST value exists in DB
		// Query for retrieve all the jokes IDs
		$query = $pdo->prepare
		(
			'SELECT
				joke_ID
			 FROM jokes'
		);

		$query->execute();

		$jokes = $query->fetchAll(PDO::FETCH_COLUMN, 0);

		// We check if the joke exists in DB + Form data treatments on selected options and characters length range
		// *Info* : here $_POST["joke-id"] returns the value of an input hidden which returns the $_GET["joke_ID"] value
		if(in_array($_POST["joke-ID"], $jokes) &&	
		($jokeTagType === "paragraph" || $jokeTagType === "header") && 
		($jokeAudience === "all" || $jokeAudience === "adult") &&
		strlen($jokeContent) >= $charMinLength && strlen($jokeContent) <= $charMaxLength) {
		
			// Query for update THE joke in DB
			$query = $pdo->prepare
			(
				'UPDATE 
					jokes
				 SET joke_content = ?,
					 joke_audience = ?,
					 joke_tagType = ?,
					 joke_dateLastEdit = NOW()
				 WHERE joke_ID = ?
				'		
			);

			$query->execute(array($jokeContent, $jokeAudience, $jokeTagType, $_POST["joke-ID"]));

			// Prepare flashbag success message and redirect to admin panel
			$_SESSION["successEditJokeMessage"] = "Blague/Citation éditée avec succès";
			header("Location: admin");
			exit;
		} 
		// Else, user data is incorrect, so display error message
		else {
			$errorAddEditJokeMessage = "Merci de renseigner correctement le formulaire";
		};
	};

// Else, redirect to homepage
} else {
	header('Location: /');
	exit;
};

// Page details (for the head)
$title = "Éditer une blague/citation | Jean Lorem";
$description = "Formulaire d'édition d'une blague ou d'une citation";

// Routing
$template = 'edit-joke';
include 'layout.php';