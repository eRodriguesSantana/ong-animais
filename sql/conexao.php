<?php
$servername = "localhost";
$database = "ong";
$username = "sospirapo";
$password = "root";
date_default_timezone_set('America/Sao_Paulo');

try {
    $conn = mysqli_connect($servername, $username, $password, $database);
  } catch (\Throwable $th) {
    throw $th;
  }

?>
