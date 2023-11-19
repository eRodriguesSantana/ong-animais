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

include "../sql/conexao.php";

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

function formataData($date){
    $newDate = explode("/", $date);
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
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Raças</title>
</head>

<body>
    <div id="ong" class="container-ong">
        <div class="row">

        <?php include('../menu_lateral.php') ?>
            <!--Menu lateral FIM-->

            <div id="container-racas-listagem" class="principal col">
                <h4 class="titulos-topo">Todas as cores</h4>
                <hr>
                <a href="cadastrar_cor_animal.php" class="btn btn-grupo" role="button">Cadastrar Cor animal</a><!--Entrada Pet-->
                <table id="busca-animal" class="table">
                    <thead>
                        <tr class="topo-colunas">
                          <th scope="col">ID</th>
                          <th scope="col">Cor</th>
                          <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT * 
                          FROM cor_animal
                          ORDER BY id_cor ASC";
                      $busca = mysqli_query($conn, $sql);
                      while ($array = mysqli_fetch_array($busca)){
                        $id_cor = $array['id_cor'];
                        $nome_cor = $array['nome_cor'];
                      ?>
                          <tr style="font-size: 14px">
                            <!-- <td><?php echo $id_cor; ?></td> -->
                            <td><?php echo $nome_cor; ?></td>        
                            <td>
                              <div class="row">
                                <div class="col-md-4 col-xs-4">
                                  <a class="btn btn-warning btn-sm" href="editar_cor_animal.php?id_cor=<?php echo $id_cor; ?>" 
                                    role="button"><i class="fas fa-eye"></i>Editar
                                  </a>  
                                </div>
                                <div class="col-md-4 col-xs-4">
                                  <a class="btn btn-danger btn-sm" href="confirmar_exclusao_cor_animal.php?id_cor=<?php echo $id_cor; ?>" 
                                    role="button"><i class="fas fa-eye"></i>Excluir
                                  </a>
                                </div>
                                <!-- <div class="col-md-4 col-xs-4">
                                  <a class="btn btn-primary btn-sm" href="../crud_animal/visualizar_animal.php?id_animal=<?php echo $id_cor; ?>" 
                                    role="button"><i class="fas fa-eye"></i>Visualizar
                                  </a>
                                </div> -->
                            </td>                      
                          </tr>
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

    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            document.getElementById('buscar').addEventListener('click', pesquisaTabela);

            function pesquisaTabela() {
                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("filtra-animal");
                filter = input.value.toUpperCase();
                table = document.getElementById("busca-animal");
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