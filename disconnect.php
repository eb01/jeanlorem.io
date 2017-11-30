<?php

session_start();

// Suppression des variables de session et de la session
$_SESSION = [];
session_destroy();

header('Location: login');
exit;