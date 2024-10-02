<?php
include 'conexao.php';

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['codigo_de_barras'])) {
    $codigo_de_barras = $_GET['codigo_de_barras'];

    $sql = "SELECT nome, preco FROM produtos WHERE codigo_de_barras = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_de_barras);
    $stmt->execute();
    $stmt->bind_result($nome, $preco);
    
    if ($stmt->fetch()) {
        echo json_encode(['nome' => $nome, 'preco' => $preco]);
    } else {
        echo json_encode(['nome' => '', 'preco' => 0]);
    }

    $stmt->close();
}

$conn->close();
?>
