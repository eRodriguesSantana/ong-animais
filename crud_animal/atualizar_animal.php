<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
  unset($_SESSION['matricula']);
  header('Location: ../index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = '$matricula' and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

$id_animal = $_POST['id_animal'];

if (isset($_POST['imagem']))
  $imagem = $_POST['imagem'];
else
  $imagem = "";

$nome_animal = $_POST['nome_animal'];
$sexo_animal = $_POST['sexo_animal'];
$tipo_animal = $_POST['tipo_animal'];

if (isset($_POST['raca_gato']))
  $raca_gato = $_POST['raca_gato'];
else
  $raca_gato = 0;

if (isset($_POST['raca_cao']))
  $raca_cao = $_POST['raca_cao'];
else
  $raca_cao = 0;

$cor_animal = $_POST['cor_animal'];
$porte_animal = $_POST['porte_animal'];
$peso_aproximado = $_POST['peso_aproximado'];
$observacao = $_POST['observacao'];
$data_entrada = $_POST['data_entrada'];

$sql = "UPDATE animal
        SET 
          imagem = '$imagem',
          nome_animal = '$nome_animal',
          sexo_animal = '$sexo_animal',
          tipo_animal = '$tipo_animal',
          raca_gato = $raca_gato,
          raca_cao = $raca_cao,
          cor_animal = '$cor_animal',
          porte_animal = '$porte_animal',
          peso_aproximado = '$peso_aproximado',
          observacao = '$observacao',
          data_entrada = '$data_entrada'
        WHERE id_animal = $id_animal";

$atualizar = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-b">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
  <!--Bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>ONG Sistema de Adoção Pet</title>
</head>

<body>
  <div id="ong" class="container-ong">
    <div class="row">

      <?php include('menu_lateral.php') ?>
      <!--Menu lateral FIM-->

      <div id="container-cadastro-pet" class="principal col" style="height: 100vh;">
        <div class="cadastro-pet">
          <div class="btn-cadastrar text-center">
            <h4 class="titulos-topo">Registro do animal <strong><?php echo $nome_animal; ?></strong> atualizado com sucesso.</h4>
            <div class="btn btn-grupo">
              <a href="http://sospirapo.br/crud_animal/listar_animais.php" role="button" class="">Voltar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--JS do Bootstrap-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>