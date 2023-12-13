<?php
session_start();

require_once '../../domPDF/vendor/autoload.php';

if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    unset($_SESSION['matricula']);
    header('Location: ../../index.php');
}

$matricula = $_SESSION['matricula'];

include "../../sql/conexao.php";

// referenciando o namespace do dompdf
use Dompdf\Dompdf;

// instanciando o dompdf
$dompdf = new Dompdf();

// Definindo o conteúdo HTML diretamente no script PHP
$html = '
<html>
<head></head>
<body>
<h1 style="text-align: center">Relatório de Pagamentos</h1>
<table id="busca-pagamento" class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr class="topo-colunas" style="background-color: #4CAF50; color: white;">
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Recebedor</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">CPF/CNPJ</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Telefone</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Valor a pagar</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Forma pagamento</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Dinheiro</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Parcelas</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Data pagamento</th>
        </tr>
    </thead>
    <tbody>';

$sql = "SELECT * 
    FROM lancar_despesa_pagamento
    ORDER BY id_pagamento DESC";
$busca = mysqli_query($conn, $sql);

$count = 0;

while ($array = mysqli_fetch_array($busca)){
    /*$id_pagamento = $array['id_pagamento'];
    $recebedor = $array['recebedor'];
    $cpfcnpj = $array['cpfcnpj'];
    $telefone = $array['telefone'];
    $forma_pagamento = $array['forma_pagamento'];
    $dinheiro = $array['dinheiro'];
    $parcelado = $array['parcelado'];
    $data_pagamento = $array['data_pagamento'];*/

    $html .= '
    <tr style="font-size: 14px">
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['recebedor'] . '</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['cpfcnpj'] . '</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['telefone'] . '</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['valor_pagar'] . '</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['forma_pagamento'] . '</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['dinheiro'] . '</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['parcelado'] . '</td>
        <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $array['data_pagamento'] . '</td>   
    </tr>';
}

$html .= '
    </tbody>
</table>
</body>
</html>
';

// inserindo o HTML que queremos converter
$dompdf->loadHtml($html);

// Definindo o papel e a orientação
$dompdf->setPaper('A4', 'landscape');

// Renderizando o HTML como PDF
$dompdf->render();

// Enviando o PDF para o browser
$dompdf->stream('relatorio-pagamentos.pdf');
