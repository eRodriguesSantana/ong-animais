<?php
session_start();

// Se o usu�rio n�o estiver logado e tentar acessar a p�gina diretamente pela url
// o mesmo ser� redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: index.php');
}

$matricula = $_SESSION['matricula'];

include "conexao.php";

$entradaExp = (isset($_POST['entradaExp'])) ? mysqli_real_escape_string($conn, $_POST['entradaExp']) : '';
$entradaAlm = (isset($_POST['entradaAlm'])) ? mysqli_real_escape_string($conn, $_POST['entradaAlm']) : '';
$saidaAlm   = (isset($_POST['saidaAlm'])) ? mysqli_real_escape_string($conn, $_POST['saidaAlm']) : '';
$saidaExp   = (isset($_POST['saidaExp'])) ? mysqli_real_escape_string($conn, $_POST['saidaExp']) : '';
$descricao  = (isset($_POST['descricao'])) ? mysqli_real_escape_string($conn, $_POST['descricao']) : '';

function formataData($date){
  $newDate = str_replace("/", "-", $date);
  $newDate = explode("-", $newDate);
  $newDate2 = explode(" ", $newDate[2]);
  
  return $newDate2[0]."-".$newDate[1]."-".$newDate[0]." ".$newDate2[1];
}

$sql = "INSERT INTO `registro` (`inicio_expediente`, `inicio_almoco`, `fim_almoco`, `fim_expediente`, 
        `descricao`, `userid`)
        VALUES('".formataData($entradaExp)."', '".formataData($entradaAlm)."', '".
                  formataData($saidaAlm)."', '".formataData($saidaExp)."', '$descricao', $matricula)";

$inserir = mysqli_query($conn, $sql);

mysqli_close($conn);

?>

<title>Ponto Marcado</title>
<link rel="stylesheet" href="css/bootstrap.css">
<div class="container" style="width: 700px; margin-top: 40px">
  <center>
    <h4>Registro adicionado com sucesso.</h4>
  </center>
  <div style="padding-top: 20px"></div>
  <center>
    <a href="adicionar_ponto.php" role="button" class="btn btn-success">Registro de Ponto</a>
  </center>
</div>
