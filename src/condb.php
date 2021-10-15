<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "mydb";

try {
	$bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch(Exception $e) {
	die('Erreur : ' .$e->getMessage());
}

session_start();

?>