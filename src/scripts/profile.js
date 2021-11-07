// Permet de récuperer les informations de l'utilisateur
function requestSelectUser(username) {
    let url = "../requests/selectUser.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            data = JSON.parse(request.responseText);
            displaySelectUserData(data);
        }
    }
    request.send();

    return data;
}

//Affiche les infromations de l'utilisateur
function displaySelectUserData(data) {
    if (data[0].prenom && data[0].nom) {
        document.getElementById('m-infos-main-name').innerText = data[0].prenom + ' ' + data[0].nom;
    }
    if (data[0].photo_profil) {
        document.getElementById('m-avatar-img').innerHTML = '<img src="../img/user-images/' + data[0].photo_profil + '">';
    }
}

//Récupère tous le posts de l'utilisateur
function requestGetAllPosts(username, email) {
    let url = "../requests/getAllPosts.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            if (request.responseText === "Aucune publication") {
                data = null
            } else {
                data = JSON.parse(request.responseText);
            }
            displayAllPost(data, email);
        }
    }
    request.send();

    return data;
}

//Affiche tous les posts de l'utilisateur
function displayAllPost(publications, email) {
    let publication_count = document.getElementById('m-infos-publications');
    let gallery = document.getElementById('m-gallery').getElementsByTagName('ul')[0];
    if (publications.length === 0) {
        publication_count.innerText = '0';
        gallery.innerHTML = "<h1 id='m-gallery-no-pub'>Aucune publication</h1>";
    } else {
        publication_count.innerText = publications.length;
        for (let publication in publications) {
            let li = document.createElement("li");
            let photo_path = publications[publication].photo;
            if(email == publications[publication].FK_utilisateur_mail) {
                li.innerHTML = "<a href='../pages/modifPost.php?id="+ publications[publication].PK_post_id + "'><img src=\"../img/user-images/" + photo_path + "\"></a>";
            } else {
                li.innerHTML = "<img src=\"../img/user-images/" + photo_path + "\">";
            }
            gallery.appendChild(li);
        }
    }
}

//Récupère le nombre d'abonnés
function requestGetCountFollowers(username) {
    let url = "../requests/getCountFollowers.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            [data] = JSON.parse(request.responseText);
            displayCountFollowers(data);
        }
    }
    request.send();
    return data;
}

//Affiche le nombre d'abonnés
function displayCountFollowers(data) {
    let followers_count = document.getElementById('m-infos-followers');
    followers_count.innerText = data.countFollowers;
}

//Récupère le nombre d'abonnements
function requestGetCountSubscriptions(username) {
    let url = "../requests/getCountSubscriptions.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            [data] = JSON.parse(request.responseText);
            displayCountSubscriptions(data);
        }
    }
    request.send();
    return data;
}

//Affiche le nombre d'abonnements
function displayCountSubscriptions(data) {
    let subscriptions_count = document.getElementById('m-infos-subscription');
    subscriptions_count.innerText = data.countSubscriptions;
}

//Regarde si l'utilisateur de la session est abonné à l'utilisateur 
function requestGetIsSubscribed(email_1, username_2) {
    let url = "../requests/getIsSubscribed.php?email_1=" + email_1 + "&username_2=" + username_2;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            [data] = JSON.parse(request.responseText);
            displayIsSubscribed(parseInt(data.isSubscribed), email_1, username_2);
        }
    }
    request.send();
    return data;
}

//Affiche en fonction de la requête au dessus un bouton 'se désabonner' 
function displayIsSubscribed(sub, email_1, username_2) {
    let subBtn = document.getElementById('m-infos-li');
    if (sub === 1) {
        subBtn.innerHTML = '<button id="m-infos-unsubscribe-button"><span>Se désabonner</span></button>';
        document.getElementById('m-infos-unsubscribe-button').addEventListener('click', () => {
            requestUnfollowUser(email_1, username_2);
        });
    } else {
        subBtn.innerHTML = '<button id="m-infos-subscribe-button"><span>S\'abonner</span></button>';
        document.getElementById('m-infos-subscribe-button').addEventListener('click', () => {
            requestFollowUser(email_1, username_2);
        });
    }
}

function requestUnfollowUser(email_1, username_2) {
    let url = "../requests/unfollowUser.php?email_1=" + email_1 + "&username_2=" + username_2;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.send();
    displayIsSubscribed(0, email_1, username_2);
}

function requestFollowUser(email_1, username_2) {
    let url = "../requests/followUser.php?email_1=" + email_1 + "&username_2=" + username_2;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.send();
    displayIsSubscribed(1, email_1, username_2);
}

