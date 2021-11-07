function deletePost(id) {
    let url = "../requests/deletePost.php?id="+id;
    let request = new XMLHttpRequest();
    request.open("POST", url, true);
    request.onreadystatechange = function () {
        if (request.status === 200 && request.readyState === 4) {
            console.log(request.responseText)
        }
    }
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send();
}