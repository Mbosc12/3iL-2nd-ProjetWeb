<?php

	require_once('Model.php');

	$email = $_GET['email'];

	$request = Model::getAllPosts($email);

	echo json_encode($request);
