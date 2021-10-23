function displayNavMenu(element) {
    let [menu] = element.parentNode.closest('div').getElementsByClassName('m-nav-dropdown-menu');
    menu.classList.toggle('show');
}

