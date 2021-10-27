<?php

require_once('Model.php');

$id = $_GET['id'];

$request = Model::getPost($id);

echo json_encode($request);
