<?php
$servername = "localhost";
$database = "ong";
$username = "root";
$password = "root";

try {
    $conn = mysqli_connect($servername, $username, $password, $database);
  } catch (\Throwable $th) {
    throw $th;
  }

?>
