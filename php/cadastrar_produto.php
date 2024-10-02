<?php
include 'conexao.php';

$codigo_de_barras = $_POST['codigo_de_barras'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];

$verificar_sql = "SELECT codigo_de_barras FROM produtos WHERE codigo_de_barras = '$codigo_de_barras'";
$verificar_result = $conn->query($verificar_sql);

if ($verificar_result->num_rows > 0) {
    echo json_encode(array("status" => "error", "message" => "Erro ao cadastrar o produto: Código de barras já existe no banco de dados."));
} else {
    $inserir_sql = "INSERT INTO produtos (codigo_de_barras, nome, preco) VALUES ('$codigo_de_barras', '$nome', '$preco')";

    if ($conn->query($inserir_sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Produto cadastrado com sucesso!"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erro ao cadastrar o produto: " . $conn->error));
    }
}

$conn->close();
?>
