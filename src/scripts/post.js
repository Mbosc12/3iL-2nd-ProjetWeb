function displayPostMenu(element) {
    let [menu] = element.parentNode.closest('div').getElementsByClassName('post-dropdown-menu');
    menu.classList.toggle('show');
}

function likePost(element, postId) {
    element.classList.toggle('liked');
    if (element.classList.contains('liked')) {
        let url = "../requests/setLike.php?email_1=" + email + "&postId=" + postId;
        let request = new XMLHttpRequest();
        request.open("GET", url, true);
        request.onreadystatechange = function () {
            if (request.status === 200 && request.readyState === 4) {
                getLikes(element, postId);
                element.classList.add('liked');
                element.innerHTML = "<img alt='read-heart' src=\"../img/icons/red_heart.png\">";
            }
        }
        request.send();
    } else {
        let url = "../requests/removeLike.php?email_1=" + email + "&postId=" + postId;
        let request = new XMLHttpRequest();
        request.open("GET", url, true);
        request.onreadystatechange = function () {
            if (request.status === 200 && request.readyState === 4) {
                getLikes(element, postId);
                element.innerHTML = "<img alt='heart' src=\"../img/icons/heart.svg\">";
            }
        }
        request.send();
    }
}

function getLikes(element, postId) {
    let url = "../requests/getLikes.php?postId=" + postId;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            let data = JSON.parse(request.responseText);
            element.parentNode.parentNode.getElementsByClassName('footer_likes')[0].childNodes[1].innerText = [data];
        }
    }
    request.send();
}

function isLiked(email, postId) {
    let url = "../requests/isLiked.php?email_1=" + email + "&postId=" + postId;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            let data = JSON.parse(request.responseText);
            let element = document.getElementById('post-' + postId).getElementsByClassName('post-like')[0];
            if (data[0][0] === "1") {
                element.classList.add('liked');
                element.innerHTML = "<img alt='read-heart' src=\"../img/icons/red_heart.png\">";
            } else {
                element.innerHTML = "<img alt='heart' src=\"../img/icons/heart.svg\">";
            }
        }
    }
    request.send();
}

function requestUnfollowUser(email_1, username_2) {
    let url = "../requests/unfollowUser.php?email_1=" + email_1 + "&username_2=" + username_2;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.send();
}

