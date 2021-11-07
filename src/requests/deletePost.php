<?php

require_once('Model.php');

$id = $_GET['id'];
$request = Model::deletePost($id);
?>