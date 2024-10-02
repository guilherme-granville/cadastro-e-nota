<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
$host = "localhost";
$usuario = "granville_bd";
$senha = "a99681060*";
$banco = "granville_site";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>