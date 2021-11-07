<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Instagram</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/follower_viewer.css">
        <link rel="stylesheet" href="../css/feed.css">
        <link rel="stylesheet" href="../css/post.css">
        <link rel="stylesheet" href="../css/banner.css">
        <link rel="icon" sizes="192x192" href="../img/icons/favicon-ig.png">
        <script src="../scripts/main.js"></script>
        <script src="../scripts/nav.js"></script>
        <script src="../scripts/new_viewer.js"></script>
        <script src="../scripts/post.js"></script>
    </head>
    <body>
        <?php
            include '../components/nav.php';
            if(isset($_GET['valid'])) {            
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
        <main id="main">
            <?php
                include '../components/new_viewer.php';
            ?>
            <?php
                include '../components/feed.php';
            ?>
        </main>
        <script type='text/javascript'>
            let username = "<?php echo $_SESSION['pseudo'] ?>";
        </script>
    </body>
</html>