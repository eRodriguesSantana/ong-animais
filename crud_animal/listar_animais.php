<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: ../index.php');
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
    <title>ONG Sistema de Adoção Pet</title>
</head>

<body>
    <div id="ong" class="container-ong">
        <div class="row">

        <?php include('../menu_lateral.php') ?>
            <!--Menu lateral FIM-->

            <div id="container-adocao-listagem" class="principal col">
                <h4 class="titulos-topo">Todos os animais na ONG</h4>
                <div class="btn-grupo-principal">
                    <a href="cadastro_animal.php" class="btn btn-grupo" role="button">Cadastrar Animal</a><!--Entrada Pet-->
                    <a href="#" class="btn btn-grupo" role="button">Nova Adoção</a><!--Saída Pet-->
                </div>
                <hr>
                <div class="busca">
                    <input id="filtra-animal" class="campo-busca form-control" type="text" placeholder="Buscar animal">
                    <button id="buscar" type="button" class="btn btn-busca">Pesquisar</button>
                </div>
                <table id="busca-animal" class="table">
                    <thead>
                        <tr class="topo-colunas">
                          <th scope="col">Imagem</th>
                          <th scope="col">Nome do animal</th>
                          <th scope="col">Sexo</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">Raça</th>
                          <th scope="col">Cor</th>
                          <th scope="col">Peso aproximado</th>
                          <th scope="col">Observação</th>
                          <th scope="col">Data entrada</th>
                          <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT * 
                          FROM animal
                          ORDER BY id_animal ASC";
                      $busca = mysqli_query($conn, $sql);

                      while ($array = mysqli_fetch_array($busca)){
                        $id_animal = $array['id_animal'];
                        $imagem = $array['imagem'];
                        $nome_animal = $array['nome_animal'];
                        $sexo_animal = $array['sexo_animal'];
                        $tipo_animal = $array['tipo_animal'];
                        $situacao = $array['situacao'];

                        $raca = "";
                        if($tipo_animal == "Gato"){
                            $sql_gato = "SELECT distinct raca_gato.nome_raca_gato 
                                FROM raca_gato
                                WHERE raca_gato.id_raca_gato = " . $array['raca_gato'] .";";
                            $busca_gato = mysqli_query($conn, $sql_gato);
                            $result_gato = $busca_gato->fetch_assoc();
                            $raca = $result_gato['nome_raca_gato'];
                        }
                        else{
                            $sql_cao = "SELECT distinct raca_cao.nome_raca_cao 
                                FROM raca_cao
                                WHERE raca_cao.id_raca_cao = " . $array['raca_cao'] .";";
                            $busca_cao = mysqli_query($conn, $sql_cao);
                            $result_cao = $busca_cao->fetch_assoc();
                            $raca = $result_cao['nome_raca_cao'];
                        }

                        $cor_animal = $array['cor_animal'];
                        $peso_aproximado = $array['peso_aproximado'];
                        $observacao = $array['observacao'];
                        $data_entrada = $array['data_entrada'];

                        if($situacao == 0){
                      ?>
                          <tr style="font-size: 14px">
                            <td><?php echo $imagem; ?></td>
                            <td><?php echo $nome_animal; ?></td>
                            <td><?php echo $sexo_animal; ?></td>
                            <td><?php echo $tipo_animal; ?></td>
                            <td><?php echo $raca; ?></td>
                            <td><?php echo $cor_animal; ?></td>
                            <td><?php echo $peso_aproximado; ?></td>
                            <td><?php echo $observacao; ?></td>
                            <td><?php echo formataData($data_entrada); ?></td>                
                            <td>
                              <?php
                                if(($matricula == 2) || $matricula == 12){
                              ?>
                              <div class="row">
                                <div class="col-md-6 col-xs-6">
                                  <a class="btn btn-warning btn-sm" href="editar_animal.php?id_animal=<?php echo $id_animal; ?>" 
                                    role="button"><i class="fas fa-eye"></i>Editar
                                  </a>  
                                </div>
                                <div class="col-md-6 col-xs-6">
                                  <a class="btn btn-danger btn-sm" href="confirmar_exclusao_animal.php?id_animal=<?php echo $id_animal; ?>" 
                                    role="button"><i class="fas fa-eye"></i>Excluir
                                  </a>
                                </div>
                              <?php } 
                                else
                                  echo "Sem permissão para alterar ou excluir. Solicite ao seu Gerente/Supervisor"
                              ?>
                            </td>                      
                          </tr>
                        <?php } ?>
                      <?php } ?>
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