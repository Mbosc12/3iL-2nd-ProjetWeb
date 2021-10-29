<?php
	$host = "localhost";
	$user = "root";
	$password = "root";
	$dbname = "insta_db";

	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = ("DROP TABLE IF EXISTS utilisateur ");
		$conn->exec($sql);

		$sql = "CREATE TABLE utilisateur(pseudo VARCHAR(50) NOT NULL ,nom VARCHAR(50),prenom VARCHAR(50),mail VARCHAR(50),mot_de_passe VARCHAR(50) NOT NULL,date_naissance DATE, photo_profil VARCHAR(50),date_inscription DATE NOT NULL,PRIMARY KEY(mail))";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "1/5 Table \"utilisateur\" created </br>";

		// ------------------------------------------

		$sql = ("DROP TABLE IF EXISTS publication ");
		$conn->exec($sql);

		$sql = "CREATE TABLE publication(PK_post_id INT AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50), message VARCHAR(50) NOT NULL, photo VARCHAR(50) NOT NULL, PRIMARY KEY(PK_post_id), FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail))";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "2/5 Table \"publication\" created </br>";


		// ------------------------------------------

		$sql = ("DROP TABLE IF EXISTS suivre ");
		$conn->exec($sql);

		$sql = "CREATE TABLE suivre(FK_utilisateur_mail_1 VARCHAR(50),FK_utilisateur_mail_2 VARCHAR(50),date_follow DATE NOT NULL,PRIMARY KEY(FK_utilisateur_mail_1, FK_utilisateur_mail_2),FOREIGN KEY(FK_utilisateur_mail_1) REFERENCES utilisateur(mail),FOREIGN KEY(FK_utilisateur_mail_2) REFERENCES utilisateur(mail))";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "3/5 Table \"suivre\" created </br>";

		// ------------------------------------------

		$sql = ("DROP TABLE IF EXISTS aimer ");
		$conn->exec($sql);

		$sql = "CREATE TABLE aimer(id_like INT NOT NULL AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50), FK_post_id INT,date_like DATE NOT NULL,PRIMARY KEY(id_like),FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail),FOREIGN KEY(FK_post_id) REFERENCES publication(PK_post_id))";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "4/5 Table \"aimer\" created </br>";

		// ------------------------------------------

		$sql = ("DROP TABLE IF EXISTS commenter ");
		$conn->exec($sql);

		$sql = "CREATE TABLE commenter(id_commentaire INT NOT NULL AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50),FK_post_id INT,date_commentaire DATE NOT NULL,message_commentaire VARCHAR(200) NOT NULL,PRIMARY KEY(id_commentaire),FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail),FOREIGN KEY(FK_post_id) REFERENCES publication(PK_post_id))";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "5/5 Table \"commenter\" created </br>";


	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	$conn = null;
?>