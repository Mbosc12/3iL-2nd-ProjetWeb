<?php

include '../condb.php';

if(!isset($_SESSION['pseudo'])) {
    if (isset($_POST['email'])){
        $sqlMailVerify = 'SELECT COUNT(*) FROM utilisateur where mail = :mail OR pseudo = :username';

        $stmt = $bdd->prepare($sqlMailVerify);
        $stmt->bindParam('mail', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam('username', $_POST['username'], PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        echo $_POST['email'];
        echo $count;

        $newdate = date('Y-m-d');
        $sqlQuery = 'INSERT INTO utilisateur(pseudo, nom, prenom, mail, motdepass, date_naissance, photo_profil, date_inscription) 
        VALUES (:username, :firstname, :name, :email, :password, :birthdate, null, :date)';

        $insertRecipe = $bdd->prepare($sqlQuery);

        $insertRecipe->execute([
            'username' => stripslashes($_REQUEST['username']),
            'firstname' => stripslashes($_REQUEST['firstname']),
            'name' => stripslashes($_REQUEST['name']),
            'email' => stripslashes($_REQUEST['email']),
            'password' => stripslashes($_REQUEST['password']),
            'birthdate' => stripslashes($_REQUEST['birthdate']),
            'date' => date('Y-m-d')
        ]) or die(print_r($bdd->errorInfo()));
    }
?>
<!DOCTYPE html>
  <html>
      <head>
          <meta charset="utf-8" />
          <title>Instagram - Inscription</title>
          <link href="../css/connexion_signup.css" rel="stylesheet">
      </head>
      <body>
          <div class="main">
            <article>
                <h1>Instagram</h1>
                <h2>Inscrivez-vous pour voir les photos et vidéos de vos amis</h2>
                <form action="" method="post">
                  <input type="email" name="email" placeholder="E-mail" required>
                  <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                  <input type="text" name="name" placeholder="Prénom" required>
                  <input type="text" name="firstname" placeholder="Nom" required>
                  <input type="password" name="password" placeholder="Mot de passe" required>
                  <input type="date" name="birthdate" placeholder="Date de naissance" required>
                  <input id="signup-button" type="submit" value="S'inscrire" name="signup">
                  <?php if (!empty($msg)) { ?>
                      <p class="errorMessage"><?php echo $msg; ?></p>
                  <?php } ?>
                </form>
                <a href="../pages/connexion.php">Se connecter</a>
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