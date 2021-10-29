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
        <script src="../scripts/follower_viewer.js"></script>
        <script src="../scripts/post.js"></script>
        <script src="../scripts/feed.js"></script>
    </head>
    <body>
        <?php
            include '../components/nav.php';
        ?>
        <main id="main">
            <?php
                include '../components/follower_viewer.php';
            ?>
            <?php
                include '../components/feed.php';
            ?>
        </main>
        <script type='text/javascript'>
            var username = "<?php echo $_SESSION['pseudo'] ?>";
        </script>
    </body>
</html>