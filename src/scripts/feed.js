function getPosts(username) {
    let url = "../requests/getPostFollowed.php?username=" + username;
    let request = new XMLHttpRequest();
    let data;
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        data = JSON.parse(request.responseText);
        console.log(data);
    });
    request.send(null);
}

window.addEventListener('DOMContentLoaded', () => {
    console.log("user : " + username);
    getPosts(username);
});

