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

include "../conexao.php";

$sql = "SELECT nivelUsuario FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nivel = $arr['nivelUsuario'];
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <title>Opções</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">   
  </head>

  <body>
    <div class="container" style="margin-top: 100px">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#" role="button" class="btn btn-danger" style="margin-left: 25px">
              Matrícula: <?php echo $matricula; ?></a>
            <a class="nav-item nav-link active" href="../sair.php" role="button" class="btn btn-danger" style="margin-left: 25px">Sair</a>
          </div>
      </nav>
      <div class="row">       
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adicionar registro de cachorro abandonado</h5>
              <p class="card-text">Opção para gravar registro de entrada de cachorro(a) na ONG.</p>
                <a href="cadastrar_cao.php" class="btn btn-primary">Adicionar registro de cachorro abandonado</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Listar registros de cachorros na ONG</h5>
              <p class="card-text">Opção para visualizar, editar e excluir cachorros cadastrados.</p>
              <a href="listagem_caes.php" class="btn btn-primary">Listar registros de cachorros na ONG</a>
            </div>
          </div>
        </div>
      </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>