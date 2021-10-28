<?php

	require_once('Model.php');

	$email_1 = $_GET['email_1'];
	$username_2 = $_GET['username_2'];
	$request = Model::getIsSubscribed($email_1, $username_2);

	echo json_encode($request);