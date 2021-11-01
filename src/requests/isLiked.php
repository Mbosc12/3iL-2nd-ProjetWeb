<?php

	require_once('Model.php');

	$email = $_GET['email_1'];
	$id = $_GET['postId'];
	$request = Model::isLiked($email, $id);

	echo json_encode($request);
