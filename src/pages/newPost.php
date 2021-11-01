<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/newPost.css">
        <link rel="icon" sizes="192x192" href="../img/icons/favicon-ig.png">
        <script src="../scripts/main.js"></script>
        <script src="../scripts/nav.js"></script>
        <script src="../scripts/showImage.js"></script>
    </head>
    <body>
        <?php include '../components/nav.php'; ?>
        <main id="m-newPost">
            <article>
                <h1 id="m-newPost-title"> Ajouter une publication </h1>
                <form id="m-newPost-form" method="post" enctype="multipart/form-data">
                    <label>Photo</label>
                    <div id="m-newPost-form-photo">
                        <input type="file" id="img" name="img" accept="image/png, image/jpeg" onchange="readURL(this)"
                               required>
                        <img id="showImage" src="#" alt="Image du post" style="display: none;">
                    </div>
                    <label>Description</label>
                    <label>
                        <textarea id="m-newPost-form-textarea" rows="5" cols="52" column maxlength="256" type="text"
                                  name="desc"></textarea>
                    </label>

                    <input id="m-newPost-form-submit" type="submit" value="Partager" name="submit">
                </form>
            </article>
        </main>
    </body>
</html>

<?php
    include '../requests/Model.php';

    if (isset($_FILES['img'])) {
        $desc = $_POST['desc'];
        $tmpName = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];
        $type = pathinfo($name, PATHINFO_EXTENSION);
        $date = date("Y-m-d-H-i-s");
        
        try {
            move_uploaded_file($tmpName, '../img/user-images/' . $_SESSION['pseudo'] . '_' . $date . '.' . $type);
            Model::setPost($_SESSION['mail'], $_SESSION['pseudo'] . '_' . $date . '.' . $type, $desc);    
            //TODO
            // die(header("location:/pages/index.php?valid=0&msg=2"));
        } catch (PDOException $e) {
            Print 'Error :'.$e.getMessage().'</br>';
        }
    }
?>