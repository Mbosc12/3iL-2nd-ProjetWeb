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