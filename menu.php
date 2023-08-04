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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title>ONG Sistema de Adoção Pet</title>
</head>

<body>
  <div id="ong" class="container-ong">
    <div class="row">
      <div id="menu-lateral" class="col-2">
        <div class="titulos-ong">
          <h4>ONG</h4>
          <h4>Animais Pirapozinho</h4>
        </div>
        <div class="btn-group-vertical" role="group" aria-label="Basic example">
          <a href="menu.php" class="btn-menu btn" role="button">Início</a> 
          <button type="button" class="btn-menu btn">Gerenciar Pessoas</button>
          <div class="btn-group" role="group">
            <button type="button" class="btn-menu btn dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"> Gerenciar Pets</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a class="dropdown-item" href="#">Entrada Pet</a>
              <a class="dropdown-item" href="#">Saída Pet</a>
            </div>
          </div>
          <button type="button" class="btn-menu btn">Gerenciar Produtos</button>
          <button type="button" class="btn-menu btn">Gerenciar Fornecedores</button>
          <div class="btn-group" role="group">
            <button type="button" class="btn-menu btn dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"> Financeiro</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a class="dropdown-item" href="#">Registrar Despesas</a>
              <a class="dropdown-item" href="#">Registrar Compras</a>
              <a class="dropdown-item" href="#">Registrar Doação</a>
            </div>
          </div>
        </div>
        <div class="sair-rodape">
          <a class="btn-sair" href="#"><span><i class="bi bi-person-circle"></i></span>Nome do Usuário
              Logado: <?php echo $nome_completo; ?></a>
          <a class="btn-sair" href="sair.php"><span><i class="bi bi-box-arrow-right"></i></span>Sair</a>
        </div>
      </div> <!--Menu lateral FIM-->
      <div id="container-menu" class="principal col" style="height: 100vh;">
        <div>
          <div class="container">
      
            <div class="row">       
              <div class="col-sm-6">
                <div class="card espaco-card">
                  <div class="card-body card-altura">
                    <h5 class="card-title">Adicionar Registro de Voluntariado</h5>
                    <p class="card-text">Opção para gravar marcações diárias dentro do expediente na ONG.</p>
                    <!--<a href="adicionar_ponto.php?mat=<?php echo $matricula; ?>" class="btn btn-primary">Adicionar Registro</a>-->
                    <a href="adicionar_ponto.php" class="btn btn-primary">Adicionar Registro</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card espaco-card">
                  <div class="card-body card-altura">
                    <h5 class="card-title">Listar Registros de Pontos</h5>
                    <p class="card-text">Opção para visualizar, editar e excluir registros cadastrados.</p>
                    <a href="listar_pontos.php" class="btn btn-primary">Listar Registros</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card espaco-card">
                  <div class="card-body card-altura">
                    <h5 class="card-title">Adicionar Usuário / Adotante</h5>
                    <p class="card-text">Opção para adicionar usuário (pendente de ativação do perfil criado) ou adotante (permissão já incluída e com cadastro sem necessidade de aprovação).</p>
                    <a href="cadastro_pessoa.php" class="btn btn-primary">Adicionar Usuário / Adotante</a>
                  </div>
                </div>
              </div>
              <?php
                if(($matricula == 12)){
              ?>
              <div class="col-sm-6">
                <div class="card espaco-card">
                  <div class="card-body card-altura">
                    <h5 class="card-title">Ativar Voluntariados</h5>
                    <p class="card-text">Ativar cadastro de voluntário.</p>
                    <a href="aprovar_pessoa.php" class="btn btn-primary">Ativar Voluntariados</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card espaco-card">
                  <div class="card-body card-altura">
                    <h5 class="card-title">Cadastrar animais</h5>
                    <p class="card-text">Opção para cadastrar animais abandonados.</p>
                    <a href="crud_animal/cadastro_animal.php" class="btn btn-primary">Adicionar Animal :)</a>
                  </div>
                </div>
              </div>
              <?php
                if(($nivel == 'Voluntario' || $nivel == 'NaoVoluntario')){
              ?>
                <div class="col-sm-6">
                  <div class="card espaco-card">
                    <div class="card-body card-altura">
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
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>