<?php
include 'conexao.php';

if (isset($_GET['cliente'])) {
    $cliente = $_GET['cliente'];

    $sql = "SELECT cidade FROM clientes WHERE nome = '$cliente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['cidade'];
    } else {
        echo "Não encontrado no Banco de Dados";
    }
}
$conn->close();
?>