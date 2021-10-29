<?php

	require_once('Model.php');

	$username = $_GET['username'];
	$request = Model::getCountSubscriptions($username);

	echo json_encode($request);
