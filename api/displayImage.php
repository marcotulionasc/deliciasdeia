<?php
require_once 'connection.php';

if (isset($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];

    // Consulta para obter a imagem do produto com base no ID
    $query = "SELECT image FROM Products WHERE idProduct = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $produto_id);
    $stmt->execute();
    $stmt->bind_result($image);

    if ($stmt->fetch()) {
        // Define o cabeçalho Content-type para a imagem
        header("Content-type: image/jpeg"); // Altere para o tipo de imagem correto, se necessário
        echo $image;
    }

    $stmt->close();
}

$db->close();
?>