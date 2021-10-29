<?php
    include '../requests/Model.php';
    include '../components/nav.php';
    
    if(isset($_POST['pass_old'])) {
        $old_pass = $_POST['pass_old'];
        $new_pass = $_POST['new_pass'];
        $conf_new_pass = $_POST['new_pass_confirmation'];

        if(strcmp($new_pass, $conf_new_pass) != 0) {
            echo "Les mots de passe ne sont pas identiques";
        } else {
            echo $_SESSION['mail'];
            Model::setPassword($_SESSION['mail'], $new_pass);
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head></head>
    <body>
        <form method="post">
            <label>Ancien mot de passe</label>
            <input type="password" name="pass_old" required>
            
            <label>Nouveau mot de passe</label>
            <input type="password" name="new_pass" required>
            
            <label>Confirmation du nouveau mot de passe</label>
            <input type="password" name="new_pass_confirmation" required>
        
            <input type="submit" value="Changer de mot de passe" name="submit">
        </form>
    </body>
</html>