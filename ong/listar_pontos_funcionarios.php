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

function formataData($date){
  $newDate = explode("-", $date);
  $newDate2 = explode(" ", $newDate[2]);
    
  return $newDate2[0]."-".$newDate[1]."-".$newDate[0]." ".$newDate2[1]."<br>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <title>Listar Pontos Funcionários</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://kit.fontawesome.com/8786c39b09.js"></script>
  </head>

  <body>
    <div class="container" style="margin-top: 40px; width: 1000px">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1>Listar Pontos Funcionários</h1>
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
            <th scope="col">Nome Usuário</th>
            <th scope="col">Entrada</th>
            <th scope="col">Ida Almoço</th>
            <th scope="col">Volta Almoço</th>
            <th scope="col">Saída</th>
            <th>Ação</th>
          </tr>
        </thead>          
          <?php
            include "conexao.php";

            //$sql = "SELECT * FROM `registro`";
            $sql = "SELECT 
                      u.nome_usuario as nomeUsuario,
                      r.iduser as iduser,
                      r.inicio_expediente as inicio_expediente,
                      r.inicio_almoco as inicio_almoco,
                      r.fim_almoco as fim_almoco,
                      r.fim_expediente as fim_expediente,
                      r.descricao as descricao
                    FROM `registro` as r
                    INNER JOIN usuarios AS u
                    ON r.userid = u.matricula_usuario
                    WHERE r.userid<>$matricula
                    ORDER BY inicio_expediente DESC";
            $busca = mysqli_query($conn, $sql);

            while ($array = mysqli_fetch_array($busca)){
              $iduser = $array['iduser'];
              $nomeUsuario = $array['nomeUsuario'];
              $inicio_expediente = $array['inicio_expediente'];
              $inicio_almoco = $array['inicio_almoco'];
              $fim_almoco = $array['fim_almoco'];
              $fim_expediente = $array['fim_expediente'];           
          ?>
              <tr style="font-size: 14px">
                <td><?php echo $nomeUsuario; ?></td>
                <td><?php echo formataData($inicio_expediente); ?></td>
                <td><?php echo formataData($inicio_almoco); ?></td>
                <td><?php echo formataData($fim_almoco); ?></td>
                <td><?php echo formataData($fim_expediente); ?></td>
                <td>
                  <a class="btn btn-warning btn-sm" href="editar_ponto_funcionarios.php?id=<?php echo $iduser; ?>" 
                    role="button"><i class="fas fa-eye"></i>Visualizar
                  </a>
                </td>
      <?php } ?>
              </tr>
      </table>
    </div>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>

</html>

