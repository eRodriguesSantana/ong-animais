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

if(isset($_GET['id_pessoa'])){
    $id_pessoa = $_GET['id_pessoa'];
    $busca = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($busca);

    $sqlHistoricoAdotante = "SELECT * FROM historico_animal WHERE adotante_id = $id_pessoa";
    $buscaHistoricoAdotante = mysqli_query($conn,  $sqlHistoricoAdotante);
    $historico = [];
    while ($dataHistoricoAnimal = mysqli_fetch_array($buscaHistoricoAdotante)) {
        $historico[] = $dataHistoricoAnimal;
    }

    $sqlPessoa = "SELECT * FROM pessoas WHERE id_pessoa = $id_pessoa";
    $buscaPessoa = mysqli_query($conn,  $sqlPessoa);
    $pessoa = $buscaPessoa->fetch_assoc();

    $sqlAnimais = "SELECT * FROM animal";
    $buscaAnimais = mysqli_query($conn,  $sqlAnimais);
    $animais = [];
    while ($animal = mysqli_fetch_array($buscaAnimais)) {
        $animais[] = $animal;
    }
    foreach($animais as $animal){
        $nomesAnimais[$animal['id_animal']] = $animal['nome_animal'];
    }
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

            <?php include('menu_lateral.php') ?>
            <!--Menu lateral FIM-->

            <div id="container-visualizar-pet" class="principal col">
                <h4 class="titulos-topo">Visualizar dados do adotante</h4>
                <div class="btn-grupo-principal">
                    <a href="http://sospirapo.br/crud_pessoas/listar_pessoas_adotantes.php" role="button" class="btn-grupo btn">Voltar</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Visualizar dados do adotante</h5>
                    <div class="visualizar-pet">
                        <div class="dados-pet">
                            <label for="nome_adotante">Nome: <?= $pessoa['nome_completo'] ?></label>
                        </div>
                        <div class="row">
                            <div class="col-6 dados-pet">
                                <label>CPF: <?= $pessoa['cpf'] ?></label>
                            </div>
                            <div class="col-6 dados-pet">
                                <label>Email: <?= $pessoa['email']?> kg</label>
                            </div>
                            <div class="col-6 dados-pet">
                                <label>Endereço: <?= $pessoa['endereco']?></label>
                            </div>
                            <div class="col-6 dados-pet">
                                <label>Telefone: <?= $pessoa['telefone']?></label>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <h5 class="titulo-historico">Histórico de adoções do adotante</h5>
                        <thead>
                            <tr>
                                <!-- <th scope="col">Data de Entrada</th> -->
                                <th scope="col">Data da adoção</th>
                                <th scope="col">Data da cancelamento</th>
                                <th scope="col" class="titulo-motivo">Animal</th>
                                <th scope="col" class="titulo-motivo">Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($historico as $value){ ?>
                                <tr>
                                    <td><?= $value['data_saida'] ?></td>
                                    <td><?= $value['data_entrada'] ?></td>
                                    <td><?= $nomesAnimais[$value['animal_id']] ?></td>
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