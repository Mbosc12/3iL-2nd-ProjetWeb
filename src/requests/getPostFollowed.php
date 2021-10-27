<?php

require_once('Model.php');

$username = $_GET['username'];

$request = Model::getPostsFollowed($username);

echo json_encode($request);
