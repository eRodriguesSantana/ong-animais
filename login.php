<?php
session_start();
$_SESSION['matricula'] = $_POST['matricula'];
$_SESSION['senha'] = $_POST['senha'];

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: index.php');
}

$matricula = $_POST['matricula'];
$senha = $_POST['senha'];

include "sql/conexao.php";

$sql = "SELECT matriculausuario 
        FROM pessoas 
        WHERE 
          matriculausuario = '$matricula'
          AND status = 'Ativo'
          AND senha = SHA1('$senha')";
$buscar = mysqli_query($conn, $sql);

$total = mysqli_num_rows($buscar);
if($buscar && $total == 1)
{
  $_SESSION['matricula'] = $matricula;
  header("Location: menu.php");
}
else{
  unset ($_SESSION['matricula']);
  unset ($_SESSION['senha']);
  $_SESSION['message_login'] = true;
  header('Location: index.php');
}
?>
