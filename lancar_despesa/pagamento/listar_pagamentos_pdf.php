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

$sql = "SELECT nome_completo FROM pessoas WHERE matriculausuario = '$matricula' and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];

function formataData($date){
    $newDate = explode("-", $date);
    $newDate2 = explode(" ", $newDate[2]);
      
    return $newDate2[0]."-".$newDate[1]."-".$newDate[0]." ".$newDate2[1]."<br>";
}

?>

<html>
<head>
    <title>Geração Relatório Contas a Pagar</title>
    <style>
        table
        {
            width: 300px;
            font: 17px Calibri;
        }
        table, th, td 
        {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="tabela">
    <table>
                    <thead>
                        <tr class="topo-colunas">
                          <th scope="col">Recebedor</th>
                          <th scope="col">CPF/CNPJ</th>
                          <th scope="col">Telefone</th>
                          <th scope="col">Forma pagamento</th>
                          <th scope="col">Dinheiro</th>
                          <th scope="col">Parcelas</th>
                          <th scope="col">Data pagamento</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT * 
                          FROM lancar_despesa_pagamento
                          ORDER BY id_pagamento ASC";
                      $busca = mysqli_query($conn, $sql);

                      $count = 0;

                      while ($array = mysqli_fetch_array($busca)){
                        $id_pagamento = $array['id_pagamento'];
                        $recebedor = $array['recebedor'];
                        $cpfcnpj = $array['cpfcnpj'];
                        $telefone = $array['telefone'];
                        $forma_pagamento = $array['forma_pagamento'];
                        $endereco = $array['endereco'];
                        $estado = $array['estado'];

                        if($array['observacao_pagamento'] != '')
                            $observacao_pagamento = $array['observacao_pagamento'];
                        else
                            $observacao_pagamento = "Sem observação.";

                        $data_pagamento = $array['data_pagamento'];

                        $dinheiro = $array['dinheiro'];
                        $parcelado = $array['parcelado'];
                      ?>
                        <tr style="font-size: 14px">
                            <td><?php echo $recebedor; ?></td>
                            <td><?php echo $cpfcnpj; ?></td>
                            <td><?php echo $telefone; ?></td>
                            <td><?php echo $forma_pagamento; ?></td>
                            <td><?php echo $dinheiro; ?></td>
                            <td><?php echo $parcelado; ?></td>
                            <td><?php echo formataData($data_pagamento); ?></td>
                            
                            <div id="view-modal<?php echo $count ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog"> 
                                    <div class="modal-content">                  
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                <i class="glyphicon glyphicon-thumbs-up"></i> Detalhes Pagamento
                                            </h4>  
                                        </div> 
                                        <div class="modal-body">                       
                                            <div id="modal-loader" style="display: none; text-align: center;">
                                                <img src="ajax-loader.gif">
                                            </div>                            
                                            <!-- content will be load here -->
                                            <?php
                                                if($forma_pagamento == 'dinheiro'){
                                            ?>
                                                    <div id="wwwdynamic-content">
                                                        CPF/CNPJ: <?php echo $cpfcnpj.'<br>'; ?>
                                                        Valor R$: <?php echo $dinheiro.'<br>'; ?>
                                                        Observação: <?php echo $observacao_pagamento.'<br>'; ?>
                                                        Endereço: <?php echo $endereco.'<br>'; ?>
                                                        Estado: <?php echo $estado.'<br>'; ?>
                                                    </div>
                                            <?php } else { ?>
                                                    <div id="wwwdynamic-content">
                                                        CPF/CNPJ: <?php echo $cpfcnpj.'<br>'; ?>
                                                        Quantidade parcelas: <?php echo $parcelado.'<br>'; ?>
                                                        Observação: <?php echo $observacao_pagamento.'<br>'; ?>
                                                        Endereço: <?php echo $endereco.'<br>'; ?>
                                                        Estado: <?php echo $estado.'<br>'; ?>
                                                    </div>                                                
                                            <?php } ?>
                                        </div> 
                                        <div class="modal-footer"> 
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  
                                        </div>                        
                                    </div> 
                                </div>
                            </div><!-- /.modal -->
                        </tr>
                        <?php $count++ ?>
                      <?php }?>
                    </tbody>
                </table>
    </div>
    <p>
        <input type="button" value="Criar PDF" id="btnImprimir" onclick="CriaPDF()" />
    </p>
</body>

<script>
    function CriaPDF() {
        var minhaTabela = document.getElementById('tabela').innerHTML;
        var style = "<style>";
        style = style + "table {width: 100%;font: 20px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";
        // CRIA UM OBJETO WINDOW
        var win = window.open('', '', 'height=700,width=700');
        win.document.write('<html><head>');
        win.document.write('<title>Geração Relatório Contas a Pagar</title>');   // <title> CABEÇALHO DO PDF.
        win.document.write(style);                                     // INCLUI UM ESTILO NA TAB HEAD
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(minhaTabela);                          // O CONTEUDO DA TABELA DENTRO DA TAG BODY
        win.document.write('</body></html>');
        win.document.close(); 	                                         // FECHA A JANELA
        win.print();                                                            // IMPRIME O CONTEUDO
    }
</script>
</html>