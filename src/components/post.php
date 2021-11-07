<?php
    if (isset($_GET['id'])) {
        $posts = Model::getPost($_GET['id']);
        foreach ($posts as $post) {
            $desc = $post->message;
            $img = $post->photo;
            $mail = $post->FK_utilisateur_mail;
        }

        $userInfo = Model::selectUserByMail($mail);
        foreach ($userInfo as $info) {
            $pseudo = $info->pseudo;
            $photo = $info->photo_profil;
        }

        $likesInfo = Model::getLikes($_GET['id']);
        foreach ($likesInfo as $info) {
            $likes = $info[0];
        }
    }
?>

<article id="post-<?php echo $_GET['id']; ?>">
    <header>
        <div>
            <?php echo '<img alt="profile_picture" src="../img/user-images/' . $photo . '" height="32" width="32"/>' ?>
            <a class="post-name" href="../pages/profile.php?username=<?php echo $pseudo; ?>"><?php echo $pseudo; ?></a>
        </div>
        <div class="post-dropdown">
            <button onclick="displayPostMenu(this)" type="button">
                <svg class="post-dropdown-button" fill="#262626" height="24" width="24">
                    <circle cx="12" cy="12" r="1.5"></circle>
                    <circle cx="6.5" cy="12" r="1.5"></circle>
                    <circle cx="17.5" cy="12" r="1.5"></circle>
                </svg>
            </button>
            <div class="post-dropdown-menu">
                <a onclick="requestUnfollowUser('<?php echo $_SESSION['mail'];?>','<?php echo $pseudo; ?>')">Se désabonner</a>
                <a>Annuler</a>
            </div>
        </div>
    </header>

    <div class="content">
        <?php echo '<img src="../img/user-images/' . $img . '" alt="post-picture">'; ?>
    </div>
    <footer>
        <section class="footer_actions">
            <button class="post-like" onclick="likePost(this, <?php echo $_GET['id'] ?>)">
                <script>
                    isLiked('<?php echo $_SESSION['mail']; ?>', '<?php echo $_GET['id'] ?>');
                </script>
            </button>
        </section>
        <section class="footer_likes">
            <span><?php echo $likes; ?></span>
            <?php
                if ($likes <= 1) {
                    echo "J'aime";
                } else {
                    echo "J'aimes";
                }
            ?>
        </section>
        <div>
            <div class="post_description">
                <?php echo $desc; ?>
            </div>
        </div>
    </footer>
</article>