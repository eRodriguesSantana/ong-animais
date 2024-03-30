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

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = '$matricula' and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

$id_animal = $_GET['id_animal'];

$sql_animal = "SELECT nome_animal FROM animal WHERE id_animal = $id_animal";
$buscar_animal = mysqli_query($conn, $sql_animal);
$arr_animal = mysqli_fetch_array($buscar_animal);
$nome_animal = $arr_animal['nome_animal'];
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

            <div id="container-cadastro-pet" class="principal col">
                <h4 class="titulos-topo">Registro de Adoção</h4>
                <div class="btn-grupo-principal">
                    <a href="http://sospirapo.br/menu.php" role="button" class="btn-grupo btn">Voltar</a>
                    <a href="http://sospirapo.br/crud_adocao/listar_adocao.php" role="button" class="btn-grupo btn">Listar Adoções</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Registrar Adoção</h5>
                    <form action="inserir_adocao_bd.php" method="post">
                        <div class="form-group">
                            <label for="nome_adotante">Nome do Adotante</label>
                            <select class="form-control" id="nome_adotante" name="nome_adotante" required oninvalid="this.setCustomValidity('Nome obrigatório')" oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <?php
                                $sql_adotante = "SELECT id_pessoa, nome_completo FROM pessoas";
                                $result = mysqli_query($conn, $sql_adotante);

                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                }
                                ?>
                            </select>

                            <div style="text-align: start; font-size: 13px;">
                                <a href="http://sospirapo.br/crud_pessoas/cadastro_pessoa.php" target="_blank">
                                    Adicionar novo adotante (abrirá em outra aba - recarregar essa página após cadastrar)
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="pet_adotado">Nome do Animal</label>
                          <input type="text" name="pet_adotado" value="<?php echo $nome_animal; ?>" class="form-control" autocomplete="off" readonly>
                          <input type="hidden" name="id_animal" value="<?=$id_animal?>"> 
                        </div>
                        <div class="form-group">
                            <label for="data_adocao">Data Adoção(informação do sistema)</label>
                            <input type="text" name="data_adocao" value="<?php echo date('d/m/Y H:i:s', time()); ?>" class="form-control" autocomplete="off" readonly placeholder="<?php echo date('d/m/Y H:i:s', time()); ?>">
                        </div>
                        <div class="form-group">
                            <label for="condicoes_saida">Condições da Saída:</label>
                            <textarea name="condicoes_saida" rows="4" cols="50" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação:</label>
                            <textarea name="observacao" rows="4" cols="50" class="form-control"></textarea>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>