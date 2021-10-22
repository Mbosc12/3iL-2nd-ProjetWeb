function displayMenu(element) {
    let [menu] = element.parentNode.closest('div').getElementsByClassName('post-dropdown-menu');
    menu.classList.toggle('show');
}

window.onclick = function (event) {
    if (!event.target.matches('.post-dropdown-button')) {
        let [menu] = document.getElementsByClassName('post-dropdown-menu');
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    }
}

function likePost(element) {
    let [like] = document.getElementsByClassName('post-like');
    like.classList.toggle('liked')
    if (like.classList.contains('liked')) {
        element.innerHTML = "<img alt='read-heart' src=\"../img/red_heart.png\">";
    } else {
        element.innerHTML = "<img alt='heart' src=\"../img/heart.svg\">";
    }
}

function commentPost(element) {
    let [commentInput] = element.parentNode.closest('footer').getElementsByClassName('postCommentTextArea');
    commentInput.focus();
}