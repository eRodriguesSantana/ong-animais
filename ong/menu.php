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
    <link rel="stylesheet" href="css/bootstrap.css">   
  </head>

  <body>
    <div class="container" style="margin-top: 100px">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#" role="button" class="btn btn-danger" style="margin-left: 25px">
              Matrícula: <?php echo $matricula; ?></a>
            <a class="nav-item nav-link active" href="sair.php" role="button" class="btn btn-danger" style="margin-left: 25px">Sair</a>
          </div>
      </nav>
      <div class="row">       
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adicionar Registro de Voluntariado</h5>
              <p class="card-text">Opção para gravar marcações diárias dentro do expediente na ONG.</p>
              <!--<a href="adicionar_ponto.php?mat=<?php echo $matricula; ?>" class="btn btn-primary">Adicionar Registro</a>-->
              <a href="adicionar_ponto.php" class="btn btn-primary">Adicionar Registro</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Listar Registros de Pontos</h5>
              <p class="card-text">Opção para visualizar, editar e excluir registros cadastrados.</p>
              <a href="listar_pontos.php" class="btn btn-primary">Listar Registros</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6" style="margin-top: 20px">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adicionar Usuário / Adotante</h5>
              <p class="card-text">Opção para adicionar usuário (pendente de ativação do perfil criado) ou adotante (permissão já incluída e com cadastro sem necessidade de aprovação).</p>
              <a href="cadastro_pessoa_externo.php" class="btn btn-primary">Adicionar Usuário / Adotante</a>
            </div>
          </div>
        </div>
        <?php
          if(($nivel == 'Gerente')){
        ?>
        <div class="col-sm-6" style="margin-top: 20px">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ativar Voluntariados</h5>
              <p class="card-text">Ativar cadastro de voluntário.</p>
              <a href="aprovar_pessoa.php" class="btn btn-primary">Ativar Voluntariados</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6" style="margin-top: 20px">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adicionar animal</h5>
              <p class="card-text">Opção para cadastrar animal abandonado.</p>
              <a href="cadastro_animal.php" class="btn btn-primary">Adicionar animal</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6" style="margin-top: 20px">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Exibir animais cadastrados</h5>
              <p class="card-text">Opção para visualizar todos animais cadastrados na ONG.</p>
              <a href="listar_animais.php" class="btn btn-primary">Exibir animais cadastrados</a>
            </div>
          </div>
        </div>
        <?php
          if(($nivel == 'Voluntario' || $nivel == 'NaoVoluntario')){
        ?>
          <div class="col-sm-6" style="margin-top: 20px">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Adicionar Usuário / Adotante</h5>
                <p class="card-text">Opção para adicionar usuário (pendente de ativação do perfil criado) ou adotante (permissão já incluída e com cadastro sem necessidade de aprovação).</p>
                <a href="cadastro_pessoa.php" class="btn btn-primary">Adicionar Usuário / Adotante</a>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } ?>        
      </div>      
    </div>

    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>