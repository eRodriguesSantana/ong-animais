<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    unset($_SESSION['matricula']);
    header('Location:http://localhost/ong-animais-pirapo/index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

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

            <div id="container-cadastro-pet" class="principal col">
                <h4 class="titulos-topo">Cadastro de Animal</h4>
                <div class="btn-grupo-principal">
                    <a href="../menu.php" role="button" class="btn-grupo btn">Voltar</a>
                    <a href="listar_animais.php" role="button" class="btn-grupo btn">Listar Animais</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Cadastrar Animal</h5>
                    <form action="inserir_animal_bd.php" method="post">
                        <div class="form-group">
                            <label for="nome_animal">Nome:</label>
                            <input type="text" class="form-control" name="nome_animal" aria-describedby="nome_animal" required oninvalid="this.setCustomValidity('Nome obrigatório')" oninput="setCustomValidity('')" autocomplete="off" placeholder="Digite o nome do amiguinho">
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="cor_animal">Cor animal:</label>
                                    <select id="cor_animal" name="cor_animal" class="form-control" required oninvalid="this.setCustomValidity('Cor obrigatório')" oninput="setCustomValidity('')">
                                    <option value="">Selecione</option>
                                    <?php
                                        $sql_cor = "SELECT id_cor, nome_cor FROM cor_animal";
                                        $result = mysqli_query($conn, $sql_cor);

                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="porte_animal">Porte animal:</label>
                                    <select id="porte_animal" name="porte_animal" class="form-control" required oninvalid="this.setCustomValidity('Porte obrigatório')" oninput="setCustomValidity('')">
                                        <option value="">Selecione</option>
                                        <option value="Filhote">Filhote</option>
                                        <option value="Pequeno">Pequeno</option>
                                        <option value="Médio">Médio</option>
                                        <option value="Grande">Grande</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sexo_animal">Sexo:</label>
                            <select id="sexo_animal" name="sexo_animal" class="form-control" required oninvalid="this.setCustomValidity('Sexo obrigatório')" oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <option value="Femêa">Fêmea</option>
                                <option value="Macho">Macho</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_animal">Tipo animal:</label>
                            <select id="tipo_animal" name="tipo_animal" onchange='habilitarCampos()' class="form-control" required oninvalid="this.setCustomValidity('Tipo obrigatório')" oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <option value="Gato">Gato</option>
                                <option value="Cao">Cão</option>
                            </select>
                        </div>
                        <div class="row raca">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="raca_gato">Raça do Gato:</label>
                                    <select class="form-control" id="raca_gato" name="raca_gato" required oninvalid="this.setCustomValidity('Raça obrigatório')" oninput="setCustomValidity('')">
                                        <option value="">Selecione</option>
                                        <?php
                                        $sql_gato = "SELECT id_raca_gato, nome_raca_gato FROM raca_gato";
                                        $result = mysqli_query($conn, $sql_gato);

                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                        }
                                        ?>
                                    </select>

                                    <div class="add-raca">
                                        <a href="listar_racas.php" target="_blank">
                                            Adicionar outra raça de gato
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="raca_cao">Raça do Cachorro:</label>
                                    <select class="form-control" id="raca_cao" name="raca_cao" required oninvalid="this.setCustomValidity('Raça obrigatória')" oninput="setCustomValidity('')">
                                        <option value="">Selecione</option>
                                        <?php
                                        $sql_cao = "SELECT id_raca_cao, nome_raca_cao FROM raca_cao";
                                        $result = mysqli_query($conn, $sql_cao);

                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                        }
                                        ?>
                                    </select>

                                    <div class="add-raca">
                                        <a href="listar_racas.php" target="_blank">
                                            Adicionar outra raça de cachorro
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="peso_aproximado">Peso Aproximado:</label>
                            <input type="number" class="form-control" name="peso_aproximado" aria-describedby="peso_aproximado" required oninvalid="this.setCustomValidity('Peso obrigatório')" oninput="setCustomValidity('')" autocomplete="off" placeholder="Peso aproximado">
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação:</label>
                            <textarea name="observacao" rows="4" cols="50" class="form-control"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="text" name="imagem" class="form-control" autocomplete="off" placeholder="Imagem do animal">
                        </div> -->
                        <div class="form-group">
                            <label for="data_entrada">Data Entrada (informação do sistema)</label>
                            <input type="text" name="data_entrada" value="<?php echo date('d/m/Y H:i:s', time()); ?>" class="form-control" autocomplete="off" readonly placeholder="<?php echo date('d/m/Y H:i:s', time()); ?>">
                        </div>
                        <div class="btn-cadastrar">
                            <button type="submit" class="btn btn-grupo">Cadastrar</button>
                        </div>
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

    <script>
        function habilitarCampos() {
            if ($("#tipo_animal").val() == 'Gato') {
                $("#raca_gato").prop('disabled', false);
                $("#raca_cao").prop('disabled', true);
            } else {
                $("#raca_gato").prop('disabled', true);
                $("#raca_cao").prop('disabled', false);
            }
        }

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
</body>

</html>