function displayItems(firstUser) {
    let [rightBtn] = document.getElementsByClassName('right');
    let [leftBtn] = document.getElementsByClassName('left');
    let viewer = document.getElementById('f-viewer');

    let followers = rightBtn.parentNode.getElementsByClassName('f-viewer-results-item');
    //si il n'y a aucun abonnements
    if (followers.length === 0) {
        viewer.style.display = 'none';
    //sinon
    } else {
        if (nombreSub < (firstUser+8)) {
            rightBtn.style.display = 'none';
        } else {
            rightBtn.style.display = 'block';
        }

        if (firstUser == 0) {
            leftBtn.style.display = 'none';
        } else {
            leftBtn.style.display = 'block';
        }

        rightBtn.addEventListener('click', (event) => {
            firstUser += 8;
            var maximum = firstUser+8 <= nombreSub ? firstUser+8 : nombreSub;
            setUsers((firstUser), maximum);
        });

        leftBtn.addEventListener('click', (event) => {
            var maximum = firstUser
            firstUser -= 8;
            setUsers(firstUser, maximum);
        });
    }
}

function setUsers(firstUser, maximum) {
    var viewer = document.getElementById('f-viewer-results');
    viewer.innerHTML = '';
    for(var i = firstUser; i < maximum; i++) {
        viewer.innerHTML += ('<div class="f-viewer-results-item"><a href="../pages/profile.php?username=' + data[i].pseudo + '"><img src="../img/user-images/'+ data[i].photo_profil +'">'+data[i].pseudo+'</a></div>')
    }
    displayItems(firstUser);
}

function getAllFollowers(username) {
    let url = "../requests/getAllFollowers.php?username=" + username;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            data = JSON.parse(request.responseText);
            nombreSub = data.length;
            if(nombreSub > 8) { setUsers(0, 8); } else { setUsers(0, nombreSub);}
        }
    }
    request.send();
}

window.onload = function() {
    //initialisation de la variable globale nombreSub
    nombreSub = 0


    getAllFollowers(username);
}