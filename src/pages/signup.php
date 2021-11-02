<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Instagram - Inscription</title>
        <link href="../css/banner.css" rel="stylesheet">
        <link href="../css/connexion_signup_parameters.css" rel="stylesheet">
        <link rel="icon" sizes="192x192" href="../img/icons/favicon-ig.png">
        <script src="../scripts/showImage.js"></script>
    </head>
    <body>
        <?php

            include '../condb.php';

            if (!isset($_SESSION['pseudo'])) {
            if (isset($_POST['email'])) {
                $sqlMailVerify = 'SELECT COUNT(*) FROM utilisateur where mail = :mail OR pseudo = :username';

                $stmt = $bdd->prepare($sqlMailVerify);
                $stmt->bindParam('mail', $_POST['email'], PDO::PARAM_STR);
                $stmt->bindParam('username', $_POST['username'], PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();

                //si l'utilisateur défini une image
                if (isset($_FILES['img'])) {
                    $desc = $_POST['desc'];
                    $tmpName = $_FILES['img']['tmp_name'];
                    $name = $_FILES['img']['name'];
                    $type = pathinfo($name, PATHINFO_EXTENSION);
                    $date = date("Y-m-d-H-i-s");
                    //on insert dans la base de donnée
                    try {
                        $photo_profil = $_REQUEST['username'] . '_' . $date . '.' . $type;

                        $sqlQuery = 'INSERT INTO utilisateur(pseudo, nom, prenom, mail, mot_de_passe, date_naissance, photo_profil, date_inscription) 
                        VALUES (\'' . $_REQUEST['username'] . '\', \'' . $_REQUEST['firstname'] . '\', \'' . $_REQUEST['name'] . '\', \'' . $_REQUEST['email'] . '\',
                         \'' . $_REQUEST['password'] . '\', \'' . $_REQUEST['birthdate'] . '\', \'' . $photo_profil . '\', \'' . date('Y-m-d') . '\')';

                        $bdd->query($sqlQuery);

                        //on ajoute l'image au dossier
                        move_uploaded_file($tmpName, '../img/user-images/' . $_REQUEST['username'] . '_' . $date . '.' . $type);
                        header("location:/pages/connexion.php?valid=true&msg=1");

                    } catch (PDOException $e) {
                        include '../components/banner.php?error=1';
                        print "Erreur ! " . $e . getMessage() . "</br>";
                    }
                    //si l'utilisateur n'en définit pas
                } else {
                    try {
                        //on insert dans la base de donnée
                        $photo_profil = '../img/user-images/default_photo.jpeg';
                        $sqlQuery = 'INSERT INTO utilisateur(pseudo, nom, prenom, mail, mot_de_passe, date_naissance, photo_profil, date_inscription) 
                        VALUES (\'' . $_REQUEST['username'] . '\', \'' . $_REQUEST['firstname'] . '\', \'' . $_REQUEST['name'] . '\', \'' . $_REQUEST['email'] . '\',
                         \'' . $_REQUEST['password'] . '\', \'' . $_REQUEST['birthdate'] . '\', \'' . $photo_profil . '\', \'' . date('Y-m-d') . '\')';

                        $bdd->query($sqlQuery);
                        header("location:/pages/connexion.php?valid=true&msg=1");
                    } catch (PDOException $e) {
                        include '../components/banner.php?error=1';
                        print "Erreur ! " . $e . getMessage() . "</br>";
                    }
                }
            }
        ?>

        <div class="main">
            <article id="m-signup-article">
                <h1>Instagram</h1>
                <h2>Inscrivez-vous pour voir les photos et vidéos de vos amis</h2>
                <form method="post" enctype="multipart/form-data">
                    <div id="m-signup-form-photo">
                        <img id="showImage" src="#" alt="Image de profil" style="display: none;">
                        <input type="file" id="img" name="img" accept="image/png, image/jpeg" onchange="readURL(this)">
                    </div>
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
    header("location:/pages/index.php");
}
?>