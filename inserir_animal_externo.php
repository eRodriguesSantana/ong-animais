<?php
session_start();

// Impede o acesso direto via url a esse script
if(!$_POST)
{
  unset($_SERVER['nomeusuario']);
  unset($_SESSION['matriculausuario']);
  header('Location:index.php');
}
 
include "conexao.php";

$nome_animal = mysqli_real_escape_string($conn, $_POST['nome_animal']);
$peso_aproximado = mysqli_real_escape_string($conn, $_POST['peso_aproximado']);
$observacao = mysqli_real_escape_string($conn, $_POST['observacao']);
$data_entrada = mysqli_real_escape_string($conn, $_POST['data_entrada']);
$imagem = mysqli_real_escape_string($conn, $_POST['imagem']);

$sql = "INSERT INTO animal (nome_animal, peso_aproximado, observacao, data_entrada, image)
  VALUES ('$nome_animal', $peso_aproximado, '$observacao', '$data_entrada', '$imagem')";

$inserir = mysqli_query($conn, $sql);

mysqli_close($conn);

?>

<title>Inclusão de Animal</title>
<link rel="stylesheet" href="css/bootstrap.css">
<div class="container" style="width: 700px; margin-top: 40px">
  <center>
      <h4>Animal adicionado com suceso S2 :) :D.</h4>
  </center>
  <div style="padding-top: 20px"></div>
  <center>
    <a href="menu.php" role="button" class="btn btn-success">Voltar</a>
  </center>
</div>