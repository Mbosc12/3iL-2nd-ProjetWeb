<?php

$host = "localhost"; $user = "root"; $password = "root"; $dbname = "insta_db";

try {
	$bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch(Exception $e) {
	die('Erreur : ' .$e->getMessage());
}
//start session
session_start();

if (isset($_POST['username'])){
 	$username = stripslashes($_REQUEST['username']);
	$password = stripslashes($_REQUEST['password']);
 	
 	$query = "SELECT * FROM `utilisateur` WHERE `pseudo`=:username and `motdepass`=:password";
 	
 	$stmt = $bdd->prepare($query);
 	$stmt->bindParam('username', $username, PDO::PARAM_STR);
 	$stmt->bindValue('password', $password, PDO::PARAM_STR);
 	$stmt->execute();
 	$count = $stmt->rowCount();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($count == 1 && !empty($row)) {
	        $_SESSION['pseudo'] = $row['pseudo'];
	        $_SESSION['nom'] = $row['nom'];
	        $_SESSION['prenom'] = $row['prenom'];
       		$msg = "Bienvenue !".$row['pseudo'];
      	} else {
        	$msg = "Les identifiants saisis sont incorrects !";
      	}
  } else {
    $msg = "Veuillez saisir un utilisateur et un mot de passe!";
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre de ma page</title>
    </head>
    <body>
    <a href="logout.php">Se déconnecter</a>
    <p>
        Salut !<br />
        Tu es à l'accueil de mon site (index.php). Tu veux aller sur une autre page ?
    </p>
    <form action="" method="post">
    	<input type="text" name="username" placeholder="pseudo" required>
    	<input type="password" name="password" placeholder="mot de passe">
    	<input type="submit" value="Connexion" name="login">
<?php if (! empty($msg)) { ?>
    <p class="errorMessage"><?php echo $msg; ?></p>
<?php } ?>
</form>
</body>
</html>