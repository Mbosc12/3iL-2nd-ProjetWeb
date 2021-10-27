<?php
    if(isset($_GET['id'])) {
        $posts = Model::getPost($_GET['id']);
        foreach($posts as $post) {
            $desc = $post->message;
            $img = $post->photo;
            $mail = $post->FK_utilisateur_mail;
        }

        $userInfo = Model::selectUserByMail($mail);
        foreach($userInfo as $info) {
            $pseudo = $info->pseudo;
            $photo = $info->photo_profil;
        }

        $likesInfo = Model::getLikes($_GET['id']);
        foreach($likesInfo as $info) {
            $likes = $info[0];
        }
    }
?>

<article>
    <header>
        <div>
            <?php echo '<img alt="profile_picture" src="../img/'.$photo.'" height="32" width="32"/>' ?>
            <a class="post-name" href="../pages/profile.php"><?php echo $pseudo; ?></a>
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
                <a onclick="">Se désabonner</a>
                <a>Annuler</a>
            </div>
        </div>
    </header>

    <div class="content">
        <?php echo '<img src="../img/'.$img.'" alt="post-picture">'; ?>
    </div>
    <footer>
        <section class="footer_actions">
            <button class="post-like" onclick="likePost(this)">
                <img src="../img/heart.svg" alt="heart">
            </button>
            <button onclick="commentPost(this)">
                <img src="../img/chat-bubble.png" alt="comment">
            </button>
            <button>
                <img src="../img/send.png" alt="share">
            </button>
        </section>
        <section class="footer_likes">
            <span><?php echo $likes; ?></span>
            <?php 
                if($likes <= 1) {
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
            <div class="post_comments">
                <!--<a href="post.php">Afficher les commentaires</a>-->
            </div>
        </div>
        <div class="post-time">Il y a 6 heures</div>
        <section class="post_comment">
            <form action="">
				<textarea aria-label="comment-field" class='postCommentTextArea' placeholder="Ajouter un commentaire..."
                          autocomplete="off"></textarea>
                <button class="submit-comment-button" type="submit">Publier</button>
            </form>
        </section>
    </footer>
</article>