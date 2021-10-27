<?php
    include '../components/nav.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Instagram</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/feed.css">
    <link rel="stylesheet" href="../css/post.css">
    <link rel="icon" sizes="192x192" href="../img/favicon-ig.png">
    <script src="../scripts/main.js"></script>
    <script src="../scripts/nav.js"></script>
    <script src="../scripts/post.js"></script>
    <script src="../scripts/feed.js"></script>
</head>
<body>
<main>
    <?php
        include '../components/feed.php';
    ?>
</main>
</body>
</html>