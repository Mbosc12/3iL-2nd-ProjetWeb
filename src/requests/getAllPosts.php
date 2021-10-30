<?php

	require_once('Model.php');

	$username = $_GET['username'];

	$request = Model::getAllPosts($username);

	echo json_encode($request);
