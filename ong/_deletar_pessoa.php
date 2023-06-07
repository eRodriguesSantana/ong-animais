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

$id = $_GET['id'];

$delete = "DELETE FROM `pessoas` WHERE id_pessoa = $id";
$deletar = mysqli_query($conn, $delete);
?>

<link rel="stylesheet" href="css/bootstrap.css">
<div class="container" style="width: 700px; margin-top: 40px">
  <center>
    <h4>Exclusão de usuário realizada com sucesso.</h4>
  </center>
  <center>
    <form action="" method="post">
      <a href="aprovar_pessoa.php" role="button" class="btn btn-success">Voltar</a>
    </form>
  </center>
</div>