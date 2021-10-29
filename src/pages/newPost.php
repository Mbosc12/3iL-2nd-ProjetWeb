<!DOCTYPE HTML>
<html>
    <head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="icon" sizes="192x192" href="../img/favicon-ig.png">
    <script src="../scripts/nav.js"></script>
    <script src="../scripts/newPost.js"></script>
    </head>
    <body>
        <?php include '../components/nav.php'; ?>
        <div style="margin-top: 80px;">
            <h1> Ajout d'un nouveau post </h1>
            <form method="post" enctype="multipart/form-data">
                <label>Photo</label>
                <input type="file" id="img" name="img" accept="image/png, image/jpeg" onchange="readURL(this)" required>
                
                <img id="showImage" src="#" alt="Image du post" style="display: none;">
                
                <label>Description</label>
                <input type="text" name="desc">

                <input type="submit" value="Ajouter un nouveau post" name="submit">
            </form>
        </div>
    </body>
</html>

<?php
    include '../requests/Model.php';

    if(isset($_FILES['img'])) {
        $desc = $_POST['desc'];

        $tmpName = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];

        $date = date("Y-m-d-H-i-s");

        move_uploaded_file($tmpName, '../img/'.$_SESSION['pseudo'].''.$date).'png';
        Model::setPost($_SESSION['mail'], $name, $desc);
    }
?>