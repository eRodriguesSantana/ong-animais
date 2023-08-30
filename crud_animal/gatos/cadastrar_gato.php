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

date_default_timezone_set('America/Sao_Paulo');
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
    <title>ONG Sistema de Adoção Pet</title>
</head>

<body>
    <div id="ong" class="container-ong">
        <div class="row">
            <div id="menu-lateral" class="col-2" style="height: 100vh">
                <div class="titulos-ong">
                    <h4>ONG</h4>
                    <h4>Animais Pirapozinho</h4>
                </div>
                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                    <button type="button" class="btn-menu btn">Início</button>
                    <button type="button" class="btn-menu btn">Gerenciar Pessoas</button>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn-menu btn dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Gerenciar Pets</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#">Entrada Pet</a>
                            <a class="dropdown-item" href="#">Saída Pet</a>
                        </div>
                    </div>
                    <button type="button" class="btn-menu btn">Gerenciar Produtos</button>
                    <button type="button" class="btn-menu btn">Gerenciar Fornecedores</button>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn-menu btn dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> Financeiro</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="#">Registrar Despesas</a>
                            <a class="dropdown-item" href="#">Registrar Compras</a>
                            <a class="dropdown-item" href="#">Registrar Doação</a>
                        </div>
                    </div>
                </div>
                <div class="sair-rodape">
                    <a class="btn-sair" href="#"><span><i class="bi bi-person-circle"></i></span>Nome do Usuário
                        Logado: <?php echo $nome_completo; ?></a>
                    <a class="btn-sair" href="../../sair.php"><span><i class="bi bi-box-arrow-right"></i></span>Sair</a>
                </div>
            </div> <!--Menu lateral FIM
            -->
            <div id="container-cadastro-pet" class="principal col">
                <h4 class="titulos-topo">Cadastrar Gato</h4>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Cadastro Raça Gato</h5>
                    <form action="inserir_gato_bd.php" method="post">
                        <div class="form-group">
                            <label for="nome_raca_gato">Nome raça</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="nome_raca_gato" 
                                aria-describedby="nome_raca_gato"
                                required 
                                    oninvalid="this.setCustomValidity('Nome raça obrigatório')" 
                                    oninput="setCustomValidity('')"
                                autocomplete="off"
                                placeholder="Digite a raça do gato"
                            >
                        </div>
                        <div class="form-group">
                            <label for="nivel_cuidado_gato">Observações de cuidado</label>
                            <textarea 
                                name="nivel_cuidado_gato" 
                                rows="4" cols="50" 
                                class="form-control"
                                required 
                                    oninvalid="this.setCustomValidity('Nome raça obrigatório')" 
                                    oninput="setCustomValidity('')"
                                autocomplete="off"
                                placeholder="Digite a raça do gato"></textarea>
                        </div>                   
                        <div class="btn-cadastrar">
                            <button type="submit" class="btn btn-grupo">Cadastrar</button>
                        </div>
                    </form>
                </div>
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
</body>

</html>