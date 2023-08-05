<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

$id_animal = $_GET['id_animal'];
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
                    <a href="../menu.php" class="btn-menu btn" role="button">Início</a> 
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
            </div> <!--Menu lateral FIM-->
            <div id="container-cadastro-pet" class="principal col">
                <h4 class="titulos-topo">Editar dados do animal</h4>
                <div class="btn-grupo-principal">
                    <a href="listar_animais.php" role="button" class="btn-grupo btn">Voltar</a>
                </div>

                <hr>

                <div class="cadastro-pet">
                    <h5 class="titulo-cad">Editar dados do animal</h5>
                    <form action="atualizar_animal.php" method="post">
                      <input type="number" name="id_animal" value="<?php echo $id_animal; ?>" style="display: none;">
                      <?php
                        $sql = "SELECT * 
                              FROM animal 
                              WHERE id_animal = $id_animal";
                        $busca = mysqli_query($conn, $sql);
                        while ($array = mysqli_fetch_array($busca)){
                            $id_animal = $array['id_animal'];
                            $imagem = $array['imagem'];
                            $nome_animal = $array['nome_animal'];
                            $sexo_animal = $array['sexo_animal'];
                            $tipo_animal = $array['tipo_animal'];
    
                            $raca = "";
                            if($tipo_animal == "Gato")
                              $raca = $array['raca_gato'];
                            else
                              $raca = $array['raca_cao'];
    
                            $cor_animal = $array['cor_animal'];
                            $porte_animal = $array['porte_animal'];
                            $peso_aproximado = $array['peso_aproximado'];
                            $observacao = $array['observacao'];
                            $data_entrada = $array['data_entrada'];          
                      ?>
                        <div class="form-group">
                            <label for="id_animal">ID Animal</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="id_animal" 
                                value="<?php echo $id_animal; ?>"
                                disabled
                            >
                        </div>
                        <div class="form-group">
                            <label for="nome_animal">Nome da fera *-*</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="nome_animal"
                                value="<?php echo $nome_animal; ?>"
                                aria-describedby="nome_animal"
                                required 
                                    oninvalid="this.setCustomValidity('Nome obrigatório')" 
                                    oninput="setCustomValidity('')"
                                autocomplete="off"
                                placeholder="Digite o nome do amiguinho(a) :D"
                            >
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="cor_animal">Cor animal:</label>
                                    <select 
                                        id="cor_animal"
                                        name="cor_animal"
                                        class="form-control" 
                                        required 
                                            oninvalid="this.setCustomValidity('Cor obrigatório')" 
                                            oninput="setCustomValidity('')">
                                            <option value="">Selecione</option>
                                            <?php
                                                if(trim($cor_animal) == "Preto"){
                                            ?>
                                                    <option value="<?php echo $cor_animal; ?>" selected="selected"><?php echo $cor_animal; ?></option>
                                                    <option value="Pardo">Pardo</option>
                                                    <option value="Branco">Branco</option>
                                            <?php } 
                                                else if(trim($cor_animal) == "Pardo"){                             
                                            ?>
                                                    <option value="Preto">Preto</option>
                                                    <option value="<?php echo $cor_animal; ?>" selected="selected"><?php echo $cor_animal; ?></option>
                                                    <option value="Branco">Branco</option>
                                            <?php } 
                                                else if(trim($cor_animal) == "Branco"){ 
                                            ?>
                                                    <option value="Preto">Preto</option>
                                                    <option value="Pardo">Pardo</option>
                                                    <option value="<?php echo $cor_animal; ?>" selected="selected"><?php echo $cor_animal; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                    <label for="porte_animal">Porte animal:</label>
                                    <select 
                                        id="porte_animal"
                                        name="porte_animal"
                                        class="form-control" 
                                        required 
                                            oninvalid="this.setCustomValidity('Porte obrigatório')" 
                                            oninput="setCustomValidity('')">
                                        <option value="">Selecione</option>
                                        <?php
                                            if(trim($porte_animal) == "Filhote"){
                                        ?>
                                                <option value="<?php echo $porte_animal; ?>" selected="selected"><?php echo $porte_animal; ?></option>
                                                <option value="Pequeno">Pequeno</option>
                                                <option value="Médio">Médio</option>
                                                <option value="Grande">Grande</option>
                                        <?php } 
                                            else if(trim($porte_animal) == "Pequeno"){                             
                                        ?>
                                                <option value="Filhote">Filhote</option>
                                                <option value="<?php echo $porte_animal; ?>" selected="selected"><?php echo $porte_animal; ?></option>                                                
                                                <option value="Médio">Médio</option>
                                                <option value="Grande">Grande</option>
                                        <?php } 
                                            else if(trim($porte_animal) == "Médio"){ 
                                        ?>
                                                <option value="Filhote">Filhote</option>                                                                                                
                                                <option value="Pequeno">Pequeno</option>
                                                <option value="<?php echo $porte_animal; ?>" selected="selected"><?php echo $porte_animal; ?></option>
                                                <option value="Grande">Grande</option>
                                        <?php } 
                                            else if(trim($porte_animal) == "Grande"){
                                        ?>
                                                <option value="Filhote">Filhote</option>                                                                                                
                                                <option value="Pequeno">Pequeno</option>
                                                <option value="Médio">Médio</option>
                                                <option value="<?php echo $porte_animal; ?>" selected="selected"><?php echo $porte_animal; ?></option>                                                
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sexo_animal">Sexo:</label>
                            <select 
                                name="sexo_animal" 
                                class="form-control" 
                                required 
                                    oninvalid="this.setCustomValidity('Sexo obrigatório')" 
                                    oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <?php
                                if(trim($sexo_animal) == "Femêa"){
                                ?>
                                  <option value="<?php echo $sexo_animal; ?>" selected="selected">Femêa</option>
                                  <option value="Macho">Macho</option>
                                <?php } 
                                else{                             
                                ?>
                                  <option value="Femêa">Femêa</option>
                                  <option value="<?php echo $sexo_animal; ?>" selected="selected">Macho</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_animal">Tipo animal:</label>
                            <input 
                                type="text" 
                                class="form-control"
                                name="tipo_animal" 
                                value="<?php echo $tipo_animal; ?>"
                                placeholder="<?php echo $tipo_animal; ?>"
                                readonly
                            >
                        </div>
                        <div class="row">
                            <?php
                                if($tipo_animal == "Gato"){
                            ?>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="raca_gato">Raça do(a) Gatinho(a):</label>
                                            <select 
                                                class="form-control" 
                                                id="raca_gato"
                                                name="raca_gato"
                                                required 
                                                    oninvalid="this.setCustomValidity('Raça obrigatório')" 
                                                    oninput="setCustomValidity('')">
                                                <option value="">Selecione</option>
                                                <?php
                                                    $sql_gato = "SELECT nome_raca_gato FROM raca_gato";
                                                    $result = mysqli_query($conn, $sql_gato);

                                                    while($row = mysqli_fetch_array($result)){                                           
                                                        if($row[0] == $raca)                                        
                                                            echo '<option value="'.$row[0].'" selected="selected">'.$row[0].'</option>';
                                                        else
                                                            echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                            <?php } else { ?>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="raca_cao">Raça do(a) Doguinho(a):</label>
                                            <select 
                                                class="form-control" 
                                                id="raca_cao"
                                                name="raca_cao"
                                                required 
                                                    oninvalid="this.setCustomValidity('Raça obrigatório')" 
                                                    oninput="setCustomValidity('')">
                                                <option value="">Selecione</option>
                                                <?php 
                                                    $sql_cao = "SELECT nome_raca_cao FROM raca_cao";
                                                    $result = mysqli_query($conn, $sql_cao);

                                                    while($row = mysqli_fetch_array($result)){   
                                                        if($row[0] == $raca)                                        
                                                            echo '<option value="'.$row[0].'" selected="selected">'.$row[0].'</option>';
                                                        else
                                                            echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                       <div class="form-group">
                            <label for="peso_aproximado">Peso Aproximado:</label>
                            <input 
                                type="number" 
                                class="form-control"
                                name="peso_aproximado"
                                value="<?php echo $peso_aproximado; ?>"
                                aria-describedby="peso_aproximado"
                                required 
                                    oninvalid="this.setCustomValidity('Peso obrigatório')" 
                                    oninput="setCustomValidity('')"
                                autocomplete="off" 
                                placeholder="Peso aproximado"
                            >
                        </div>
                        <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea 
                                name="observacao" 
                                rows="4" 
                                cols="50" 
                                class="form-control">
                                <?php echo trim($observacao) ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="imagem">Imagem</label>
                            <input type="text" name="imagem" class="form-control" value="<?php echo trim($imagem); ?>"
                                    autocomplete="off"
                                    placeholder="Imagem do animal">
                        </div>
                        <div class="form-group">
                            <label for="data_entrada">Data Entrada (informação do sistema)</label>
                            <input 
                                type="text" 
                                name="data_entrada" 
                                value="<?php echo $data_entrada; ?>" 
                                class="form-control" 
                                autocomplete="off"
                                readonly 
                                placeholder="<?php echo date('d/m/Y H:i:s', time()); ?>"
                            >
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
        function habilitarCampos() {
            if($("#tipo_animal").val() == 'Gato') {
                $("#raca_gato").prop('disabled', false);
                $("#raca_cao").prop('disabled', true);
            } else {
                $("#raca_gato").prop('disabled', true);
                $("#raca_cao").prop('disabled', false);
            }
        }
    </script>
</body>

</html>
