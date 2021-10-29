<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Instagram - Paramètres</title>
        <link rel="icon" sizes="192x192" href="../img/favicon-ig.png">
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
            include '../components/banner.php';
        ?>
        <div class="main">
            <article id="m-parameters-article">
                <h1>Paramètres</h1>
                <form method="post">
                    <input type="file">
                    <input type="password" name="pass_old" placeholder="Ancien mot de passe" required>

                    <input type="password" name="new_pass" placeholder="Nouveau mot de passe" required>

                    <input type="password" name="new_pass_confirmation" placeholder="Confirmation mot de passe"
                           required>

                    <input id="parameters-button" type="submit" value="Mettre à jour profil" name="submit">
                </form>
                <?php
    include '../requests/Model.php';

    if (isset($_POST['pass_old'])) {
        $old_pass = $_POST['pass_old'];
        $new_pass = $_POST['new_pass'];
        $conf_new_pass = $_POST['new_pass_confirmation'];
        
        $stm = Model::getPassword($_SESSION['mail'])['mot_de_passe'];
        echo $stm;
        echo $old_pass;
        if(strcmp($stm, $old_pass) == 0) {
            if (strcmp($new_pass, $conf_new_pass) != 0) {
                echo "Les mots de passe ne sont pas identiques";
            } else {
                Model::setPassword($_SESSION['mail'], $new_pass);
                echo '<script text="text/javascript">
                        var banner = document.getElementByClassName("banner");
                        banner[0].style.display = "block"
                    </script>';
            }
        } else {
            echo "Votre mot de passe actuel n'est pas correct";
        }

    }
?>
            </article>
        </div>
    </body>
</html>