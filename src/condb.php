<?php

$host = "localhost";
$user = "root";
$password = "root";
$dbname = "insta_db";

try {
	$bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch(Exception $e) {
	die('Erreur : ' .$e->getMessage());
}

session_start();

?>