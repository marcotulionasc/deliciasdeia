<?php
require_once 'connection.php';

if (isset($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];

    $query = "SELECT image FROM Products WHERE idProduct = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $produto_id);
    $stmt->execute();
    $stmt->bind_result($image);

    if ($stmt->fetch()) {
        
        header("Content-type: image/jpeg"); 
        echo $image;
    }

    $stmt->close();
}

$db->close();
?>