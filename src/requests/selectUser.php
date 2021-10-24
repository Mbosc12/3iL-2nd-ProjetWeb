<?php

require_once('Model.php');

$username = $_GET['username'];

$request = Model::selectUser($username);

echo json_encode($request);
