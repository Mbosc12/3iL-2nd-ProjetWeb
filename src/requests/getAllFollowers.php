<?php

require_once('Model.php');

$username = $_GET['username'];
$request = Model::getAllFollowers($username);

echo json_encode($request);
