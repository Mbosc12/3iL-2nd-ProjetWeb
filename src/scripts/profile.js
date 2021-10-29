function requestSelectUser(username) {
    let url = "../requests/selectUser.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        data = JSON.parse(request.responseText);
        displaySelectUserData([data]);
    });
    request.send(null);
    return data;
}

function displaySelectUserData(data) {
    document.getElementById('m-infos-main-name').innerText = data.prenom + ' ' + data.nom;
}

function requestGetAllPosts(email) {
    let url = "../requests/getAllPosts.php?email=" + email;
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

function displayAllPost(data) {
    let publication_count = document.getElementById('m-infos-publications');
    let gallery = document.getElementById('m-gallery');
    if (data === null) {
        publication_count.innerText = '0';
        gallery.innerHTML = "<h1 id='m-gallery-no-pub'>Aucune publication</h1>"
    } else {
        console.log(data);
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
        displayIsSubscribed(data);
    });
    request.send(null);
    return data;
}

function displayIsSubscribed(data) {
    if (data.isSubscribed === '1') {
        let subBtn = document.getElementById('m-infos-li');
        subBtn.innerHTML = '<button id="m-infos-unsubscribe-button"><span>Se désabonner</span></button>';
    }
}

