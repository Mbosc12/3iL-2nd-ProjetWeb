<?php
$host = "localhost";
$user = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$host", $user, $password);
  // Check error
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE mydb";
  // connexion
  $conn->exec($sql);
  echo "Base de donnée créée<br>";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>