<?php
session_start();

session_set_cookie_params([
    'lifetime' => 10800,
    'path' => '/',
    'domain' => 'ggranville.shop',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

include 'php/conexao.php';

$logoutMessage = '';
if (isset($_GET['message'])) {
    $logoutMessage = htmlspecialchars($_GET['message']);
}

$rememberedUsuario = isset($_COOKIE['remember_usuario']) ? $_COOKIE['remember_usuario'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT usuario FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $stmt->bind_result($dbUsuario);

    if ($stmt->fetch()) {
        $_SESSION['usuario'] = $dbUsuario;

        // Sempre lembrar do usuário
        setcookie('remember_usuario', $dbUsuario, time() + (30 * 24 * 60 * 60), "/");

        header("Location: /");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
    
</head>
<body>
    <div class="login-container">
        <h2>Faça o login para continuar</h2>
        <?php 
        if (!empty($logoutMessage)) { 
            echo "<p>$logoutMessage</p>"; 
        } 
        if (isset($erro)) { 
            echo "<p>$erro</p>"; 
        } 
        ?>
        <form method="post" action="">
            <input type="text" name="usuario" placeholder="Usuário" value="<?php echo htmlspecialchars($rememberedUsuario); ?>" required autocomplete="off">
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Login">
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Granville & Granville. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
