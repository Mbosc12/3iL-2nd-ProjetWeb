<?php

	require_once('Model.php');

	$id = $_GET['postId'];

	$request = Model::getLikes($id);

	echo json_encode($request);
