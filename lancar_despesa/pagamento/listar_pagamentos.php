<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: ../../index.php');
}

$matricula = $_SESSION['matricula'];

include "../../sql/conexao.php";

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

function formataData($date){
    $newDate = explode("-", $date);
    $newDate2 = explode(" ", $newDate[2]);
      
    return $newDate2[0]."-".$newDate[1]."-".$newDate[0]." ".$newDate2[1]."<br>";
}

?>

<!DOCTYPE html>
<html lang="pt-b">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>ONG Sistema de Adoção Pet</title>
</head>

<body>
    <div id="ong" class="container-ong">
        <div class="row">

        <?php include('../../menu_lateral.php') ?>
            <!--Menu lateral FIM-->

            <div id="container-adocao-listagem" class="principal col">
                <h4 style="font-size: 20px; font-weight: 300">Pagamentos</h4>
                <div class="btn-grupo-principal">
                    <a href="cadastro_pagamento.php" class="btn btn-grupo" role="button">Cadastrar Pagamento</a>
                </div>
                <hr>
                <div class="busca">
                    <input id="filtra-pagamento" class="campo-busca form-control" type="text" placeholder="Buscar pagamento">
                    <button id="buscar" type="button" class="btn btn-busca">Pesquisar</button>
                </div>
                <table id="busca-pagamento" class="table">
                    <thead>
                        <tr class="topo-colunas">
                          <th scope="col">Recebedor</th>
                          <th scope="col">Telefone</th>
                          <th scope="col">Forma pagamento</th>
                          <th scope="col">Data pagamento</th>
                          <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT * 
                          FROM lancar_despesa_pagamento
                          ORDER BY id_pagamento ASC";
                      $busca = mysqli_query($conn, $sql);

                      $count = 0;

                      while ($array = mysqli_fetch_array($busca)){
                        $id_pagamento = $array['id_pagamento'];
                        $recebedor = $array['recebedor'];
                        $cpfcnpj = $array['cpfcnpj'];
                        $telefone = $array['telefone'];
                        $forma_pagamento = $array['forma_pagamento'];
                        $endereco = $array['endereco'];
                        $estado = $array['estado'];

                        if($array['observacao_pagamento'] != '')
                            $observacao_pagamento = $array['observacao_pagamento'];
                        else
                            $observacao_pagamento = "Sem observação.";

                        $data_pagamento = $array['data_pagamento'];

                        $dinheiro = $array['dinheiro'];
                        $parcelado = $array['parcelado'];
                      ?>
                        <tr style="font-size: 14px">
                            <td><?php echo $recebedor; ?></td>
                            <td><?php echo $telefone; ?></td>
                            <td><?php echo $forma_pagamento; ?></td>
                            <td><?php echo formataData($data_pagamento); ?></td>
                            <td>      
                                <button data-toggle="modal" data-target="#view-modal<?php echo $count ?>" data-id="<?php echo $array['id_pagamento']; ?>" id="getUser" class="btn btn-sm btn-info">
                                    <i class="glyphicon glyphicon-eye-open"></i> 
                                    Detalhes
                                </button>
						    </td>
                            <div id="view-modal<?php echo $count ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog"> 
                                    <div class="modal-content">                  
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                <i class="glyphicon glyphicon-thumbs-up"></i> Detalhes Pagamento
                                            </h4>  
                                        </div> 
                                        <div class="modal-body">                       
                                            <div id="modal-loader" style="display: none; text-align: center;">
                                                <img src="ajax-loader.gif">
                                            </div>                            
                                            <!-- content will be load here -->
                                            <?php
                                                if($forma_pagamento == 'dinheiro'){
                                            ?>
                                                    <div id="wwwdynamic-content">
                                                        CPF/CNPJ: <?php echo $cpfcnpj.'<br>'; ?>
                                                        Valor R$: <?php echo $dinheiro.'<br>'; ?>
                                                        Observação: <?php echo $observacao_pagamento.'<br>'; ?>
                                                        Endereço: <?php echo $endereco.'<br>'; ?>
                                                        Estado: <?php echo $estado.'<br>'; ?>
                                                    </div>
                                            <?php } else { ?>
                                                    <div id="wwwdynamic-content">
                                                        CPF/CNPJ: <?php echo $cpfcnpj.'<br>'; ?>
                                                        Quantidade parcelas: <?php echo $parcelado.'<br>'; ?>
                                                        Observação: <?php echo $observacao_pagamento.'<br>'; ?>
                                                        Endereço: <?php echo $endereco.'<br>'; ?>
                                                        Estado: <?php echo $estado.'<br>'; ?>
                                                    </div>                                                
                                            <?php } ?>
                                        </div> 
                                        <div class="modal-footer"> 
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  
                                        </div>                        
                                    </div> 
                                </div>
                            </div><!-- /.modal -->
                        </tr>
                        <?php $count++ ?>
                      <?php }?>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>

    <!--JS do Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            document.getElementById('buscar').addEventListener('click', pesquisaTabela);

            function pesquisaTabela() {
                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("filtra-pagamento");
                filter = input.value.toUpperCase();
                table = document.getElementById("busca-pagamento");
                tr = table.getElementsByTagName("tr");
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 1; i < tr.length; i++) {
                    var match = tr[i].innerHTML.toUpperCase().indexOf(filter) > -1;
                    tr[i].style.display = match ? "" : "none";
                }
            }
        });
    </script>
</body>
</html>