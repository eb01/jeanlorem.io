<?php

session_start();

// Page details (for the head)
$title = "The Story | Jean Lorem";
$description = "L'histoire de Jean Lorem. Jean Lorem, c'est quoi ? Pour qui ?  Pourquoi ? Les réponses sont sur cette page !";

// Routing
$template = "story";
include 'layout.php';