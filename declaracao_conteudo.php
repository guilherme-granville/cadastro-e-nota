<?php
session_start();
include 'php/conexao.php';
if (!isset($_SESSION['usuario'])) {
    if (isset($_COOKIE['remember_usuario'])) {
        $_SESSION['usuario'] = $_COOKIE['remember_usuario'];
    } else {
        header('Location: login');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <link rel="stylesheet" href="css/declaracao.css">
    <title>Declaração de Conteúdo</title>
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
</head>

<body class="c40 doc-content">
    <nav>
        <ul>
            <li>
                <a class="a" href="/">&#8617; Início (/)</a>
            </li>
        </ul>
    </nav>
    <p class="c1 c17"><span class="c18"></span></p>
    <table class="c20">
        <tr class="c38">
            <td class="c31" colspan="1" rowspan="1">
                <p class="c15"><span class="c22">ROMANEIO</span></p>
            </td>
        </tr>
    </table>
    <p class="c1 c17"><span class="c18"></span></p>
    <p class="c33"><span class="c3"></span></p>
    <table class="c7">
        <tr class="c10">
            <td class="c26" colspan="10" rowspan="1">
                <p class="c23"><span class="c21">Destinatário:</span></p>
            </td>
        </tr>
        <tr class="c10">
            <td class="c13 t1" colspan="2" rowspan="1">
                <p class="c19"><span class="c5">Nome:</span> <span id="cliente" class="c5"></span></p>
            </td>
            <td class="c13 t2" colspan="6" rowspan="1">
                <p class="c19"><span class="c5">Cidade:</span> <span id="cidade" class="c5"></span></p>
            </td>
            <td class="c13 t3" colspan="2" rowspan="1">
                <p class="c19"><span class="c0">Data:</span> <span id="data" class="c0"></span></p>
            </td>
        </tr>
    </table>
    <p class="c33"><span class="c27"></span></p>
    <table class="c7">
        <tr class="c14">
            <td class="c2 c4" colspan="7" rowspan="1">
                <p class="a1"><span class="c5">Item</span></p>
            </td>
            <td class="c30 c4" colspan="3" rowspan="1">
                <p class="a2"><span class="c5">Valor unitário</span></p>
            </td>
            <td class="c33 c4" colspan="2" rowspan="1">
                <p class="a3"><span class="c5">Quantidade</span></p> 
            </td>
            <td class="c4" colspan="3" rowspan="1">
                <p class="a4"><span class="c5">Valor total</span></p>
            </td>
        </tr>
        <tbody id="conteudoTabela">
        </tbody>
        <tr class="c14">
            <td class="c36" colspan="12" rowspan="1">
                <p class="c39"><span class="c5">VALOR TOTAL:</span></p>
            </td>
            <td class="c11" colspan="3" rowspan="1">
                <p id="valorTotal" class="c9"><span class="c5"></span></p>
            </td>
        </tr>
    </table>
    <p class="c16"><span class="c29"></span></p>

    <button id="printButton" class="print-button">Imprimir Romaneio</button>

    <script src="js/declaracao_conteudo.js" defer></script>
</body>

</html>
