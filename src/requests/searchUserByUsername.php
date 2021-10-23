<?php

require_once('Model.php');

// lancement de la requête SQL avec selectByName et
// récupération du résultat de la requête SQL
$search = $_GET['search'];
$requete = Model::selectUserByUsername($search);

// affichage en format JSON du résultat précédent
echo json_encode($requete);
