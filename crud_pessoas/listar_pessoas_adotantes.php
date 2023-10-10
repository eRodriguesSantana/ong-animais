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

$sql = "SELECT nome_completo FROM pessoas WHERE nivelUsuario = '' and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];
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

            <div id="container-adocao-listagem" class="principal col" style="height: 100vh;">
                <h4 class="titulos-topo">Adotantes</h4>
                <div class="btn-grupo-principal">
                    <a href="cadastro_pessoa.php" class="btn btn-grupo" role="button">Cadastrar Pessoa</a>
                </div>
                <hr>
                <div class="busca">
                    <input id="filtra-pessoa" class="campo-busca form-control" type="text" placeholder="Buscar pessoa">
                    <button id="buscar" type="button" class="btn btn-busca">Pesquisar</button>
                </div>
                <table id="buscar-pessoa" class="table">
                    <thead>
                        <tr class="topo-colunas">
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Atuação</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT
                                id_pessoa,
                                nome_completo,
                                email,
                                endereco,
                                telefone,
                                nivelUsuario
                            FROM 
                                pessoas
                            WHERE 
                                nivelUsuario = 'Adotante'
                            ORDER BY id_pessoa ASC";
                        $busca = mysqli_query($conn, $sql);

                        while ($array = mysqli_fetch_array($busca)) {
                            $id_pessoa = $array['id_pessoa'];
                            $nome_completo = $array['nome_completo'];
                            $email = $array['email'];
                            $endereco = $array['endereco'];
                            $telefone = $array['telefone'];
                            $nivelUsuario = $array['nivelUsuario'];
                        ?>
                            <tr style="font-size: 14px">
                                <td><?php echo $nome_completo; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $endereco; ?></td>
                                <td><?php echo $telefone; ?></td>
                                <td><?php echo $nivelUsuario; ?></td>
                                <td>
                                    <?php
                                    if (($matricula == 2) || $matricula == 12) {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-4 col-xs-4">
                                                <a class="btn btn-primary btn-sm" href="visualizar_adotante.php?id_pessoa=<?php echo $id_pessoa; ?>" role="button"><i class="fas fa-eye"></i>Visualizar
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-xs-4">
                                                <a class="btn btn-warning btn-sm" href="editar_pessoa_adotante.php?id_pessoa=<?php echo $id_pessoa; ?>" role="button"><i class="fas fa-eye"></i>Editar
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-xs-4">
                                                <a class="btn btn-danger btn-sm" href="confirmar_exclusao_pessoa_adotante.php?id_pessoa=<?php echo $id_pessoa; ?>" role="button"><i class="fas fa-eye"></i>Excluir
                                                </a>
                                            </div>
                                        <?php } else
                                        echo "Sem permissão para alterar ou excluir. Solicite ao seu Gerente/Supervisor"
                                        ?>
                                </td>
                            <?php } ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--JS do Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            document.getElementById('buscar').addEventListener('click', pesquisaTabela);

            function pesquisaTabela() {
                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("filtra-pessoa");
                filter = input.value.toUpperCase();
                table = document.getElementById("buscar-pessoa");
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