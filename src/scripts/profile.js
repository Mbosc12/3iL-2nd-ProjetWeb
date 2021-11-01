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
}

//Récupère tous le posts de l'utilisateur
function requestGetAllPosts(username) {
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
            displayAllPost(data);
        }
    }
    request.send();

    return data;
}

//Affiche tous les posts de l'utilisateur
function displayAllPost(publications) {
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
            li.innerHTML = "<img src=\"../img/user-images/" + photo_path + "\">";
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
            displayIsSubscribed(data);
        }
    }
    request.send();
    return data;
}

//Affiche en fonction de la requête au dessus un bouton 'se désabonner' 
function displayIsSubscribed(data) {
    let subBtn = document.getElementById('m-infos-li');
    if (data.isSubscribed === '1') {
        subBtn.innerHTML = '<button id="m-infos-unsubscribe-button"><span>Se désabonner</span></button>';
    }
}

function requestFollowUser(email_1, username_2) {
    let url = "../requests/followUser.php?email_1=" + email_1 + "&username_2=" + username_2;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.send();
    let subBtn = document.getElementById('m-infos-li');
    subBtn.innerHTML = '<button id="m-infos-unsubscribe-button"><span>Se désabonner</span></button>';
}

