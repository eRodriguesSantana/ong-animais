<?php
session_start();

require_once '../../domPDF/vendor/autoload.php';

if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
    unset($_SESSION['matricula']);
    header('Location: ../index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

$dataAnimais = $_SESSION['dataAnimais'];
// referenciando o namespace do dompdf
use Dompdf\Dompdf;

// instanciando o dompdf
$dompdf = new Dompdf();

// Definindo o conteúdo HTML diretamente no script PHP
$html = '
<html>
<head></head>
<body>
<h1 style="text-align: center">Relatório de Animais</h1>
<table id="busca-animal" class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr class="topo-colunas" style="background-color: #4CAF50; color: white;">
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Nome do animal</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Sexo</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Tipo</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Raça</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Cor</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Peso aproximado</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Observação</th>
            <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: left;">Data entrada</th>
        </tr>
    </thead>
    <tbody>';

foreach ($dataAnimais as $data) {
    $html .= '
        <tr style="font-size: 14px">
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['nome_animal'] . '</td>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['sexo_animal'] . '</td>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['tipo_animal'] . '</td>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['raca'] . '</td>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['cor_animal'] . '</td>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['peso_aproximado'] . 'Kg</td>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['observacao'] . '</td>
            <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $data['data_entrada'] . '</td>     
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
$dompdf->stream('relatorio-animais.pdf');
