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
$nivel = $_GET['nivel'];
$posicao = "";

if($nivel == 'Voluntario'){
  $updte = "UPDATE `pessoas`
            SET status = 'Ativo',
                nivelUsuario = 'Voluntario'
            WHERE id_pessoa = $id";
  $posicao = "Voluntario";
}

if($nivel == 'NaoVoluntario'){
  $updte = "UPDATE `pessoas`
            SET status = 'Ativo',
            nivelUsuario = 'Não Voluntario'
            WHERE id_pessoa = $id";
  $posicao = "Não Voluntario";
}

if($nivel == 'Adotante'){
  $updte = "UPDATE `pessoas`
            SET status = 'Ativo',
            nivelUsuario = 'Adotante'
            WHERE id_pessoa = $id";
  $posicao = "Adotante";
}

$atualizacao = mysqli_query($conn, $updte);
?>

<title>Inclusão de Usuário</title>
<link rel="stylesheet" href="css/bootstrap.css">
<div class="container" style="width: 700px; margin-top: 40px">
  <center>
    <h4>Aprovação de <?php echo $posicao; ?> realizada com sucesso.</h4>
  </center>
  <center>
    <form action="" method="post">
      <a href="aprovar_pessoa.php" role="button" class="btn btn-success">Voltar</a>
    </form>
  </center>
</div>