<?php
include '../condb.php';

if (!isset($_SESSION['pseudo'])) {
    header("location:/pages/connexion.php");
}

?>

<nav id="m-nav-nav">
    <div class="m-nav-container">
        <div id="m-nav-nav-left">
            <div id="m-nav-logo" class="m-nav-item">
                <h2><a href="../pages/index.php">Instagram</a></h2>
            </div>
            <div id="m-nav-search" class="m-nav-item">
                <input aria-label="search-field" placeholder="Rechercher" type="search">
            </div>
        </div>
        <div id="m-nav-options" class="m-nav-item">
            <div class="home"></div>
            <img alt="home" class="m-nav-options-icon" src="../img/icons/home.png">
            <img alt="news" class="m-nav-options-icon" src="../img/icons/heart.png">
            <a href="../pages/profile.php">
                <?php
                echo '<img src="../img/' . $_SESSION['photo_profil'] . '.png" class="m-nav-options-avatar"/>';
                ?>
            </a>
            <span><a href="../pages/logout.php">Se déconnecter</a></span>
        </div>
    </div>
</nav>