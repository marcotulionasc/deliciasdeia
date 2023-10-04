<?php
require_once 'connection.php'; // Certifique-se de que a conexão com o banco de dados esteja estabelecida (variável $db)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProduto = $_POST["idProduto"];

    // Suponha que a tabela 'Order' tenha colunas 'order_id' (auto-incremento) e 'product_id'
    $sql = "INSERT INTO OrderProducts (idProduct) VALUES ('$idProduto')";

    if (mysqli_query($db, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($db)]);
    }
} else {
    echo json_encode(["success" => false]);
}
?>
