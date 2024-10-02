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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <link rel="stylesheet" href="css/outra_pagina.css">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="container">
        <section>
            <a href="/" class="a" style="display: flex; flex-direction: row;">&#8617; Início (/)</a>
            <a href="logout.php" class="logout-btn">Logout</a>
            <h2>Detalhes do Romaneio</h2>
            <div id="detalhesRomaneio"></div>
        </section>
        <div class="container2">
            <section class="section1">
                <form id="codBarras" class="codBarras">
                    <fieldset>
                        <tbody>
                            <tr>
                                <th><input type="number" id="codBarrasInput" placeholder="Código de Barras" required autocomplete="off"></th>
                                <th><button type="submit">Adicionar</button></th>
                            </tr>
                        </tbody>
                    </fieldset>
                </form>
            </section>
            <section>
                <h2>Declaração de Conteúdo</h2>
                <form id="declaracaoForm" action="declaracao-de-conteudo" method="get">
                    <input id="declaracao" type="submit" value="Imprimir Declaração (*)">
                </form>
            </section>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Granville & Granville. Todos os direitos reservados.</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/outra_pagina.js"></script>
</body>

</html>
