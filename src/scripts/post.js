function displayPostMenu(element) {
    let [menu] = element.parentNode.closest('div').getElementsByClassName('post-dropdown-menu');
    menu.classList.toggle('show');
}

function likePost(element) {
    let [like] = document.getElementsByClassName('post-like');
    like.classList.toggle('liked')
    if (like.classList.contains('liked')) {
        element.innerHTML = "<img alt='read-heart' src=\"../img/icons/red_heart.png\">";
    } else {
        element.innerHTML = "<img alt='heart' src=\"../img/icons/heart.svg\">";
    }
}

function commentPost(element) {
    let [commentInput] = element.parentNode.closest('footer').getElementsByClassName('postCommentTextArea');
    commentInput.focus();
}