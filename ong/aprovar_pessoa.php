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
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <title>Aprovar Voluntário/Não Voluntário</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://kit.fontawesome.com/8786c39b09.js"></script>
  </head>

  <body>
    <div class="container" style="margin-top: 40px; width: 1000px">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1>Usuários Pendentes de Aprovação</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="adicionar_ponto.php" role="button" class="btn btn-success">Registrar Ponto</a>
            <a class="nav-item nav-link active" href="menu.php" role="button" class="btn btn-primary" style="margin-left: 25px">Voltar</a>
            <a class="nav-item nav-link active" href="sair.php" role="button" class="btn btn-danger" style="margin-left: 25px">Sair</a>
          </div>
        </div>
      </nav>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nome usuário</th>
            <th scope="col">Matrícula usuário</th>
            <th scope="col">Nível usuário</th>
            <th scope="col">Status usuário</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>          
          <?php
            include "conexao.php";

            $sql = "SELECT * FROM `pessoas` WHERE status = 'Inativo'";
            $busca = mysqli_query($conn, $sql);

            while ($array = mysqli_fetch_array($busca)){
              $id_usuario = $array['id_pessoa'];
              $nome_usuario = $array['nome_completo'];
              $matricula_usuario = $array['matriculausuario'];
              $nivel_usuario = $array['nivelUsuario'];
              $status = $array['status'];
          ?>
              <tr>
                <td><?php echo $nome_usuario; ?></td>
                <td><?php echo $matricula_usuario; ?></td>
                <td><?php echo $nivel_usuario; ?></td>
                <td><?php echo $status; ?></td>
                <td>
                  <a class="btn btn-secondary btn-sm" href="_aprovar_pessoa.php?id=<?php echo $id_usuario; ?>&nivel=Voluntario" 
                    role="button"><i class="fas fa-thumbs-up"></i>&nbsp;Voluntário
                  </a>
                  <a class="btn btn-success btn-sm" href="_aprovar_pessoa.php?id=<?php echo $id_usuario; ?>&nivel=NaoVoluntario" 
                    role="button"><i class="fas fa-thumbs-up"></i>&nbsp;Não Voluntário
                  </a>
                  <a class="btn btn-warning btn-sm" href="_aprovar_pessoa.php?id=<?php echo $id_usuario; ?>&nivel=Adotante" 
                    role="button"><i class="fas fa-thumbs-up"></i>&nbsp;Adotante
                  </a>
                  <a class="btn btn-danger btn-sm" href="_deletar_pessoa.php?id=<?php echo $id_usuario; ?>" 
                    role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir
                  </a>
                </td>
      <?php } ?>
              </tr>
      </table>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>    
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>

</html>


