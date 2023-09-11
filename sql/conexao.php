<?php
$servername = "localhost";
$database = "ong";
$username = "";
$password = "";

try {
    $conn = mysqli_connect($servername, $username, $password, $database);
  } catch (\Throwable $th) {
    throw $th;
  }

?>
