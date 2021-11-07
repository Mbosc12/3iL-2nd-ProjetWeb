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

		$sql = "CREATE TABLE utilisateur(pseudo VARCHAR(50) NOT NULL UNIQUE, nom VARCHAR(50), prenom VARCHAR(50), mail VARCHAR(50), mot_de_passe VARCHAR(50) NOT NULL, date_naissance DATE, photo_profil VARCHAR(50), date_inscription TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), PRIMARY KEY(mail))";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "1/4 Table \"utilisateur\" created </br>";

		// ------------------------------------------

		$sql = ("DROP TABLE IF EXISTS publication ");
		$conn->exec($sql);

		$sql = "CREATE TABLE publication(PK_post_id INT AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50), message VARCHAR(50) NOT NULL, photo VARCHAR(50) NOT NULL, PRIMARY KEY(PK_post_id), FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail) ON DELETE CASCADE)";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "2/4 Table \"publication\" created </br>";


		// ------------------------------------------

		$sql = ("DROP TABLE IF EXISTS suivre ");
		$conn->exec($sql);

		$sql = "CREATE TABLE suivre(FK_utilisateur_mail_1 VARCHAR(50), FK_utilisateur_mail_2 VARCHAR(50), date_follow TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), PRIMARY KEY(FK_utilisateur_mail_1, FK_utilisateur_mail_2), FOREIGN KEY(FK_utilisateur_mail_1) REFERENCES utilisateur(mail), FOREIGN KEY(FK_utilisateur_mail_2) REFERENCES utilisateur(mail) ON DELETE CASCADE)";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "3/4 Table \"suivre\" created </br>";

		// ------------------------------------------

		$sql = ("DROP TABLE IF EXISTS aimer ");
		$conn->exec($sql);

		$sql = "CREATE TABLE aimer(FK_utilisateur_mail VARCHAR(50), FK_post_id INT, date_like TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), PRIMARY KEY(FK_utilisateur_mail, FK_post_id),FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail) ON DELETE CASCADE, FOREIGN KEY(FK_post_id) REFERENCES publication(PK_post_id) ON DELETE CASCADE)";
		// use exec() because no results are returned
		$conn->exec($sql);
		echo "4/4 Table \"aimer\" created </br>";


		// - - - - - - - - - - - - - - - - - - - - - //
		/* Remplissage de la base de données */

		$sql = "INSERT INTO utilisateur(pseudo, nom, prenom, mail, mot_de_passe, date_naissance, photo_profil, date_inscription) VALUES 
        ('leo', 'Martin', 'Leo', 'leo@gmail.com', '123', DATE '1998-02-11', 'leo_2021-11-07-10-45-03.jpg', '2021-11-02'), 
		('julie', 'Leon', 'Julie', 'julie@gmail.com', '123', DATE '1993-08-05', 'julie_2021-11-07-10-49-50.jpeg', '2020-10-11'),
		('laura', 'Morin', 'Laura', 'laura@gmail.com', '123', DATE '1996-09-13', 'laura_2021-11-07-10-44-02.jpg', '2021-02-19'),
		('antonin', 'Aubry', 'Antonin', 'antonin@gmail.com', '123', DATE '2001-11-20', 'antonin_2021-11-07-10-42-49.jpg', '2021-10-11'),
		('jean', 'Lemaire', 'Jean', 'jean@gmail.com', '123', DATE '1993-08-05', 'jean_2021-11-07-10-47-02.jpg', '2021-10-11'),
		('sarah', 'Bouvier', 'Bouvier', 'sarah@gmail.com', '123', DATE '1992-01-31', 'sarah_2021-11-07-10-46-37.JPG', '2021-10-11'),
		('florent', 'Laurent', 'Florent', 'florent@gmail.com', '123', DATE '1999-02-02', 'florent_2021-11-07-11-08-39.JPG', '2021-10-11'), 
		('julien', 'Brun', 'Julien', 'julien@gmail.com', '123', DATE '1993-08-05', 'julien_2021-10-11-14-12-02.jpg', '2020-10-11'),
		('laurie', 'Aubert', 'Laurie', 'laurie@gmail.com', '123', DATE '1996-09-13', 'laurie_2021-11-07-10-47-29.jpg', '2021-02-19'),
		('clementine', 'Olivier', 'Clémentine', 'clementine@gmail.com', '123', DATE '1999-08-15', 'clementine_2021-11-07-11-06-07.jpg', '2018-03-15'),
		('antoine', 'Marchal', 'Antoine', 'antoine@gmail.com', '123', DATE '2001-11-20', 'antoine_2021-11-07-10-41-08.JPG', '2021-10-11'),
		('jeanne', 'Adam', 'Jeanne', 'jeanne@gmail.com', '123', DATE '1991-02-25', 'jeanne_2021-11-07-11-08-05.JPG', '2021-10-11'),
		('raph', 'Marie', 'Raph', 'raph@gmail.com', '123', DATE '2000-09-04', 'raph_2021-11-07-11-05-37.JPG', '2021-10-11'),
		('erwann', 'Caron', 'Erwann', 'erwann@gmail.com', '123', DATE '1988-06-22', 'erwann_2021-11-07-11-07-28.JPG', '2021-10-11'),
		('xavier', 'Mouly', 'Xavier', 'xavier@gmail.com', '123', DATE '1976-05-10', 'default_photo.jpeg', '2021-10-11'),
		('sylvain', 'Royer', 'Sylvain', 'sylvain@gmail.com', '123', DATE '1999-10-12', 'sylvain_2021-11-07-10-49-20.JPG', '2020-11-29')";

		// use exec() because no results are returned
		$conn->exec($sql);
		echo "Users created </br > ";

		$sql = "INSERT INTO suivre(FK_utilisateur_mail_1, FK_utilisateur_mail_2, date_follow) VALUES 
        ('julien@gmail.com', 'florent@gmail.com', '2021-11-03'), 
        ('jean@gmail.com', 'florent@gmail.com', '2021-11-02'), 
        ('sarah@gmail.com', 'florent@gmail.com', '2021-11-05'), 
        ('raph@gmail.com', 'florent@gmail.com', '2021-11-07'), 
        ('antonin@gmail.com', 'florent@gmail.com', '2021-11-07'), 
  		('julien@gmail.com', 'xavier@gmail.com', '2021-11-03'), 
        ('jean@gmail.com', 'xavier@gmail.com', '2021-11-02'), 
        ('sarah@gmail.com', 'xavier@gmail.com', '2021-11-05'), 
        ('raph@gmail.com', 'xavier@gmail.com', '2021-11-07'), 
        ('antonin@gmail.com', 'xavier@gmail.com', '2021-11-07'),
        ('erwann@gmail.com', 'xavier@gmail.com', '2021-11-03'), 
        ('sylvain@gmail.com', 'xavier@gmail.com', '2021-11-02'), 
        ('jeanne@gmail.com', 'xavier@gmail.com', '2021-11-05'), 
        ('antoine@gmail.com', 'xavier@gmail.com', '2021-11-07'), 
        ('clementine@gmail.com', 'xavier@gmail.com', '2021-11-07'),
        ('florent@gmail.com', 'xavier@gmail.com', '2021-11-07'),
	    ('laurie@gmail.com', 'xavier@gmail.com', '2021-11-07'),
        ('julie@gmail.com', 'xavier@gmail.com', '2021-11-03'), 
        ('leo@gmail.com', 'xavier@gmail.com', '2021-11-02'), 
        ('laura@gmail.com', 'xavier@gmail.com', '2021-11-07'),                                                                          
        ('julien@gmail.com', 'erwann@gmail.com', '2021-11-04'), 
        ('jean@gmail.com', 'erwann@gmail.com', '2021-11-03'), 
        ('sarah@gmail.com', 'erwann@gmail.com', '2021-11-07'), 
        ('raph@gmail.com', 'erwann@gmail.com', '2021-11-02'), 
        ('antonin@gmail.com', 'laura@gmail.com', '2021-11-04'), 
        ('jean@gmail.com', 'laura@gmail.com', '2021-11-03'), 
        ('sarah@gmail.com', 'laura@gmail.com', '2021-11-07'), 
        ('raph@gmail.com', 'laura@gmail.com', '2021-11-07'), 
    	('antonin@gmail.com', 'raph@gmail.com', '2021-11-03'), 
        ('jean@gmail.com', 'raph@gmail.com', '2021-11-02'), 
        ('sarah@gmail.com', 'raph@gmail.com', '2021-11-04'), 
        ('clementine@gmail.com', 'raph@gmail.com', '2021-11-02'),
        ('xavier@gmail.com', 'antonin@gmail.com', '2021-11-07'),
        ('xavier@gmail.com', 'erwann@gmail.com','2021-11-03'), 
        ('xavier@gmail.com', 'sylvain@gmail.com',  '2021-11-02'), 
        ('xavier@gmail.com', 'jeanne@gmail.com', '2021-11-05'), 
        ('xavier@gmail.com', 'antoine@gmail.com','2021-11-07'), 
        ('xavier@gmail.com', 'clementine@gmail.com','2021-11-07'),
	    ('xavier@gmail.com', 'laurie@gmail.com', '2021-11-07'),
        ('xavier@gmail.com', 'julie@gmail.com', '2021-11-03'), 
        ('xavier@gmail.com', 'leo@gmail.com','2021-11-02'),
        ('sylvain@gmail.com', 'julie@gmail.com', '2021-11-03')";

		// use exec() because no results are returned
		$conn->exec($sql);
		echo "Followers created </br > ";

		$sql = "INSERT INTO publication(PK_post_id, FK_utilisateur_mail, message, photo) VALUES 
        (212, 'florent@gmail.com', 'Nouvelle publication', 'florent_2021-11-07-11-31-11.jpeg'),
        (213, 'julien@gmail.com', '', 'julien_2021-11-07-11-36-12.JPEG'),
        (214, 'jean@gmail.com', 'Nouvelle publication', 'jean_2021-11-07-11-36-07.JPEG'),
        (215, 'sarah@gmail.com', '', 'sarah_2021-11-07-11-36-01.JPEG'),
        (216, 'antonin@gmail.com', 'Nouvelle publication', 'antonin_2021-11-07-11-36-30.JPEG'),
        (211, 'florent@gmail.com', '', 'florent_2021-11-07-11-36-26.JPEG'),
        (219, 'laura@gmail.com', 'Nouvelle publication', 'laura_2021-11-07-11-36-01.JPEG'),
        (202, 'raph@gmail.com', '', 'raph_2021-11-07-11-36-18.JPEG'),
        (221, 'sylvain@gmail.com', 'Nouvelle publication', 'sylvain_2021-11-07-11-36-26.JPEG'),
		(102, 'xavier@gmail.com', 'Hamburg', 'xavier_2021-11-07-14-10-48.jpg'),
		(103, 'xavier@gmail.com', 'Plages', 'xavier_2021-11-07-14-12-37.jpeg'),
		(104, 'xavier@gmail.com', 'Ponton', 'xavier_2021-11-07-14-13-30.jpeg'),
		(105, 'xavier@gmail.com', 'Festival', 'xavier_2021-11-07-14-14-31.jpeg')";

		// use exec() because no results are returned
		$conn->exec($sql);
		echo "Publications created </br > ";

		$sql = "INSERT INTO aimer(FK_utilisateur_mail, FK_post_id, date_like) VALUES
		('sarah@gmail.com', 212, '2021-11-07'),
        ('jean@gmail.com', 212, '2021-11-07'),
        ('antonin@gmail.com', 212, '2021-11-07'),
        ('raph@gmail.com', 212, '2021-11-07'),
		('sarah@gmail.com', 202, '2021-11-07'),
        ('jean@gmail.com', 202, '2021-11-07'),
        ('antonin@gmail.com', 202, '2021-11-07'),
		('sarah@gmail.com', 219, '2021-11-07'),
        ('jean@gmail.com', 219, '2021-11-07'),
        ('raph@gmail.com', 219, '2021-11-07'),
		('antonin@gmail.com', 102, '2021-11-07'),
		('sarah@gmail.com', 102, '2021-11-07'),
        ('jean@gmail.com', 102, '2021-11-07'),
        ('raph@gmail.com', 102, '2021-11-07'),
        ('florent@gmail.com', 102, '2021-11-07'),
	 	('antonin@gmail.com', 103, '2021-11-07'),
		('sarah@gmail.com', 103, '2021-11-07'),
        ('jean@gmail.com', 103, '2021-11-07'),
        ('raph@gmail.com', 104, '2021-11-07'),
		('sarah@gmail.com', 104, '2021-11-07'),
		('florent@gmail.com', 104, '2021-11-07'),
        ('jean@gmail.com', 104, '2021-11-07'),
        ('raph@gmail.com', 103, '2021-11-07'),
        ('clementine@gmail.com', 103, '2021-11-07')";

		// use exec() because no results are returned
		$conn->exec($sql);
		echo "Likes created </br > ";
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	$conn = null;
?>