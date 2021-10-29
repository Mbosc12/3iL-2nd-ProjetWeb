function displayGetResults(users) {
    if (users.length !== 0) {
        let getResults = document.getElementById('f-viewer-results');
        for (let user of users) {
            let div = document.createElement("div");
            div.className = "f-viewer-results-item";
            let username = user.pseudo;
            div.innerHTML = "<a href='../pages/profile.php?username=" + username + "'>" +
                "<img src=\"../img/profile_pic.jpeg\">" + username +
                "</a>";
            getResults.appendChild(div);
        }
    }
    displayItems();
}

function displayItems() {
    let [rightBtn] = document.getElementsByClassName('right');
    let [leftBtn] = document.getElementsByClassName('left');
    let viewer = document.getElementById('f-viewer');
    let followers = rightBtn.parentNode.getElementsByClassName('f-viewer-results-item');
    if (followers.length === 0) {
        viewer.style.display = 'none';
    } else {
        if (followers.length <= 8) {
            rightBtn.style.display = 'none';
        }
        if (window.getComputedStyle(followers.item(0)).transform === 'none') {
            leftBtn.style.display = 'none';
        }
        let slideCount = parseInt(`` + followers.length / 9);
        rightBtn.addEventListener('click', (event) => {
            leftBtn.style.display = 'inline-block';
            for (let index = 0; index < followers.length; index++) {
                let currentXTranslation = 0;
                if (window.getComputedStyle(followers.item(index)).transform !== 'none') {
                    currentXTranslation = parseInt(window.getComputedStyle(followers.item(index)).transform.match(/matrix.*\((.+)\)/)[1].split(', ')[4]);
                }
                followers.item(index).style.transform = `translateX(${currentXTranslation - 642}px)`;
                if (parseInt(window.getComputedStyle(followers.item(index)).transform.match(/matrix.*\((.+)\)/)[1].split(', ')[4]) === slideCount * (-642)) {
                    rightBtn.style.display = 'none';
                }
            }
        });
        leftBtn.addEventListener('click', (event) => {
            rightBtn.style.display = 'inline-block';
            for (let index = 0; index < followers.length; index++) {
                let currentXTranslation = parseInt(window.getComputedStyle(followers.item(index)).transform.match(/matrix.*\((.+)\)/)[1].split(', ')[4]);
                followers.item(index).style.transform = `translateX(${currentXTranslation + 642}px)`;
                if (parseInt(window.getComputedStyle(followers.item(index)).transform.match(/matrix.*\((.+)\)/)[1].split(', ')[4]) === 0) {
                    leftBtn.style.display = 'none';
                }
            }
        });
    }
}

function getAllFollowers(username) {
    let url = "../requests/getAllFollowers.php?username=" + username;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            let data = JSON.parse(request.responseText);
            displayGetResults(data);
        }
    }
    request.send();
}

window.addEventListener('DOMContentLoaded', () => {
    getAllFollowers(username);
});