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

include "../conexao.php";

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
            <div id="menu-lateral" class="col-2">
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
                    <a class="btn-sair" href="../sair.php"><span><i class="bi bi-box-arrow-right"></i></span>Sair</a>
                </div>
            </div> <!--Menu lateral FIM
            -->
            <div id="container-cadastro-pet" class="principal col">
                <h4 class="titulos-topo">Cadastrar Cachorro</h4>
                <div class="btn-grupo-principal">
                    <a href="sub_menu_cao.php" role="button" class="btn-grupo btn">Voltar</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Cadastro de Cachorro</h5>
                    <form action="inserir_cao_bd.php" method="post">
                        <div class="form-group">
                            <label for="nome_animal_cachorro">Nome da fera *-*</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="nome_animal_cachorro" 
                                aria-describedby="nome_animal_cachorro"
                                required 
                                    oninvalid="this.setCustomValidity('Nome obrigatório')" 
                                    oninput="setCustomValidity('')"
                                autocomplete="off"
                                placeholder="Digite o nome do amiguinho(a) :D"
                            >
                        </div>
                        <div class="form-group">
                            <label for="sexo_animal_cachorro">Sexo:</label>
                            <select 
                                name="sexo_animal_cachorro" 
                                class="form-control" 
                                required 
                                    oninvalid="this.setCustomValidity('Sexo obrigatório')" 
                                    oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <option value="Femêa">Femêa</option>
                                <option value="Macho">Macho</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="raca_cachorro">Raça:</label>
                            <select 
                                name="raca_cachorro" 
                                class="form-control" 
                                required 
                                    oninvalid="this.setCustomValidity('Raça obrigatório')" 
                                    oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <?php 
                                    $sql_cao = "SELECT id_raca_cao, nome_raca_cao FROM raca_cao";
                                    
                                    if($result = mysqli_query($conn, $sql_cao)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){                                           
                                                echo '<option value="'.$row[1].'">'.$row[1].'</option>';
                                            }
                                            mysqli_free_result($result);
                                        } else{
                                            echo "No records matching your query were found.";
                                        }
                                    } else{
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="peso_aproximado_cachorro">Peso Aproximado:</label>
                            <input 
                                type="number" 
                                class="form-control"
                                name="peso_aproximado_cachorro"
                                aria-describedby="peso_aproximado_cachorro"
                                required 
                                    oninvalid="this.setCustomValidity('Peso obrigatório')" 
                                    oninput="setCustomValidity('')"
                                autocomplete="off" 
                                placeholder="Peso aproximado"
                            >
                        </div>
                        <div class="form-group">
                            <label for="observacao_cachorro">Observação</label>
                            <textarea name="observacao_cachorro" rows="4" cols="50" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_cachorro">Imagem</label>
                            <input type="text" name="image_cachorro" class="form-control" 
                                    autocomplete="off"
                                    placeholder="Imagem do animal">
                        </div>
                        <div class="form-group">
                            <label for="data_entrada_cachorro">Data Entrada (informação do sistema)</label>
                            <input 
                                type="text" 
                                name="data_entrada_cachorro" 
                                value="<?php echo date('d/m/Y H:i:s', time()); ?>" 
                                class="form-control" 
                                autocomplete="off"
                                readonly 
                                placeholder="<?php echo date('d/m/Y H:i:s', time()); ?>"
                            >
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