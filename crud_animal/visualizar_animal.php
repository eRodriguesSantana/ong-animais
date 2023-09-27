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

if(isset($_GET['id_animal'])){
    $id_animal = $_GET['id_animal'];

    $sql = "SELECT * FROM animal WHERE id_animal = $id_animal";
    $busca = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($busca);

    $sqlHistoricoAnimal = "SELECT * FROM historico_animal WHERE animal_id = $id_animal";
    $buscaHistoricoAnimal = mysqli_query($conn,  $sqlHistoricoAnimal);
    $historico = [];
    while ($dataHistoricoAnimal = mysqli_fetch_array($buscaHistoricoAnimal)) {
        $historico[] = $dataHistoricoAnimal;
    }

    $adotanteID = $dataHistoricoAnimal['adotante_id'];
    $sqlPessoa = "SELECT * FROM pessoas";
    $buscaPessoa = mysqli_query($conn,  $sqlPessoa);
    $pessoas = [];
    while ($dataPessoa = mysqli_fetch_array($buscaPessoa)) {
        $pessoas[$dataPessoa['id_pessoa']] = $dataPessoa['nome_completo'];
    }

    $raca = "";
    if($data['tipo_animal'] == "Gato"){
        $sql_gato = "SELECT distinct raca_gato.nome_raca_gato 
            FROM raca_gato
            WHERE raca_gato.id_raca_gato = " . $data['raca_gato'] .";";
        $busca_gato = mysqli_query($conn, $sql_gato);
        $result_gato = $busca_gato->fetch_assoc();
        $raca = $result_gato['nome_raca_gato'];
    }
    else{
        $sql_cao = "SELECT distinct raca_cao.nome_raca_cao 
            FROM raca_cao
            WHERE raca_cao.id_raca_cao = " . $data['raca_cao'] .";";
        $busca_cao = mysqli_query($conn, $sql_cao);
        $result_cao = $busca_cao->fetch_assoc();
        $raca = $result_cao['nome_raca_cao'];
    }
    $data['raca_animal'] = $raca;
}
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

            <div id="container-visualizar-pet" class="principal col">
                <h4 class="titulos-topo">Visualizar dados do animal</h4>
                <div class="btn-grupo-principal">
                    <a href="listar_animais.php" role="button" class="btn-grupo btn">Voltar</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Visualizar dados do animal</h5>
                    <div class="visualizar-pet">
                        <div class="dados-pet">
                            <label for="nome_animal">Nome: <?= $data['nome_animal'] ?></label>
                        </div>
                        <div class="row">
                            <div class="col-6 dados-pet">
                                <label>Sexo: <?= $data['sexo_animal'] ?></label>
                            </div>
                            <div class="col-6 dados-pet">
                                <label>Peso: <?= $data['peso_aproximado']?> kg</label>
                            </div>
                            <div class="col-6 dados-pet">
                                <label>Tipo: <?= $data['tipo_animal']?></label>
                            </div>
                            <div class="col-6 dados-pet">
                                <label>Raça: <?= $data['raca_animal']?></label>
                            </div>
                            <div class="col-12 dados-pet">
                                <label>Observação: <?= $data['observacao']?></label>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <h5 class="titulo-historico">Histórico do animal</h5>
                        <thead>
                            <tr>
                                <th scope="col">Data de Entrada</th>
                                <th scope="col">Data de Saída</th>
                                <th scope="col" class="titulo-motivo">Adotante</th>
                                <th scope="col" class="titulo-motivo">Motivo do cancelamento da adoção:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($historico as $value){ ?>
                                <tr>
                                    <td><?= $value['data_entrada'] ?></td>
                                    <td><?= $value['data_saida'] ?></td>
                                    <td><?= $pessoas[$value['adotante_id']] ?></td>
                                    <td><?= $value['motivo_cancelamento'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div>

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