<?php

session_start();

// If user is logged
if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])) {

	// If the form is filled
	if(!empty($_POST)) {
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

		// Form data treatments on selected options and characters length range
		if(	($jokeTagType === "paragraph" || $jokeTagType === "header") && 
		($jokeAudience === "all" || $jokeAudience === "adult") &&
		strlen($jokeContent) >= $charMinLength && strlen($jokeContent) <= $charMaxLength) {

			// DB Connect
			require_once __DIR__.'/application/bdd_connection.php';

			// Query for insert a new joke in DB
			$query = $pdo->prepare
			(
				'INSERT INTO
					jokes(
						joke_content,
						joke_audience,
						joke_tagType,
						joke_dateCreation,
						user_ID
					)

				 VALUES(
				   	?,
			  		?,
			  		?,
			  		NOW(),
			  		?
			  	 )
				'
			);

			$query->execute(array($jokeContent, $jokeAudience, $jokeTagType, $_SESSION["user_ID"]));

			// Prepare flashbag success message and redirect to admin panel
			$_SESSION["successAddJokeMessage"] = "Blague/Citation ajoutée avec succès";
			header('Location: admin');
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
$title = "Ajouter une blague/citation | Jean Lorem";
$description = "Formulaire d'ajout d'une blague ou d'une citation";

// Routing
$template = "add-joke";
include 'layout.php';