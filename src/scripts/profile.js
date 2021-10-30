function requestSelectUser(username) {
    let url = "../requests/selectUser.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        data = JSON.parse(request.responseText);
        displaySelectUserData(data);
    });
    request.send(null);
    return data;
}

function displaySelectUserData(data) {
    if (data[0].prenom && data[0].nom) {
        document.getElementById('m-infos-main-name').innerText = data[0].prenom + ' ' + data[0].nom;
    }
}

function requestGetAllPosts(username) {
    let url = "../requests/getAllPosts.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        if (request.responseText === "Aucune publication") {
            data = null
        } else {
            data = JSON.parse(request.responseText);
        }
        displayAllPost(data);
    });
    request.send(null);
    return data;
}

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

function requestGetCountFollowers(username) {
    let url = "../requests/getCountFollowers.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        [data] = JSON.parse(request.responseText);
        displayCountFollowers(data);
    });
    request.send(null);
    return data;
}

function displayCountFollowers(data) {
    let followers_count = document.getElementById('m-infos-followers');
    followers_count.innerText = data.countFollowers;
}

function requestGetCountSubscriptions(username) {
    let url = "../requests/getCountSubscriptions.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        [data] = JSON.parse(request.responseText);
        displayCountSubscriptions(data);
    });
    request.send(null);
    return data;
}

function displayCountSubscriptions(data) {
    let subscriptions_count = document.getElementById('m-infos-subscription');
    subscriptions_count.innerText = data.countSubscriptions;
}

function requestGetIsSubscribed(email_1, username_2) {
    let url = "../requests/getIsSubscribed.php?email_1=" + email_1 + "&username_2=" + username_2;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        [data] = JSON.parse(request.responseText);
        displayIsSubscribed(parseInt(data.isSubscribed), email_1, username_2);
    });
    request.send(null);
    return data;
}

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

