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
        <link rel="icon" sizes="192x192" href="../img/icons/favicon-ig.png">
        <script src="../scripts/main.js"></script>
        <script src="../scripts/nav.js"></script>
        <script src="../scripts/new_viewer.js"></script>
        <script src="../scripts/post.js"></script>
    </head>
    <body>
        <?php
            include '../components/nav.php';
        ?>
        <main id="main">
            <?php
                // ancien viewer fait par mathis: à voir si on le garde avec le prof
                // include '../components/follower_viewer.php';
                // nouveau viewer plus simple
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