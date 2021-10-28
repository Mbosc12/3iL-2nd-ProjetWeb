<?php

	require_once('Conf.php');

	class Model
	{

		public static $pdo;

		public static function init_pdo ()
		{
			$host = Conf::getHostname();
			$dbname = Conf::getDatabase();
			$login = Conf::getLogin();
			$pass = Conf::getPassword();
			try {
				// connexion à la base de données
				// le dernier argument sert à ce que toutes les chaines de charactères
				// en entrée et sortie de MySql soit dans le codage UTF-8
				self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				// on active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $ex) {
				echo $ex->getMessage();
				die("Problème lors de la connexion à la base de données.");
			}
		}

		public static function selectUserByUsername ($userSearch)
		{
			try {
				$sql = "SELECT utilisateur.pseudo, utilisateur.photo_profil FROM utilisateur WHERE utilisateur.pseudo LIKE '$userSearch%'";
				$values = array(':pseudo_tag' => $userSearch);
				$rep = Model::$pdo->query($sql);
				$rep->execute($values);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Erreur lors de la recherche dans la base de données.");
			}
		}

		public static function selectUser ($username)
		{
			try {
				$sql = "SELECT pseudo, nom, prenom, photo_profil FROM utilisateur WHERE utilisateur.pseudo ='$username'";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function selectUserByMail ($mail)
		{
			try {
				$sql = "SELECT pseudo, photo_profil FROM utilisateur WHERE utilisateur.mail ='$mail'";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function followUser ($userEmail1, $userEmail2)
		{
			try {
				$sql = "INSERT INTO suivre(FK_utilisateur_mail_1, FK_utilisateur_mail_2) VALUES (:user1_mail_tag, :user2_mail_tag)";
				$values = array(':user1_mail_tag' => $userEmail1, ':user2_mail_tag' => $userEmail2);
				$rep_prep = Model::$pdo->prepare($sql);
				$rep_prep->execute($values);
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Erreur lors de la création de la ligne dans la base de données");
			}
		}

		public static function unfollowUser ($userEmail1, $userEmail2)
		{
			try {
				$sql = "DELETE FROM suivre WHERE FK_utilisateur_mail_1 = :user1_mail_tag AND FK_utilisateur_mail_2K = :user2_mail_tag";
				$values = array(':user1_mail_tag' => $userEmail1, ':user2_mail_tag' => $userEmail2);
				$rep_prep = Model::$pdo->prepare($sql);
				$rep_prep->execute($values);
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Erreur lors de la suppression de la ligne dans la base de données");
			}
		}

		public static function getPostsFollowed ($username)
		{
			try {
				$sql = "SELECT FK_post_id FROM publication pub
            INNER JOIN (SELECT FK_post_id FROM publier P
                INNER JOIN(
                    SELECT FK_utilisateur_mail_2 FROM suivre WHERE FK_utilisateur_mail_1 IN (SELECT 
                    utilisateur.mail FROM utilisateur WHERE pseudo = '$username')
                ) s ON s.FK_utilisateur_mail_2 = P.FK_utilisateur_mail
            ) p ON p.FK_post_id = pub.PK_post_id";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function getAllFollowers ($username)
		{
			try {
				$sql = "SELECT pseudo, photo_profil FROM utilisateur U
                    INNER JOIN(
                    SELECT FK_utilisateur_mail_2 FROM suivre WHERE FK_utilisateur_mail_1 IN (SELECT
                    utilisateur.mail FROM utilisateur WHERE pseudo = '$username'))S ON U.mail = S.FK_utilisateur_mail_2";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function getPost ($id)
		{
			try {
				$sql = "SELECT * FROM publication WHERE PK_post_id=$id";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Publication introuvable");
			}
		}

		public static function getAllPosts ($userEmail)
		{
			try {
				$sql = "SELECT * FROM publication WHERE FK_utilisateur_mail=$userEmail";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				die("Aucune publication");
			}
		}

		// PARTIE LIKES ----------------------------------------------------------------------------------------------------

		public static function getLikes ($id)
		{
			try {
				$sql = "SELECT COUNT(*) FROM `aimer` WHERE FK_post_id = $id";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_NUM);
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Publication introuvable");
			}
		}

		public static function setLike ($mail, $id)
		{
			try {
				$date = date('Y-m-d');

				$sql = "INSERT INTO liker(FK_utilisateur_mail, FK_post_id, date_like) VALUES (:mail, :ud, :date)";
				$values = array(':mail' => $mail, ':id' => $id, ':date' => $date);
				$rep_prep = Model::$pdo->prepare($sql);
				$rep_prep->execute($values);
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Impossible de liker");
			}
		}

		// PARTIE PASSWORD --------------------------------------------------------------------------------------------------

		public static function setPassword ($mail, $password)
		{
			try {
				$date = date('Y-m-d');

				$sql = "UPDATE `utilisateur` SET `mot_de_passe`=:password WHERE mail = :mail";
				$values = array(':mail' => $mail, ':password' => $password);
				$rep_prep = Model::$pdo->prepare($sql);
				$rep_prep->execute($values);
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}
	}

	// on initialise la connexion $pdo
	Model::init_pdo();

?>
