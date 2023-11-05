<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    unset($_SESSION['matricula']);
    header('Location: index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

$id_animal = $_POST['id_animal'];
$observacao = $_POST['observacao'];

$atualiza_situacao_animal = "UPDATE animal
        SET 
          situacao = 0
        WHERE id_animal = $id_animal";

$atualizar = mysqli_query($conn, $atualiza_situacao_animal);

$atualiza_situacao_adocao = "UPDATE adocao
        SET 
          situacao = 0
        WHERE id_animal = $id_animal";


$visualizar_adotante = "SELECT id_adotante FROM adocao
    WHERE id_animal = $id_animal";
$visualizar = mysqli_query($conn, $visualizar_adotante);
$visualizar_adotante_id = mysqli_fetch_assoc($visualizar);
$adotante_id = $visualizar_adotante_id['id_adotante'];

$data_entrada = date('d/m/Y H:i:s', time());
$atualizar_adocao = mysqli_query($conn, $atualiza_situacao_adocao);
$sqlHistoricoAnimal = "INSERT INTO historico_animal (data_entrada,data_saida,motivo_cancelamento,adotante_id,animal_id)
        VALUES ('$data_entrada', null, '$observacao', $adotante_id, $id_animal);";
$inserirHistoricoAnimal = mysqli_query($conn, $sqlHistoricoAnimal);
// echo "Error: " . $sqlHistoricoAnimal . "<br>" . mysqli_error($conn);
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

            <?php include('../menu_lateral.php') ?>
            <!--Menu lateral FIM-->

            <div id="container-cadastro-pet" class="principal col" style="height: 100vh;">
                <div class="cadastro-pet">
                    <div class="btn-cadastrar text-center">
                        <h4 class="titulos-topo">Cancelamento de adoção realizado com sucesso.</h4>
                        <div style="padding-top: 20px"></div>
                        <a href="listar_adocao.php" role="button" class="btn btn-success">Voltar</a>
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