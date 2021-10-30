<?php

	require_once('Model.php');

	$username_2 = $_GET['username_2'];
	$email_1 = $_GET['email_1'];
	Model::followUser($email_1, $username_2);
