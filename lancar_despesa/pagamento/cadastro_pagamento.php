<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    unset($_SESSION['matricula']);
    header('Location:../../index.php');
}

$matricula = $_SESSION['matricula'];

include "../../sql/conexao.php";

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

            <div id="container-cadastro-pet" class="principal col">
                <h4 class="titulos-topo">Cadastro de Pagamento</h4>
                <div class="btn-grupo-principal">
                    <a href="http://sospirapo.br/lancar_despesa/sub_menu_lancar_despesas.php" role="button" class="btn-grupo btn">Voltar</a>
                    <a href="http://sospirapo.br/lancar_despesa/pagamento/listar_pagamentos.php" role="button" class="btn-grupo btn">Listar Pagamentos</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Cadastro de Pagamento</h5>
                    <form action="inserir_pagamento_bd.php" method="post">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="form-group">
                                    <label for="recebedor">Recebedor(a):</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="recebedor" 
                                        aria-describedby="recebedor"
                                        id="recebedor" 
                                        required 
                                            oninvalid="this.setCustomValidity('Recebedor obrigatório')" 
                                            oninput="setCustomValidity('')" 
                                        autocomplete="off" 
                                        placeholder="Digite o nome do recebedor">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-xs-8">
                                <div class="form-group">
                                    <label for="endereco">Endereço:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="endereco" 
                                        aria-describedby="endereco"
                                        id="endereco" 
                                        required 
                                            oninvalid="this.setCustomValidity('Endereco obrigatório')" 
                                            oninput="setCustomValidity('')" 
                                        autocomplete="off" 
                                        placeholder="Rua/Av, N°, Bairro, Município">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="estado">Estado:</label>
                                    <select 
                                        id="estado" 
                                        name="estado" 
                                        class="form-control" 
                                        required 
                                            oninvalid="this.setCustomValidity('Estado obrigatório')" 
                                            oninput="setCustomValidity('')">
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="EX">Estrangeiro</option>
                                    </select>
                                </div>
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
                                    <label for="cpfcnpj">CPF/CNPJ</label>
                                    <input
                                    id="cpfcnpj" 
                                    maxlength="11"
                                    type="text" 
                                    name="cpfcnpj" 
                                    class="form-control cpfOuCnpj" 
                                    required
                                        oninvalid="this.setCustomValidity('CPF/CNPJ obrigatório')" 
                                        oninput="setCustomValidity('')"
                                    aria-describedby="cpfcnpj"
                                    autocomplete="off"
                                    placeholder="CPF/CNPJ do(a) recebedor(a)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="valor_pagar">Valor a pagar R$:</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="valor_pagar"
                                name="valor_pagar"
                                data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                required 
                                    oninvalid="this.setCustomValidity('Valor a pagar obrigatório')" 
                                    oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="forma_pagamento">Forma de pagamento:</label>
                            <select 
                                id="forma_pagamento" 
                                name="forma_pagamento" 
                                onchange='habilitarCampos()' 
                                class="form-control" 
                                required 
                                    oninvalid="this.setCustomValidity('Forma de pagamento obrigatório')" 
                                    oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="parcelado">Parcelado</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="dinheiro">Dinheiro R$:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="dinheiro"
                                        name="dinheiro"
                                        data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                        required 
                                            oninvalid="this.setCustomValidity('Valor obrigatório')" 
                                            oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="parcelado">Parcelado:</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        name="parcelado" 
                                        aria-describedby="parcelado"
                                        id="parcelado" 
                                        required 
                                            oninvalid="this.setCustomValidity('Quantidade de parcelas obrigatório')" 
                                            oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="observacao_pagamento">Observação sobre este pagamento:</label>
                            <textarea name="observacao_pagamento" rows="4" cols="50" class="form-control"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="text" name="imagem" class="form-control" autocomplete="off" placeholder="Imagem do animal">
                        </div> -->
                        <div class="form-group">
                            <label for="data_pagamento">Data pagamento (informação do sistema)</label>
                            <input type="text" name="data_pagamento" value="<?php echo date('d/m/Y H:i:s', time()); ?>" class="form-control" autocomplete="off" readonly placeholder="<?php echo date('d/m/Y H:i:s', time()); ?>">
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>
        $(document).ready(function(){
            $("input").inputmask();
        });

        function habilitarCampos() {
            if ($("#forma_pagamento").val() == 'dinheiro') {
                $("#dinheiro").prop('disabled', false);
                $("#parcelado").prop('disabled', true);
            } else {
                $("#dinheiro").prop('disabled', true);
                $("#parcelado").prop('disabled', false);
            }
        }

        var options = {
            onKeyPress: function (cpf, ev, el, op) {
                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                $('.cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        }

        $('.cpfOuCnpj').length > 11
        ? $('.cpfOuCnpj').mask('00.000.000/0000-00', options)
        : $('.cpfOuCnpj').mask('000.000.000-00#', options);

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