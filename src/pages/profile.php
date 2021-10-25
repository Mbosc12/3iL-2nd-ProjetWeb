<?php
$_GET['username'];
if (isset($_GET['username'])) {

    $query = "SELECT pseudo, nom, prenom, photo_profil FROM `utilisateur` WHERE `pseudo`=:username";

    $stmt = $bdd->prepare($query);
    $stmt->bindParam('username', $_GET['user'], PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($count == 1 && !empty($row)) {
        echo $row['pseudo'];
    } else {
        echo "Utilisateur introuvable";
    }

} else {
    echo "Pas de d'utilisateur";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Instagram</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="icon" sizes="192x192" href="../img/favicon-ig.png">
    <script src="../scripts/main.js"></script>
    <script src="../scripts/nav.js"></script>
</head>
<body>
<?php
include '../components/nav.php';
?>
<div class="m-container">
    <div id="m-pres">
        <div id="m-avatar">
            <div id="m-avatar-img"></div>
        </div>
        <div id="m-infos">
            <div id="m-infos-m">
                <ul class="m-infos-ul">
                    <li><h3 id="m-name">Gotaga</h3></li>
                    <li>
                        <button>Contacter</button>
                    </li>
                    <li>
                        <button><img src="../img/icons/subscribe.png" width="15px"><span>S'abonner</span></button>
                    </li>
                </ul>
            </div>
            <div id="m-infos-stats">
                <ul class="m-infos-ul">
                    <li><span>245</span> publications</li>
                    <li><span>245</span> abonnés</li>
                    <li><span>245</span> abonnements</li>
                </ul>
            </div>
            <div id="m-infos-main">
                <strong>Corentin H - Gotaga</strong><br/>
                <span>Profil public</span>
                <p>Laejeau fafhzaifazifz afzafzanfozfoanfaznfnafa <br>
                    dhiazhidzahidhazidhazidhazidhiazhdizahdiazhidazih <br>
                    riahriazhirahirahirhiahriahiraihrahi</p>
            </div>
        </div>
    </div>
    <div id="m-tab">
        <span>publications</span>
    </div>
    <div id="m-galery">
        <ul>
            <li><img src="../img/test.jpg"></li>
            <li><img src="../img/test-grandjpg.jpg"></li>
            <li><img src="../img/test-grandjpg.jpg"></li>
            <li><img src="../img/test.jpg"></li>
            <li><img src="../img/test.jpg"></li>
        </ul>
        <!-- <div id="m-galery-img">
            <div class="m-galery-pub"><img src="../img/test.jpg"></div>
            <div class="m-galery-pub"><img src="../img/test-grandjpg.jpg"></div>
            <div class="m-galery-pub"><img src="../img/test-grandjpg.jpg"></div>
            <div class="m-galery-pub"><img src="../img/test.jpg"></div>
            <div class="m-galery-pub"><img src="../img/test.jpg"></div>
        </div> -->
    </div>
</div>
<script>
    function requestSelectUser(username) {
        let url = "../requests/selectUser.php?username=" + username;
        let request = new XMLHttpRequest();
        let data;
        request.open("GET", url, true);
        request.addEventListener("load", function () {
            data = JSON.parse(request.responseText);
        });
        request.send(null);
        return data;
    }
</script>
</body>
</html>