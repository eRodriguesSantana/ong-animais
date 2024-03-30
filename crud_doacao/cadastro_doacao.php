<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    unset($_SESSION['matricula']);
    header('Location:../index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = '$matricula' and status='Ativo'";
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

            <?php include('menu_lateral.php') ?>
            <!--Menu lateral FIM-->

            <div id="container-cadastro-pet" class="principal col">
                <h4 class="titulos-topo">Cadastro de Doação</h4>
                <div class="btn-grupo-principal">
                    <a href="http://sospirapo.br/crud_doacao/listar_doacoes.php" role="button" class="btn-grupo btn">Listar Doações</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Cadastrar Doação</h5>
                    <form action="inserir_doacao_bd.php" method="post">
                        <div class="form-group">
                            <label for="doador">Doador(a):</label>
                            <select class="form-control" id="doador" name="doador">
                                <option value="">Selecione</option>
                                    <?php
                                        $sql_pessoas = "SELECT * FROM pessoas";
                                        $result = mysqli_query($conn, $sql_pessoas);

                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
                                        }
                                    ?>
                            </select>
                            <div style="color: blue">
                                Deixe em branco caso seja doação anônima
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input 
                                    onkeypress="maskphone(this, mphone);" 
                                    onblur="maskphone(this, mphone);"
                                    type="text" 
                                    id="telefone"
                                    name="telefone" 
                                    class="form-control" 
                                    required
                                        oninvalid="this.setCustomValidity('Telefone obrigatório')" 
                                        oninput="setCustomValidity('')" 
                                    aria-describedby="telefone"
                                    autocomplete="off"
                                    placeholder="Telefone do doador">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input
                                    id="cpf" 
                                    maxlength="11"
                                    type="text" 
                                    name="cpf" 
                                    class="form-control" 
                                    required
                                        oninvalid="this.setCustomValidity('CPF obrigatório')" 
                                        oninput="setCustomValidity('')"
                                    aria-describedby="cpf"
                                    autocomplete="off"
                                    placeholder="CPF do doador">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipo_doacao">Tipo doação:</label>
                            <select 
                                id="tipo_doacao" 
                                name="tipo_doacao" 
                                onchange='habilitarCampos()' 
                                class="form-control" 
                                required 
                                    oninvalid="this.setCustomValidity('Tipo doação obrigatório')" 
                                    oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="produto">Produto</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="dinheiro">Valor R$:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="dinheiro"
                                        name="dinheiro"
                                        data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                        required 
                                            oninvalid="this.setCustomValidity('Tipo doação obrigatório')" 
                                            oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="produto">Produto:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="produto" 
                                        aria-describedby="produto"
                                        id="produto" 
                                        required 
                                            oninvalid="this.setCustomValidity('Produto obrigatório')" 
                                            oninput="setCustomValidity('')" 
                                        autocomplete="off" 
                                        placeholder="Digite o nome do produto">
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade:</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="quantidade" 
                                        name="quantidade"
                                        required 
                                            oninvalid="this.setCustomValidity('Quantidade obrigatório')" 
                                            oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação sobre esta doação:</label>
                            <textarea name="observacao" rows="4" cols="50" class="form-control"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="text" name="imagem" class="form-control" autocomplete="off" placeholder="Imagem do animal">
                        </div> -->
                        <div class="form-group">
                            <label for="data_doacao">Data Doação (informação do sistema)</label>
                            <input type="text" name="data_doacao" value="<?php echo date('d/m/Y H:i:s', time()); ?>" class="form-control" autocomplete="off" readonly placeholder="<?php echo date('d/m/Y H:i:s', time()); ?>">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>

    <script>
        $(document).ready(function(){
            $("input").inputmask();
        });

        function habilitarCampos() {
            if ($("#tipo_doacao").val() == 'dinheiro') {
                $("#dinheiro").prop('disabled', false);
                $("#produto").prop('disabled', true);
                $("#quantidade").prop('disabled', true);
            } else {
                $("#dinheiro").prop('disabled', true);
                $("#produto").prop('disabled', false);
                $("#quantidade").prop('disabled', false);
            }
        }

        var cpf = document.querySelector("#cpf");

        cpf.addEventListener("blur", function(){
            if(cpf.value) cpf.value = cpf.value.match(/.{1,3}/g).join(".").replace(/\.(?=[^.]*$)/,"-");
        });

        function maskphone(o, f) {
            setTimeout(function() {
            var v = mphone(o.value);
            if (v != o.value) {
                o.value = v;
            }
            }, 1);
        }

        function mphone(v) {
            var r = v.replace(/\D/g, "");
            r = r.replace(/^0/, "");
            if (r.length > 10) {
            r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (r.length > 5) {
            r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (r.length > 2) {
            r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else {
            r = r.replace(/^(\d*)/, "($1");
            }
            return r;
        }
    </script>
</body>

</html>