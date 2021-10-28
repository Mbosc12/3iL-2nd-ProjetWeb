window.onclick = function (event) {
    if (!event.target.matches('.m-nav-dropdown-button')) {
        let [menu] = document.getElementsByClassName('m-nav-dropdown-menu');
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }

    if (!event.target.matches('.post-dropdown-button')) {
        let [menu] = document.getElementsByClassName('post-dropdown-menu');
        if (menu && menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }

    if (!event.target.matches('#m-nav-search')) {
        let results = document.getElementById('m-nav-search-results');
        let searchField = document.getElementById('m-nav-search-input');
        searchField.firstElementChild.value = '';
        results.style.display = 'none';
    }
}