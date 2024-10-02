<?php
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE['remember_usuario'])) {
    setcookie('remember_usuario', '', time() - 3600, "/");
}
$logoutMessage = "Você foi desconectado com sucesso.";

header('Location: login?message=' . htmlspecialchars($logoutMessage));
exit;
?>
