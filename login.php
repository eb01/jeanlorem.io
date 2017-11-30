<?php

session_start();

// If user is already logged, redirect to admin panel
if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])) {
	header('Location: admin');
	exit;
};

// If the form is filled
if(!empty($_POST)) {
	
	// DB Connect
	require_once __DIR__.'/application/bdd_connection.php';
	
	// Query used for check the identification (username and password)
	$query = $pdo->prepare('SELECT * FROM users WHERE user_username = ?');

	// Give the username entered by user
	$query->execute(array($_POST['username']));

	// This returns false if username doesn't exist in DB
	$user = $query->fetch(PDO::FETCH_ASSOC);

	/* Compare the password entered by user and the password stocked in DB
	* Use of password_verify PHP function (encrypted with password_hash)
	*/
	$checkedPassword = password_verify($_POST['password'], $user['user_password']);

	// If user doesn't exist or password doesn't match, display error message
	if (!$user || !$checkedPassword) {
	    $errorLoginMessage = 'Mauvais identifiant ou mot de passe !';
	} 
	// Else, start a user session, prepare flashbag msg
	else {
	    session_start();
	    $_SESSION['user_ID'] = $user['user_ID'];
	    $_SESSION['username'] = $user['user_username']; 
	    $_SESSION['successLoginMessage'] = ", tu t'es bien connecté !";

	    // Query for update the user last login datetime in DB
	    $query = $pdo->prepare('UPDATE users SET user_dateLastLogin = NOW() WHERE user_ID = ?');

	    // Give the user_ID
	    $query->execute(array($_SESSION['user_ID']));

	    // Redirect to admin panel
	    header('Location: admin');
		exit;
	};
};

// Page details (for the head)
$title = "Se connecter | Jean Lorem";
$description = "Formulaire de connexion au panneau d'administration de Jean Lorem";

// Routing
$template = "login";
include 'layout.php';