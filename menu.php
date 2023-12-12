<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
  unset($_SESSION['matricula']);
  header('Location: index.php');
}

$matricula = $_SESSION['matricula'];

include "sql/conexao.php";

$sql = "SELECT nivelUsuario, nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];
$nivel = $arr['nivelUsuario']
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-b">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>ONG Sistema de Adoção Pet</title>
</head>

<body>
  <div id="ong" class="container-ong">
    <div class="row">

      <?php include('menu_lateral.php') ?>
      <!--Menu lateral FIM-->

      <div id="container-menu" class="principal col">
        <div>
          <div class="container">

            <div class="row top-80">
              <!--<div class="col-sm-4">
                <div class="card espaco-card">
                  <div class="card-body card-altura card-inicio">
                    <h5 class="card-title">Adicionar Registro de Voluntário</h5>
                    <p class="card-text">Opção para controle de ponto diário na ONG.</p>
                    <a href="adicionar_ponto.php?mat=<?php echo $matricula; ?>" class="btn btn-primary">Adicionar Registro</a>
                    <div class="botao-card-inicio">
                      <a href="adicionar_ponto.php" class="btn btn-card">Adicionar Registro</a>
                    </div>
                  </div>
                </div>
              </div>-->
              <!--<div class="col-sm-4">
                <div class="card espaco-card">
                  <div class="card-body card-altura card-inicio">
                    <h5 class="card-title">Listar Registros de Pontos</h5>
                    <p class="card-text">Opção para visualizar, editar e excluir registros de pontos cadastrados.</p>
                    <div class="botao-card-inicio">
                      <a href="listar_pontos.php" class="btn btn-card">Visualizar Registros</a>
                    </div>
                  </div>
                </div>
              </div>-->
              <div class="col-sm-4">
                <div class="card espaco-card">
                  <div class="card-body card-altura card-inicio">
                    <h5 class="card-title">Gerenciar Usuários</h5>
                    <p class="card-text">Cadastro e listagem de usuários, voluntários e não voluntários.</p>
                    <div class="botao-card-inicio">
                      <a href="crud_pessoas/listar_pessoas.php" class="btn btn-card">Adicionar Usuários</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              if (($matricula == 12)) {
              ?>
                <div class="col-sm-4">
                  <div class="card espaco-card">
                    <div class="card-body card-altura card-inicio">
                      <h5 class="card-title">Ativar Voluntários</h5>
                      <p class="card-text">Controle de ativação e desativação de cadastro de voluntários.</p>
                      <div class="botao-card-inicio">
                        <a href="crud_pessoas/aprovar_pessoa.php" class="btn btn-card">Ativar Voluntarios</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <div class="col-sm-4">
                <div class="card espaco-card">
                  <div class="card-body card-altura card-inicio">
                    <h5 class="card-title">Gerenciar Animais</h5>
                    <p class="card-text">Opção para cadastrar animais que estão chegando na ONG.</p>
                    <div class="botao-card-inicio">
                      <a href="crud_animal/listar_animais.php" class="btn btn-card">Adicionar Animal</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card espaco-card">
                  <div class="card-body card-altura card-inicio">
                    <h5 class="card-title">Gerenciar Adoção</h5>
                    <p class="card-text">Opção para gerenciar adoção de animais da ONG.</p>
                    <div class="botao-card-inicio">
                      <a href="crud_adocao/listar_adocao.php" class="btn btn-card">Adicionar Adoção</a>
                    </div>
                  </div>
                </div>
              </div>      
              <div class="col-sm-4">
                <div class="card espaco-card">
                  <div class="card-body card-altura card-inicio">
                    <h5 class="card-title">Adicionar Usuários</h5>
                    <p class="card-text">Opção para adicionar usuário (pendente de ativação do perfil criado) ou adotante.</p>
                    <div class="botao-card-inicio">
                      <a href="crud_pessoas/cadastro_pessoa.php" class="btn btn-card">Adicionar Usuário/Adotante</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card espaco-card">
                  <div class="card-body card-altura card-inicio">
                    <h5 class="card-title">Gerenciar Doação</h5>
                    <p class="card-text">Opção para gerenciar doações.</p>
                    <div class="botao-card-inicio">
                      <a href="crud_doacao/listar_doacoes.php" class="btn btn-card">Gerenciar Doação</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
