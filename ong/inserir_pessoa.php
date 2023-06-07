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

$nomeusuario = mysqli_real_escape_string($conn, $_POST['nomeusuario']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
$cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
$nivelUsuario = mysqli_real_escape_string($conn, $_POST['nivelUsuario']);

if($nivelUsuario == 'Voluntario' || $nivelUsuario == 'NaoVoluntario'){
  $status = mysqli_real_escape_string($conn, "Inativo");
  $matriculausuario = mysqli_real_escape_string($conn, $_POST['matriculausuario']);
} else {
  $status = mysqli_real_escape_string($conn, "Ativo");
  $matriculausuario = mysqli_real_escape_string($conn, '');
}

$sql = "INSERT INTO pessoas (nome_completo, email, cpf, endereco, telefone, matriculausuario,
          nivelUsuario, status)
        VALUES ('$nomeusuario', '$email', '$cpf', '$endereco', '$telefone', '$matriculausuario', 
          '$nivelUsuario', '$status')";

$inserir = mysqli_query($conn, $sql);
?>

<title>Inclusão de Usuário</title>
<link rel="stylesheet" href="css/bootstrap.css">
<div class="container" style="width: 700px; margin-top: 40px">
  <center>
    <?php if($nivelUsuario == 'Voluntario' || $nivelUsuario == 'NaoVoluntario'){ ?>
      <h4>Usuário adicionado e pendente de ativação.</h4>
    <?php } else {?>
      <h4>Usuário adicionado e ativo com sucesso.</h4>
    <?php } ?>
  </center>
  <div style="padding-top: 20px"></div>
  <center>
    <a href="index.php" role="button" class="btn btn-success">Voltar</a>
  </center>
</div>