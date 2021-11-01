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

		public static function followUser ($userEmail1, $username_2)
		{
			try {
				$sql = "SET @user2_mail = (SELECT mail FROM utilisateur WHERE utilisateur.pseudo ='$username_2');
						INSERT INTO suivre(FK_utilisateur_mail_1, FK_utilisateur_mail_2) VALUES (:user1_mail_tag, @user2_mail)";
				$values = array(':user1_mail_tag' => $userEmail1);
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
				$sql = "SELECT PK_post_id FROM publication pub
				INNER JOIN(
					SELECT FK_utilisateur_mail_2 FROM suivre WHERE FK_utilisateur_mail_1 IN (SELECT 
					utilisateur.mail FROM utilisateur WHERE pseudo = '$username')
				) p ON p.FK_utilisateur_mail_2 = pub.FK_utilisateur_mail";
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

		public static function getCountFollowers ($username)
		{
			try {
				$sql = "SELECT COUNT(*) as countFollowers FROM suivre WHERE FK_utilisateur_mail_2 IN (SELECT
                    utilisateur.mail FROM utilisateur WHERE pseudo = '$username')";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function getCountSubscriptions ($username)
		{
			try {
				$sql = "SELECT COUNT(*) as countSubscriptions FROM suivre WHERE FK_utilisateur_mail_1 IN (SELECT
                    utilisateur.mail FROM utilisateur WHERE pseudo = '$username')";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function getIsSubscribed ($user_mail_1, $username_2)
		{
			try {
				$sql = "SELECT COUNT(*) as isSubscribed FROM suivre WHERE FK_utilisateur_mail_1 = '$user_mail_1' AND FK_utilisateur_mail_2 
        			IN (SELECT utilisateur.mail FROM utilisateur WHERE pseudo = '$username_2')";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_CLASS, 'Model');
				return $rep->fetchAll();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("\nErreur lors de la requête vers la base de données");
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

		public static function getAllPosts ($username)
		{
			try {
				$sql = "SELECT * FROM publication pub INNER JOIN( SELECT mail FROM utilisateur WHERE mail IN 
						(SELECT utilisateur.mail FROM utilisateur WHERE pseudo = '$username') ) p 
						ON p.mail = pub.FK_utilisateur_mail";
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
				$sql = "UPDATE `utilisateur` SET `mot_de_passe`=:password WHERE mail = :mail";
				$values = array(':mail' => $mail, ':password' => $password);
				$rep_prep = Model::$pdo->prepare($sql);
				$rep_prep->execute($values);
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function getPassword ($mail)
		{
			try {
				$sql = "SELECT mot_de_passe FROM `utilisateur` WHERE mail = '$mail'";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_ASSOC);
				return $rep->fetch();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		// PARTIE POSTS --------------------------------------------------------------------------------------------------

		public static function setPost ($mail, $photo, $desc)
		{
			try {
				$sql = "INSERT INTO publication(FK_utilisateur_mail, message, photo) VALUES (:mail, :message, :photo)";
				$values = array(':mail' => $mail, ':message' => $desc, ':photo' => $photo);
				$rep_prep = Model::$pdo->prepare($sql);
				$rep_prep->execute($values);
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}

		public static function updatePost ($id, $desc)
		{
			try {
				$date = date('Y-m-d');
				$sql = "UPDATE `utilisateur` SET `mot_de_passe`=:password WHERE mail = :mail";

				$sql = "UPDATE `publication` SET `message`=:message WHERE PK_post_id = :id";
				$values = array(':message' => $desc, ':id' => $id);
				$rep_prep = Model::$pdo->prepare($sql);
				$rep_prep->execute($values);
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Post introuvable");
			}
		}



		// PARTIE PROFIL --------------------------------------------------------------------------------------------------

		public static function getPhotoProfil($mail)
		{
			try {
				$sql = "SELECT photo_profil FROM `utilisateur` WHERE mail = '$mail'";
				$rep = Model::$pdo->query($sql);
				$rep->setFetchMode(PDO::FETCH_ASSOC);
				return $rep->fetch();
			} catch (PDOException $e) {
				echo $e->getMessage();
				die("Utilisateur introuvable");
			}
		}
	}
	// on initialise la connexion $pdo
	Model::init_pdo();

?>
