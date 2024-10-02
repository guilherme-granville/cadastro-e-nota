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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $codigo = $_POST['codigo_de_barras'];
        $stmt = $conn->prepare("DELETE FROM produtos WHERE codigo_de_barras = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $stmt->close();
        header('Location: verificar_produtos.php');
        exit;
    } elseif (isset($_POST['edit'])) {
        $codigo = $_POST['codigo_de_barras'];
        $campo = $_POST['campo'];
        $valor = $_POST['valor'];
        $stmt = $conn->prepare("UPDATE produtos SET $campo = ? WHERE codigo_de_barras = ?");
        $stmt->bind_param("ss", $valor, $codigo);
        $stmt->execute();
        $stmt->close();
        header('Location: verificar_produtos.php');
        exit;
    }
}

$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'nome_ASC';
$order_parts = explode('_', $order_by);
$order_field = $order_parts[0];
$order_direction = isset($order_parts[1]) ? $order_parts[1] : 'ASC';

$sql = "SELECT codigo_de_barras, nome, preco FROM produtos";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql .= " WHERE nome LIKE '%$search%'";
}
$sql .= " ORDER BY $order_field $order_direction";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>    
    <link rel="shortcut icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/produtos.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <a class="a" href="/">&#8617; Início (/)</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>
    <h1>Produtos</h1>
    <form method="GET" action="" class="search-container">
        <label for="search">Pesquisar por nome:</label>
        <input type="text" id="search" name="search" placeholder="Digite o nome do produto" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        <button type="submit">Pesquisar</button>
        <a href="?">Mostrar todos</a>
    </form>
    <form method="GET" action="" class="order-container">
        <label for="order_by">Ordenar por:</label>
        <select id="order_by" name="order_by">
            <option value="nome_ASC" <?= ($order_field == 'nome' && $order_direction == 'ASC') ? 'selected' : '' ?>>Nome (Ascendente)</option>
            <option value="nome_DESC" <?= ($order_field == 'nome' && $order_direction == 'DESC') ? 'selected' : '' ?>>Nome (Descendente)</option>
            <option value="preco_ASC" <?= ($order_field == 'preco' && $order_direction == 'ASC') ? 'selected' : '' ?>>Preço (Ascendente)</option>
            <option value="preco_DESC" <?= ($order_field == 'preco' && $order_direction == 'DESC') ? 'selected' : '' ?>>Preço (Descendente)</option>
        </select>
        <button type="submit">Ordenar</button>
    </form>

    <?php
    echo '<table>';
    echo '<tr><th>Código de Barras</th><th>Nome</th><th>Preço</th><th>Deletar</th></tr>';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['codigo_de_barras']} <span class='icon edit-icon' onclick='openEditModal(\"{$row['codigo_de_barras']}\", \"codigo_de_barras\", \"{$row['codigo_de_barras']}\")'>&#x270E;</span></td>
                    <td>{$row['nome']} <span class='icon edit-icon' onclick='openEditModal(\"{$row['codigo_de_barras']}\", \"nome\", \"{$row['nome']}\")'>&#x270E;</span></td>
                    <td>R$ {$row['preco']} <span class='icon edit-icon' onclick='openEditModal(\"{$row['codigo_de_barras']}\", \"preco\", \"{$row['preco']}\")'>&#x270E;</span></td>
                    <td>
                        <form method='POST' action=''>
                            <input type='hidden' name='codigo_de_barras' value='{$row['codigo_de_barras']}'>
                            <button type='submit' name='delete' class='delete-button' onclick='return confirmDelete(\"{$row['codigo_de_barras']}\")'>
                                <span class='icon delete-icon'>&#x1F5D1;</span>
                            </button>
                        </form>
                    </td>
                  </tr>";
        }
    } else {
        echo '<tr><td colspan="4">Nenhum produto encontrado</td></tr>';
    }
    echo '</table>';
    ?>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Editar Produto</h2>
            <form method="POST" action="">
                <input type="hidden" id="editCodigo" name="codigo_de_barras">
                <label for="editCampo">Campo:</label>
                <input type="text" id="editCampo" name="campo" readonly><br><br>
                <label for="editValor">Novo Valor:</label>
                <input type="text" id="editValor" name="valor"><br><br>
                <button type="submit" name="edit">Salvar</button>
            </form>
        </div>
    </div>

    <footer>
        <p>Granville & Granville</p>
    </footer>

    <script>
    function openEditModal(codigo, campo, valor) {
        document.getElementById('editCodigo').value = codigo;
        document.getElementById('editCampo').value = campo;
        document.getElementById('editValor').value = valor;
        document.getElementById('editModal').style.display = "block";
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('editModal')) {
            closeEditModal();
        }
    }

    function confirmDelete(codigo) {
        return confirm("Tem certeza que deseja deletar o produto com código de barras " + codigo + "?");
    }
    document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case '/':
            window.location.href = '/';
            break;
        default:
            break;
    }
});
    </script>
</body>
</html>
