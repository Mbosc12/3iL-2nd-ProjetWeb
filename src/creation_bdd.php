<?php
	$host = "localhost";
	$user = "root";
	$password = "root";

	try {
		$conn = new PDO("mysql:host=$host", $user, $password);
		// check error
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE insta_db";
		// connexion
		$conn->exec($sql);
		echo "Base de donnée créée avec succès</br>";
	} catch (PDOException $e) {
		echo $sql . "</br>" . $e->getMessage();
	}

	$conn = null;
?>