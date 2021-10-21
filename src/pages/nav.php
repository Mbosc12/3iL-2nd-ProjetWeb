<?php
include '../condb.php';

if(!isset($_SESSION['pseudo'])) {
    header("location:/pages/connexion.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/nav.css">
    </head>
    <body>
        <nav id="m-nav-nav">
            <div class="m-nav-container">
                <div id="m-nav-nav-left">
                    <div id="m-nav-logo" class="m-nav-item">
                        <h2>instagram</h2>
                    </div>
                    <div id="m-nav-search" class="m-nav-item">
                        <input placeholder="Rechercher" type="search">
                    </div>
                </div>
                <div id="m-nav-options" class="m-nav-item">
                    <div class="home"></div>
                    <img class="m-nav-options-icon" src="../img/icons/home.png">
                    <img class="m-nav-options-icon" src="../img/icons/heart.png">
                    <a href="/pages/profile.php">
                        <?php 
                            echo '<img src="../img/'.$_SESSION['photo_profil'].'.png" class="m-nav-options-avatar"/>';
                        ?>
                    </a>
                    <span><a href="/pages/logout.php">Se déconnecter</a></span>
                </div>
            </div>
        </nav>
    </body>
</html>