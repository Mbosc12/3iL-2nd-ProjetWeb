window.onclick = function (event) {
    if (!event.target.matches('.m-nav-dropdown-button')) {
        let [menu] = document.getElementsByClassName('m-nav-dropdown-menu');
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }

    if (!event.target.matches('.post-dropdown-button')) {
        let [menu] = document.getElementsByClassName('post-dropdown-menu');
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }
}