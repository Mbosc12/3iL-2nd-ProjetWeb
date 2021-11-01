<?php

	require_once('Model.php');
	$email = $_GET['email_1'];
	$id = $_GET['postId'];
	Model::removeLike($email, $id);
