<?php

require_once('Model.php');

$mail = $_GET['mail'];

$request = Model::selectUser($mail);

echo json_encode($request);
