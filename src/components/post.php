<article>
    <header>
        <div>
            <img alt="profile_picture" src="../img/profile_pic.jpeg" height="32" width="32"/>
            <a href="../pages/profile.php">Name</a>
        </div>
        <div class="post-dropdown">
            <button onclick="displayMenu(this)" type="button">
                <svg class="post-dropdown-button" fill="#262626" height="24" width="24">
                    <circle cx="12" cy="12" r="1.5"></circle>
                    <circle cx="6.5" cy="12" r="1.5"></circle>
                    <circle cx="17.5" cy="12" r="1.5"></circle>
                </svg>
            </button>
            <div class="post-dropdown-menu">
                <a href="#">Se desabonner</a>
                <a href="#">Annuler</a>
            </div>
        </div>
    </header>

    <div class="content">
        <img src="../img/post_test_picture.jpeg" alt="post-picture">
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
            <span>100</span>
            J'aime
        </section>
        <div>
            <div class="post_description">
                Description
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