<?php

$host = "localhost"; $user = "root"; $password = "root"; $dbname = "insta_db";

try {
	$bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch(Exception $e) {
	die('Erreur : ' .$e->getMessage());
}
//start session
session_start();

//if not connected
if(!isset($_SESSION['pseudo'])) {
  //if username
  if (isset($_POST['username'])){
    //catch
    $username = stripslashes($_REQUEST['username']);
    $password = stripslashes($_REQUEST['password']);
    
    //request
    $query = "SELECT * FROM `utilisateur` WHERE `pseudo`=:username and `motdepass`=:password";
    
    $stmt = $bdd->prepare($query);
    $stmt->bindParam('username', $username, PDO::PARAM_STR);
    $stmt->bindValue('password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();

    //if we have a result; we save data in global var $_SESSION
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($count == 1 && !empty($row)) {
            $_SESSION['pseudo']   = $row['pseudo'];
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['prenom'] = $row['prenom'];
            $_SESSION['photo_profil'] = $row['photo_profil'];
            header("location:/pages/feed.php");
          } else {
            $msg = "Les identifiants saisis sont incorrects !";
          }
    }
  ?>
  <!DOCTYPE html>
  <html>
      <head>
          <meta charset="utf-8" />
          <title>Instagram - Connexion</title>
          <link href="../css/connexion.css" rel="stylesheet">
      </head>
      <body>
        <div class="main">
        <article>
            <h1>Instagram</h1>
            <form action="" method="post">
              <input type="text" name="username" placeholder="Nom d'utilisateur" required>
              <input type="password" name="password" placeholder="Mot de passe">
              <input id="connexion-button" type="submit" value="Connexion" name="login">
              <?php if (!empty($msg)) { ?>
                  <p class="errorMessage"><?php echo $msg; ?></p>
              <?php } ?>
            </form>
        </article>
        </div>
      </body>
  </html>
<?php
//if connected
} else {
  header("location:/pages/feed.php");
}
?>
