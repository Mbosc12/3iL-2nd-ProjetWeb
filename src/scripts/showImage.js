//Fonction permettant d'afficher upload dans le input
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
             
        reader.onload = function (e) {
            var showImage = document.getElementById("showImage");
            showImage.setAttribute('src', e.target.result);
            showImage.style.display = 'block';
        }
             
        reader.readAsDataURL(input.files[0]);
    }
}