<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProduto = $_POST["idProduto"];

    // Aqui, você deve adicionar o produto ao carrinho (pode ser uma tabela no banco de dados ou uma variável de sessão)

    // Por exemplo, adicionando-o a uma variável de sessão chamada 'carrinho':
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    $_SESSION['carrinho'][] = $idProduto;

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
