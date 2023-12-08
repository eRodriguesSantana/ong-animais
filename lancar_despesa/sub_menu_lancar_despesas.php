<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: ../index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

$sql = "SELECT nivelUsuario FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nivel = $arr['nivelUsuario'];
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>ONG Sistema de Adoção Pet</title>
  </head>

  <body>
    <div id="ong" class="container-ong">
      <div class="row">

        <?php include('../menu_lateral.php') ?>
        <!--Menu lateral FIM-->
        
        <div class="container" style="margin-top: 10%">
        <h4 class="titulos-topo" style="text-align: center">Lançamento de Despesas</h4>
       
        <div class="row">
          <div class="col-sm-6">
            <div class="card espaco-card">
              <div class="card-body card-altura card-inicio">
                <h5 class="card-title">Gerenciar Pagamentos</h5>
                <p class="card-text">Cadastro e listagem de pagamentos.</p>
                <div class="botao-card-inicio">
                  <a href="pagamento/cadastro_pagamento.php" class="btn btn-card">Adicionar Pagamentos</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card espaco-card">
              <div class="card-body card-altura card-inicio">
                <h5 class="card-title">Gerenciar Compras</h5>
                <p class="card-text">Cadastro e listagem de compras.</p>
                <div class="botao-card-inicio">
                  <a href="compra/cadastro_compra.php" class="btn btn-card">Adicionar Compras</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  </body>
</html>