<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mydb";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql=("DROP TABLE IF EXISTS utilisateur ");
  $conn->exec($sql);

  $sql = "CREATE TABLE utilisateur(pseudo VARCHAR(50) NOT NULL ,nom VARCHAR(50),prenom VARCHAR(50),mail VARCHAR(50),motdepass VARCHAR(50) NOT NULL,date_naissance DATE,sexe VARCHAR(1),pays VARCHAR(50) NOT NULL, CP VARCHAR(50) NOT NULL,ville VARCHAR(50) NOT NULL,adresse VARCHAR(50) NOT NULL, photo_profil VARCHAR(50),date_inscription DATE NOT NULL,PRIMARY KEY(mail))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "1/8 Table utilisateur created </br>";

// ------------------------------------------

  $sql=("DROP TABLE IF EXISTS post ");
  $conn->exec($sql);

  $sql = "CREATE TABLE post(PK_post_id INT AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50), titre VARCHAR(50) NOT NULL, message VARCHAR(50) NOT NULL, ville VARCHAR(50), date_event DATE DEFAULT NULL, PRIMARY KEY(PK_post_id), FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "2/8 Table post created";

// ------------------------------------------

  $sql=("DROP TABLE IF EXISTS photo ");
  $conn->exec($sql);

  $sql = "CREATE TABLE photo(PK_photo_id INT AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50), titre VARCHAR(50) NOT NULL, FK_post_id INT, PRIMARY KEY(PK_photo_id), FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail), FOREIGN KEY(FK_post_id) REFERENCES post(PK_post_id))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "3/8 Table photo created";

  // ------------------------------------------

  $sql=("DROP TABLE IF EXISTS poster ");
  $conn->exec($sql);

  $sql = "CREATE TABLE Poster(FK_utilisateur_mail VARCHAR(50),FK_post_id INT,date_publication DATE NOT NULL,PRIMARY KEY(FK_utilisateur_mail, FK_post_id),FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail),FOREIGN KEY(FK_post_id) REFERENCES post(PK_post_id))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "4/8 Table poster created";

  // ------------------------------------------

  $sql=("DROP TABLE IF EXISTS follower ");
  $conn->exec($sql);

  $sql = "CREATE TABLE Follower(FK_utilisateur_mail_1 VARCHAR(50),FK_utilisateur_mail_2 VARCHAR(50),date_follow DATE NOT NULL,PRIMARY KEY(FK_utilisateur_mail_1, FK_utilisateur_mail_2),FOREIGN KEY(FK_utilisateur_mail_1) REFERENCES utilisateur(mail),FOREIGN KEY(FK_utilisateur_mail_2) REFERENCES utilisateur(mail))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "5/8 Table follower created";

  // ------------------------------------------

  $sql=("DROP TABLE IF EXISTS liker ");
  $conn->exec($sql);

  $sql = "CREATE TABLE Liker(id_like INT NOT NULL AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50), FK_post_id INT,date_like DATE NOT NULL,PRIMARY KEY(id_like),FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail),FOREIGN KEY(FK_post_id) REFERENCES post(PK_post_id))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "6/8 Table liker created";

  // ------------------------------------------

  $sql=("DROP TABLE IF EXISTS commenter ");
  $conn->exec($sql);

  $sql = "CREATE TABLE Commenter(id_commentaire INT NOT NULL AUTO_INCREMENT, FK_utilisateur_mail VARCHAR(50),FK_post_id INT,date_commentaire DATE NOT NULL,message_commentaire VARCHAR(200) NOT NULL,PRIMARY KEY(id_commentaire),FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail),FOREIGN KEY(FK_post_id) REFERENCES post(PK_post_id))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "7/8 Table commenter created";

  // ------------------------------------------

  $sql=("DROP TABLE IF EXISTS partager ");
  $conn->exec($sql);

  $sql = "CREATE TABLE Partager(FK_utilisateur_mail VARCHAR(50),FK_post_id INT,date_partage DATE NOT NULL,PRIMARY KEY(FK_utilisateur_mail, FK_post_id),FOREIGN KEY(FK_utilisateur_mail) REFERENCES utilisateur(mail),FOREIGN KEY(FK_post_id) REFERENCES post(PK_post_id))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "8/8 Table partager created";


} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;
?>