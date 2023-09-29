<?php
$servername = "localhost";
$database = "ong";
$username = "root";
$password = "treino";

try {
    $conn = mysqli_connect($servername, $username, $password, $database);
  } catch (\Throwable $th) {
    throw $th;
  }

?>
