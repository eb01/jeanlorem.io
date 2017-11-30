<?php

session_start();

// DB Connect
require_once __DIR__.'/application/bdd_connection.php';

// Query returning jokes
$query = $pdo->prepare
(
	'SELECT
		joke_content,
		joke_audience,
		joke_tagType
	 FROM 
	 	jokes
	'
);

$query->execute();

$jokes = $query->fetchAll(PDO::FETCH_ASSOC);

// Encode all jokes in json for manage them with JS
$jokesJson = fopen('jokes.json', 'w');
fwrite($jokesJson, json_encode($jokes));
fclose($jokesJson);

// Page details (for the head)
$title = "Générateur de Lorem Ipsum (ou faux-texte) | Jean Lorem";
$description = "Un générateur de Lorem Ipsum (ou faux-texte) pas comme les autres. Jean Lorem met à disposition du lorem au langage fleuri. Du faux-texte humoristique en langue française pour changer du texte latin.";

// Routing
$template = "index";
include 'layout.php';