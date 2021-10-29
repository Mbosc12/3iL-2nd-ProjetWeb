function displayNavMenu(element) {
    let [menu] = element.parentNode.closest('div').getElementsByClassName('m-nav-dropdown-menu');
    menu.classList.toggle('show');
}

function displaySearchResults(users) {
    clearSearchResults();
    let searchResults = document.getElementById('m-nav-search-results');
    if (users.length !== 0) {
        for (let user of users) {
            let div = document.createElement("div");
            let username = user.pseudo;
            div.innerHTML = "<a class='m-nav-search-results-item' href='../pages/profile.php?username=" + username + "'>" +
                "<img src='#'>" + username +
                "</a>";
            searchResults.appendChild(div);
        }
        searchResults.style.display = 'block';
    } else {
        searchResults.innerHTML = "<div id='m-nav-search-results-no'>Aucun résultat</div>";
        searchResults.style.display = 'block';
    }
}

function clearSearchResults() {
    let div = document.getElementById('m-nav-search-results');
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }
}

function searchUser(search) {
    let url = "../requests/searchUserByUsername.php?search=" + search;
    let request = new XMLHttpRequest();
    request.open("GET", url, true);
    request.addEventListener("load", function () {
        let data = JSON.parse(request.responseText);
        displaySearchResults(data);
    });
    request.send(null);
}

window.addEventListener('DOMContentLoaded', () => {
    let input = document.getElementById('m-nav-search-input').firstElementChild;
    input.addEventListener('input', () => {
        if (input.value !== '') {
            searchUser(input.value);
        } else {
            clearSearchResults();
            document.getElementById('m-nav-search-results').style.display = 'none';
        }
    });
});

