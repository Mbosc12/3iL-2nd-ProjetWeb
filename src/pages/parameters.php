<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Instagram - Paramètres</title>
        <link rel="icon" sizes="192x192" href="../img/icons/favicon-ig.png">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/connexion_signup_parameters.css">
        <link rel="stylesheet" href="../css/banner.css">
        <script src="../scripts/main.js"></script>
        <script src="../scripts/nav.js"></script>
    </head>
    <body>
        <?php
            include '../components/nav.php';
            include '../requests/Model.php';


            if (isset($_POST['submit'])) {
                if(isset($_POST['pass_old']) && isset($_POST['new_pass']) && isset($_POST['new_pass_confirmation'])
                && $_POST['new_pass'] != '' && $_POST['new_pass_confirmation'] != '') {

                    $old_pass = $_POST['pass_old'];
                    $new_pass = $_POST['new_pass'];
                    $conf_new_pass = $_POST['new_pass_confirmation'];

                    $stm = Model::getPassword($_SESSION['mail'])['mot_de_passe'];
                    echo $stm;
                    echo $old_pass;
                    if (strcmp($stm, $old_pass) == 0) {
                        if (strcmp($new_pass, $conf_new_pass) != 0) {
                            $msg = "Les mots de passe ne sont pas identiques";
                        } else {
                            Model::setPassword($_SESSION['mail'], $new_pass);
                            echo '<script type="text/javascript"> document.location.replace(\'index.php?valid=true&msg=0\');</script>';
                        }
                    } else {
                        $msg = "Votre mot de passe actuel n'est pas correct";
                    }
                } else {
                    $msg = "Veuillez saisir les champs demandés";
                }

            }

            if(isset($_POST['delete'])) {
                Model::deleteProfil($_SESSION['mail']);
                echo '<script type="text/javascript"> document.location.replace(\'logout.php\');</script>';
            }

            if(isset($_GET['error'])) {            
                include '../components/banner.php';            
                echo '<script text="text/javascript">
                var banner = document.getElementsByClassName("banner");
                banner[0].style.marginTop = \'50px\';
                var displayBanner = setInterval(function(){ 
                    banner[0].style.display = "none";
                    clearInterval(displayBanner);
                }, 3000);
            </script>';
            }
        ?>
        <div class="main">
            <article id="m-parameters-article">
                <h1>Paramètres</h1>
                <form method="post">
                    <input type="password" name="pass_old" placeholder="Ancien mot de passe">

                    <input type="password" name="new_pass" placeholder="Nouveau mot de passe">

                    <input type="password" name="new_pass_confirmation" placeholder="Confirmation mot de passe">

                    <input id="parameters-button" type="submit" value="Mettre à jour profil" name="submit">
                    <input id="user-delete" type="submit" value="Supprimer son compte" name="delete">
                </form>
                <?php
                    if(!empty($msg)) {
                        echo '<script type="text/javascript"> document.location.replace(\'parameters.php?error=1&msg=0\');</script>';
                        echo '<span> '. $msg .'</span>';
                    }
                ?>
            </article>
        </div>
    </body>
</html>
