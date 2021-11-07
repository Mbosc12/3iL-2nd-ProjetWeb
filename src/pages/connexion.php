<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "insta_db";

    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    include '../requests/Model.php';

    //start session
    session_start();

    //if not connected
    if (!isset($_SESSION['pseudo'])) {
        //if username
        if (isset($_POST['login'])) {
            //catch
            $username = stripslashes($_REQUEST['username']);
            $password = stripslashes($_REQUEST['password']);

            //request
            $query = "SELECT * FROM `utilisateur` WHERE `pseudo`=:username and `mot_de_passe`=:password";
            try {
                $stmt = $bdd->prepare($query);
                $stmt->bindParam('username', $username, PDO::PARAM_STR);
                $stmt->bindValue('password', $password, PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();

                //if we have a result; we save data in global var $_SESSION
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($count == 1 && !empty($row)) {
                    $_SESSION['pseudo'] = $row['pseudo'];
                    $_SESSION['nom'] = $row['nom'];
                    $_SESSION['prenom'] = $row['prenom'];
                    $_SESSION['mail'] = $row['mail'];

                    try {
                        $photo_profil = Model::getPhotoProfil($row['mail'])['photo_profil'];
                        $_SESSION['photo_profil'] = $photo_profil;
                    } catch(PDOException $e) {
                        Print 'Error :'. $e.getMessage().'</br>';
                    }
                    header("location:/pages/index.php");
                } else {
                    $msg = "Les identifiants saisis sont incorrects !";
                    header("location:/pages/connexion.php?error=1&msg=1");
                }
            } catch(PDOException $e) {
                Print 'Error :'. $e.getMessage().'</br>';
            }
        }
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8"/>
                <title>Instagram - Connexion</title>
                <link rel="icon" sizes="192x192" href="../img/icons/favicon-ig.png">
                <link href="../css/connexion_signup_parameters.css" rel="stylesheet">
                <link href="../css/banner.css" rel="stylesheet">
            </head>
            <body>
                <?php
                    //affiche la bannière montrant que l'utilisateur a bien été crée
                    if(isset($_GET['valid']) || isset($_GET['error'])) {
                        include '../components/banner.php';

                        //permet de supprimer la bannière au bout de 3 secondes
                        echo '<script type="text/javascript">
                        var displayBanner = setInterval(function(){ 
                                var banner = document.getElementsByClassName("banner");
                                banner[0].style.display = "none";
                                clearInterval(displayBanner);
                            }, 3000);
                        </script>';
                    }
                ?>
                <div class="main">
                    <article>
                        <h1>Instagram</h1>
                        <form action="" method="post">
                            <input aria-label="username-field" type="text" name="username"
                                   placeholder="Nom d'utilisateur"
                                   required>
                            <input aria-label="password-field" type="password" name="password"
                                   placeholder="Mot de passe">
                            <input id="connexion-button" type="submit" value="Connexion" name="login">
                            <?php if (!empty($msg)) { ?>
                                <p class="errorMessage"><?php echo $msg; ?></p>
                            <?php } ?>
                        </form>
                        <a href="../pages/signup.php">S'inscrire</a>
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
