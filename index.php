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
    <title>Sistema de Caixa</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="manifest.json">
</head>

<body id="CorpoCadastro">
    <a href="logout.php" class="logout-btn">Logout</a>

    <div id="janela_flutuante" class="container">
        <nav>
            <ul>
                <li>
                    <a href="cadastro">Página de Cadastro (+)</a>
                </li>
                <li>
                    <a href="produtos">Produtos (-)</a>
                </li>
            </ul>
        </nav>
        <h2>Criar Nota</h2>

        <section class="">
            <label for="clienteInput">Cliente:</label>
            <input type="text" list="cliente" id="clienteInput" placeholder="cliente" required>
            <datalist id="cliente">
                <option value="Arlete">Arlete</option>
                <option value="Bazar">Bazar</option>
                <option value="Cajú">Cajú</option>
                <option value="Casa do Mel">Casa do Mel</option>
                <option value="Cíntia">Cíntia</option>
                <option value="Clair">Clair</option>
                <option value="Claudinete">Claudinete</option>
                <option value="Daniel">Daniel</option>
                <option value="Denise">Denise</option>
                <option value="Eloi">Eloi</option>
                <option value="Equilíbrio Vital">Equilíbrio Vital</option>
                <option value="Jorge">Jorge</option>
                <option value="José">José</option>
                <option value="Kelly">Kelly</option>
                <option value="Leonice">Leonice</option>
                <option value="Viva Mais">Viva Mais</option>
                <option value="Marly">Marly</option>
                <option value="Rosimere">Rosimere</option>
                <option value="Neide">Neide</option>
                <option value="Nice">Nice</option>
                <option value="Odete">Odete</option>
                <option value="Paulo">Paulo</option>
                <option value="Valter">Valter</option>
                <option value="Rejane">Rejane</option>
                <option value="Eliane">Eliane</option>
                <option value="Laudicéia">Laudicéia</option>
                <option value="Esmael">Esmael</option>
                <option value="Silmara">Silmara</option>
                <option value="Maristela">Maristela</option>
                <option value="Loja Lavanda">Loja Lavanda</option>
                <option value="Fernanda">Fernanda</option>
                <option value="Célia">Célia</option>
                <option value="Flor de Liz">Flor de Liz</option>
                <option value="Lucas">Lucas</option>
                <option value="Lurdes">Lurdes</option>
                <option value="Sebastião">Sebastião</option>
                <option value="Leda">Leda</option>
                <option value="Aniz">Aniz</option>
                <option value="Cirlei">Cirlei</option>
                <option value="Márcia">Márcia</option>
            </datalist>

            <label for="data" class="dataNota">Data:</label>
            <input type="date" id="data" required>

            <button type="button" onclick="adicionarRomaneio()">Começar</button>
        </section>
    </div>

    <script src="js/main.js" defer></script>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js').then(registration => {
                console.log('Serviço Iniciado - Service Start', registration.scope);
            }).catch(error => {
                console.log('Falha na inicialização do serviço - Service Fail', error);
            });
        }
    </script>
    <footer>
        <p>&copy; 2024 Granville & Granville. Todos os direitos reservados.</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
