<?php
$servername = "localhost";
$database = "ong";
$username = "root";
$password = "root";
date_default_timezone_set('America/Sao_Paulo');

try {
    $conn = mysqli_connect($servername, $username, $password, $database);
  } catch (\Throwable $th) {
    throw $th;
  }

?>
