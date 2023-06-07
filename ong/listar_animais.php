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

/*$sql = "SELECT matriculausuario FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nivel = $arr['matriculausuario'];*/

function formataData($date){
  $newDate = explode("/", $date);
  $newDate2 = explode(" ", $newDate[2]);
    
  return $newDate2[0]."-".$newDate[1]."-".$newDate[0]." ".$newDate2[1]."<br>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <title>Listagem de Animais</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://kit.fontawesome.com/8786c39b09.js"></script>
  </head>

  <body>
    <div class="container" style="margin-top: 40px; width: 1000px">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1>Listar Animais</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="cadastro_animal.php" role="button" class="btn btn-success">Adicionar Animal</a>
            <a class="nav-item nav-link active" href="menu.php" role="button" class="btn btn-primary" style="margin-left: 25px">Voltar</a>
            <a class="nav-item nav-link active" href="sair.php" role="button" class="btn btn-danger" style="margin-left: 25px">Sair</a>
          </div>
        </div>
      </nav>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Entrada</th>
            <th scope="col">Nome Animal</th>
            <th scope="col">Peso Aproximado</th>
            
            <th>Ação</th>
          </tr>
        </thead>          
          <?php
            include "conexao.php";

            $sql = "SELECT * 
                   FROM animal 
                   ORDER BY id_animal ASC";
            $busca = mysqli_query($conn, $sql);

            while ($array = mysqli_fetch_array($busca)){
                $id_animal = $array['id_animal'];
                $data_entrada = $array['data_entrada'];
                $nome_animal = $array['nome_animal'];
                $peso_aproximado = $array['peso_aproximado'];           
          ?>
              <tr style="font-size: 14px">
                <td><?php echo formataData($data_entrada); ?></td>
                <td><?php echo $nome_animal; ?></td>
                <td><?php echo $peso_aproximado; ?></td>
                
                <td>
                  <?php
                    if(($matricula == 2) || $matricula == 12){
                  ?>
                  <a class="btn btn-warning btn-sm" href="editar_animal.php?id_animal=<?php echo $id_animal; ?>" 
                    role="button"><i class="fas fa-eye"></i>Visualizar
                  </a>            
                  <?php } 
                    else
                      echo "Sem permissão para alterar ou excluir. Solicite ao seu Gerente/Supervisor"
                  ?>
                </td>
        <?php } ?>
              </tr>
      </table>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>

</html>

