function requestSelectUser(username) {
    console.log(username)
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
    let gallery = document.getElementById('m-gallery');
    if (data === null) {
        gallery.innerHTML = "<h1 id='m-gallery-no-pub'>Aucune publication</h1>"
    }
    console.log(data);
}

