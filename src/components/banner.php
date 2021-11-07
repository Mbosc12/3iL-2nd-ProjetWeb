<div>
<?php 
        if(isset($_GET['error'])) {
            if($_GET['msg'] == 0) {
                echo '
                <div class="banner b-red">
                    <span class="b-span"> Votre changement n\'a pas été pris en compte </span>
                </div>';
            } else if($_GET['msg'] == 1) {
                echo '
                <div class="banner b-red">
                    <span class="b-span"> La connexion n\'a pas pu être établie </span>
                </div>';
            } else if($_GET['msg'] == 2) {
                echo '
                <div class="banner b-red">
                    <span class="b-span"> L\'inscription n\'a pas pu être validée. E-mail ou utilisateur déjà utilisé. </span>
                </div>';
            }
        } else {
            if($_GET['msg'] == 0) {
                echo '<div class="banner b-green">
                    <span class="b-span"> Votre changement a bien été pris en compte </span>
                </div>';
            } else if ($_GET['msg'] == 1) {
                echo '<div class="banner b-green">
                <span class="b-span"> L\'utilisateur a bien été crée </span>
                </div>';
            }
        }
    ?>
</div>