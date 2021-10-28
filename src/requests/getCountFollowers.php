<?php

	require_once('Model.php');

	$username = $_GET['username'];
	$request = Model::getCountFollowers($username);

	echo json_encode($request);
