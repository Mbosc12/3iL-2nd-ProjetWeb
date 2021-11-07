
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
        <script src="../scripts/delete.js"></script>
    </head>
    <body>
        <?php include '../components/nav.php'; ?>
        <main id="m-newPost">
            <article>
                <h1 id="m-newPost-title"> Modifier la publication </h1>
                <form id="m-newPost-form" method="post">
                    <label>Photo</label>
                    <?php
                        include '../requests/Model.php';

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            try {
                                $post = Model::getPost($id);
                                foreach ($post as $p) {
                                    $desc = $p->message;
                                    $img = $p->photo;
                                    $mail = $p->FK_utilisateur_mail;
                                }

                                //si jamais l'utilisateur cherche à modifier ou supprimer une publication qui ne lui appartient pas
                                if($_SESSION['mail'] != $mail) {
                                    echo '<script type="text/javascript"> document.location.replace(\'index.php\');</script>';
                                }

                                //si la description est touchée
                                if(isset($_POST['desc'])) {
                                    $desc = $_POST['desc'];
                                    Model::updatePost($id, $desc);  
                                    echo '<script type="text/javascript"> document.location.replace(\'index.php?valid=true&msg=0\');</script>';
                                }  
                            } catch (PDOException $e) {
                                Print 'Error :'.$e.getMessage().'</br>';
                            }
                        }

                        if(isset($_POST['delete'])) {
                            if(file_exists('../img/user-images/'.$img)) {
                                unlink('../img/user-images/'.$img);
                                try {
                                    Model::deletePost($id);
                                } catch(PDOException $e) {
                                    Print 'Error :'. $e.getMessage().'</br>';
                                }
                            } 
                        }
                    ?>
                    <div id="m-newPost-form-photo">
                        <?php echo '<img id="showImage" src="../img/user-images/'.$img.'" alt="Image du post">' ?>
                    </div>
                    <label>Description</label>
                    <label>
                        <textarea id="m-newPost-form-textarea" rows="5" cols="52" column maxlength="256" type="text"
                                  name="desc"><?php echo $desc;?></textarea>
                    </label>

                    <input id="m-newPost-form-submit" type="submit" value="Modifier" name="submit">
                    <input id="m-newPost-delete" type="submit" value="Supprimer" name="delete">
                </form>
            </article>
        </main>
    </body>
</html>