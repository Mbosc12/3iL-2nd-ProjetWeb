<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Instagram - Mon Profil</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/profile.css">
        <link rel="icon" sizes="192x192" href="../img/icons/favicon-ig.png">
        <script src="../scripts/main.js"></script>
        <script src="../scripts/nav.js"></script>
        <script src="../scripts/profile.js"></script>
    </head>
    <body>
        <?php
            include '../components/nav.php';
        ?>
        <main id="main">
            <div class="m-container">
                <div id="m-pres">
                    <div id="m-avatar">
                        <div id="m-avatar-img"></div>
                        <?php
                            echo '<script type="text/javascript">
                                var img = document.getElementById(\'m-avatar-img\');
                                img.style.backgroundImage = "url(\'../img/user-images/'.$_SESSION['photo_profil'].'\')";
                            </script>';
                        ?>
                    </div>
                    <div id="m-infos">
                        <div id="m-infos-m">
                            <ul class="m-infos-ul">
                                <li><h2 id="m-name"><?php echo $_GET['username']; ?></h2></li>
                                <li id="m-infos-li">
                                    <button id="m-infos-subscribe-button">
                                        <span>S'abonner</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div id="m-infos-stats">
                            <ul class="m-infos-ul">
                                <li><span id="m-infos-publications"></span> publications</li>
                                <li><span id="m-infos-followers"></span> abonnés</li>
                                <li><span id="m-infos-subscription"></span> abonnements</li>
                            </ul>
                        </div>
                        <div id="m-infos-main">
                            <h1 id="m-infos-main-name"></h1>
                        </div>
                    </div>
                </div>
                <div id="m-tab">
                    <div class="m-tab-item">
                        <svg color="#262626" fill="#262626" height="12" viewBox="0 0 48 48" width="12">
                            <path clip-rule="evenodd"
                                  d="M45 1.5H3c-.8 0-1.5.7-1.5 1.5v42c0 .8.7 1.5 1.5 1.5h42c.8 0 1.5-.7 1.5-1.5V3c0-.8-.7-1.5-1.5-1.5zm-40.5 3h11v11h-11v-11zm0 14h11v11h-11v-11zm11 25h-11v-11h11v11zm14 0h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11zm14 28h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11z"
                                  fill-rule="evenodd"></path>
                        </svg>
                        <span>publications</span>
                    </div>
                </div>
                <div id="m-gallery">
                    <ul>

                    </ul>
                </div>
            </div>
        </main>
        <script>
            window.onload = function () {
                let username = '<?php echo $_GET['username']; ?>';
                let email = '<?php echo $_SESSION['mail']; ?>';
                requestSelectUser(username);
                requestGetAllPosts(username);
                requestGetCountFollowers(username);
                requestGetCountSubscriptions(username);
                let subButton = document.getElementById('m-infos-li');
                if (username === '<?php echo $_SESSION['pseudo']; ?>') {
                    subButton.innerHTML = `<button id="m-infos-parameters-button" onclick="window.location.href='../pages/parameters.php'"><span>Modifier profil</span></button>`;
                }
                subscribeButton = document.getElementById('m-infos-subscribe-button');
                if(subscribeButton != null) {
                    document.getElementById('m-infos-subscribe-button').addEventListener('click', () => {
                        requestFollowUser(email, username);
                    });
                }
                requestGetIsSubscribed(email, username);
            }
        </script>
    </body>
</html>