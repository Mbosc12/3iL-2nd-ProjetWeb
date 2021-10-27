<?php

require_once('Model.php');

$id = $_GET['id'];

$request = Model::getLikes($id);

echo json_encode($request);
