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
                <h1 id="m-newPost-title"> Modifier la publication </h1>
                <form id="m-newPost-form" method="post">
                    <label>Photo</label>
                    <?php
                        include '../requests/Model.php';

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            try {
                                $post = Model::getPost($id);
                                var_dump($post[0]);
                                foreach($post[0] as $e) {
                                    echo $e;
                                };
                                if(isset($_POST['desc'])) {
                                    $desc = $_POST['desc'];
                                    Model::updatePost($id, $desc);  
                                }  
                            } catch (PDOException $e) {
                                Print 'Error :'.$e.getMessage().'</br>';
                            }
                        }
                    ?>
                    <div id="m-newPost-form-photo">
                        <img id="showImage" src="#" alt="Image du post" style="display: none;">
                    </div>
                    <label>Description</label>
                    <label>
                        <textarea id="m-newPost-form-textarea" rows="5" cols="52" column maxlength="256" type="text"
                                  name="desc"><?php echo $post[0]['message'];?></textarea>
                    </label>

                    <input id="m-newPost-form-submit" type="submit" value="Modifier" name="submit">
                </form>
            </article>
        </main>
    </body>
</html>