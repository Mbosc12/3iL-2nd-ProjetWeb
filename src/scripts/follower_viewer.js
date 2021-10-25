function displayGetResults(users) {
    if (users.length !== 0) {
        let getResults = document.getElementById('f-viewer-results');
        for (let user of users) {
            let li = document.createElement("li");
            let username = user.pseudo;
            li.innerHTML = "<a class='f-viewer-results-item' href='../pages/profile.php?username=" + username + "'>" +
                "<img src='#'>" + username +
                "</a>";
            getResults.appendChild(li);
        }
    }
}

function getAllFollowers(username) {
    let url = "../requests/getAllFollowers.php?username=" + username;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        let data = JSON.parse(request.responseText);
        displayGetResults(data);
    });
    request.send(null);
}

window.addEventListener('DOMContentLoaded', () => {
    getAllFollowers(username);
});