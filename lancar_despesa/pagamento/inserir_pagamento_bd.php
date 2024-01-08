<?php
session_start();

// Impede o acesso direto via url a esse script
if (!$_POST) {
    unset($_SERVER['nomeusuario']);
    unset($_SESSION['matriculausuario']);
    header('Location: ../../index.php');
}

include "../../sql/conexao.php";

$matricula = $_SESSION['matricula'];

function formataData($date){
    $newDate = explode("/", $date);
    $newDate2 = explode(" ", $newDate[2]);
        
    return $newDate2[0]."-".$newDate[1]."-".$newDate[0]." ".$newDate2[1];
}

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

$recebedor = mysqli_real_escape_string($conn, $_POST['recebedor']);
$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
$estado = mysqli_real_escape_string($conn, $_POST['estado']);
$telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
$cpfcnpj = mysqli_real_escape_string($conn, $_POST['cpfcnpj']);
$valor_pagar = mysqli_real_escape_string($conn, $_POST['valor_pagar']);
$forma_pagamento = mysqli_real_escape_string($conn, $_POST['forma_pagamento']);

if (isset($_POST['dinheiro']))
    $dinheiro = trim(mysqli_real_escape_string($conn, $_POST['dinheiro']));
else
    $dinheiro = 0.0;

if (isset($_POST['parcelado'])){
    $parcelado = mysqli_real_escape_string($conn, $_POST['parcelado']);
} else {
    $parcelado = 0;
}

$observacao_pagamento = mysqli_real_escape_string($conn, $_POST['observacao_pagamento']);
$data_pagamento = formataData(mysqli_real_escape_string($conn, $_POST['data_pagamento']));

$sql = "INSERT INTO lancar_despesa_pagamento (recebedor, endereco, estado, telefone, cpfcnpj, valor_pagar, forma_pagamento, dinheiro, parcelado, observacao_pagamento, data_pagamento)
        VALUES ('$recebedor', '$endereco', '$estado', '$telefone', '$cpfcnpj', '$valor_pagar', '$forma_pagamento', $dinheiro, $parcelado, '$observacao_pagamento', '$data_pagamento');
        ";

$inserir = mysqli_query($conn, $sql);

//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
?>

<!DOCTYPE html>
<html lang="pt-b">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
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

            <div id="container-menu" class="principal col" style="height: 100vh;">
                <div class="cadastro-pet">
                    <div class="btn-cadastrar text-center">
                        <h4 class="titulos-topo">Pagamento registrado com sucesso.</h4>
                        <div style="padding-top: 20px">

                            <a href="../sub_menu_lancar_despesas.php" role="button" class="btn btn-success">Voltar</a>
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