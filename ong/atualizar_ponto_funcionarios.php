<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: index.php');
}

$matricula = $_SESSION['matricula'];   

include "conexao.php";

$id = $_POST['id'];
$descricao = $_POST['descricao'];

$sql = "UPDATE `registro`
        SET `descricao` = '$descricao'
        WHERE iduser = $id";

$atualizar = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="css/bootstrap.css">
<div class="container" style="width: 700px; margin-top: 40px">
  <center>
    <h4>Registro atualizado com sucesso.</h4>
  </center>
  <div style="padding-top: 20px"></div>
  <center>
    <a href="listar_pontos_funcionarios.php" role="button" class="btn btn-success">Voltar</a>
  </center>
</div>