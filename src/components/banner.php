<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/banner.css">
</head>
<body>
    <?php 
        if(isset($_GET['error']) == 1) {
            echo "
            <div class='banner red'>
                <span> Votre changement n'a pas été pris en compte </span>
            </div>";
        } else {
            echo "
            <div class='banner green'>
                <span> Votre changement a bien été pris en compte </span>
            </div>";
        }
    ?>
</body>
</html>