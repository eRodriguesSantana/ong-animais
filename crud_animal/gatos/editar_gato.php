<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    unset($_SESSION['matricula']);
    header('Location: ../../index.php');
}

$matricula = $_SESSION['matricula'];

include "../../sql/conexao.php";

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = '$matricula' and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

$id_gato = $_GET['id_gato'];
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

            <div id="container-cadastro-pet" class="principal col" style="height: 100vh;">
                <h4 class="titulos-topo">Editar dados do gato</h4>
                <div class="btn-grupo-principal">
                    <a href="http://sospirapo.br/crud_animal/gatos/listagem_gatos.php" role="button" class="btn-grupo btn">Voltar</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Editar dados do gato</h5>
                    <form action="atualizar_gato.php" method="post">
                        <input type="number" name="id_gato" value="<?php echo $id_gato; ?>" style="display: none;">
                        <?php
                        $sql = "SELECT * 
                              FROM gatos 
                              WHERE id_gato = $id_gato";
                        $busca = mysqli_query($conn, $sql);

                        while ($array = mysqli_fetch_array($busca)) {
                            $id_gato = $array['id_gato'];
                            $nome_animal_gato = $array['nome_animal_gato'];
                            $sexo_animal_gato = $array['sexo_animal_gato'];
                            $raca_gato = $array['raca_gato'];
                            $peso_aproximado_gato = $array['peso_aproximado_gato'];
                            $observacao_gato = $array['observacao_gato'];
                            $data_entrada_gato = $array['data_entrada_gato'];
                            $image_gato = $array['image_gato'];
                        ?>
                            <div class="form-group">
                                <label for="id_gato">ID gato</label>
                                <input type="text" class="form-control" name="id_gato" value="<?php echo $id_gato; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nome_animal_gato">Nome da fera *-*</label>
                                <input type="text" class="form-control" name="nome_animal_gato" value="<?php echo $nome_animal_gato; ?>" aria-describedby="nome_animal_gato" required oninvalid="this.setCustomValidity('Nome obrigatório')" oninput="setCustomValidity('')" autocomplete="off" placeholder="Digite o nome do amiguinho(a) :D">
                            </div>
                            <div class="form-group">
                                <label for="sexo_animal_gato">Sexo:</label>
                                <select name="sexo_animal_gato" class="form-control" required oninvalid="this.setCustomValidity('Sexo obrigatório')" oninput="setCustomValidity('')">
                                    <option value="">Selecione</option>
                                    <?php
                                    if ($sexo_animal_gato == "Femêa") {
                                    ?>
                                        <option value="<?php echo $sexo_animal_gato; ?>" selected="selected">Femêa</option>
                                        <option value="Macho">Macho</option>
                                    <?php } else
                                    ?>
                                    <option value="Femêa">Femêa</option>
                                    <option value="<?php echo $sexo_animal_gato; ?>" selected="selected">Macho</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="raca">Raça:</label>
                                <select name="raca" class="form-control" required oninvalid="this.setCustomValidity('Raça obrigatório')" oninput="setCustomValidity('')">
                                    <option value="">Selecione</option>
                                    <?php
                                    $sql_gato = "SELECT id_raca, nome_raca FROM raca_gato";

                                    if ($result = mysqli_query($conn, $sql_gato)) {
                                        if (mysqli_num_rows($result) > 0) {
                                            $status = '';
                                            while ($row = mysqli_fetch_array($result)) {
                                                if ($row['nome_raca'] == $raca) {
                                                    $status = "selected=selected";
                                                    echo '<option value="' . $row['nome_raca'] . '"' . $status . '>' . $row['nome_raca'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
                                                }
                                            }
                                            mysqli_free_result($result);
                                        } else {
                                            echo "Não há registros gravados.";
                                        }
                                    } else {
                                        echo "ERROR: não foi possível conexão $sql. " . mysqli_error($conn);
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="peso_aproximado">Peso Aproximado:</label>
                                <input type="number" class="form-control" name="peso_aproximado" value="<?php echo $peso_aproximado; ?>" aria-describedby="peso_aproximado" required oninvalid="this.setCustomValidity('Peso obrigatório')" oninput="setCustomValidity('')" autocomplete="off" placeholder="Peso aproximado">
                            </div>
                            <div class="form-group">
                                <label for="observacao">Observação</label>
                                <textarea name="observacao" rows="4" cols="50" class="form-control">
                                <?php echo trim($observacao) ?>
                            </textarea>
                            </div>
                            <div class="form-group">
                                <label for="imagem">Imagem</label>
                                <input type="text" name="imagem" class="form-control" value="<?php echo $image; ?>" autocomplete="off" placeholder="Imagem do animal">
                            </div>
                            <div class="form-group">
                                <label for="data_entrada">Data Entrada (informação do sistema)</label>
                                <input type="text" name="data_entrada" value="<?php echo $data_entrada; ?>" class="form-control" autocomplete="off" readonly placeholder="<?php echo date('d/m/Y H:i:s', time()); ?>">
                            </div>
                            <div class="btn-cadastrar">
                                <button type="submit" class="btn btn-grupo">Atualizar</button>
                            </div>
                        <?php } ?>
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