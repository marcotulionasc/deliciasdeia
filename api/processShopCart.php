<?php
require_once 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProduct = $_POST["idProduct"];

    // Suponha que a tabela 'Order' tenha colunas 'order_id' (auto-incremento) e 'product_id'
    $sql = "INSERT INTO OrderProducts (idProduct) VALUES ('$idProduct')";

    if (mysqli_query($db, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($db)]);
    }
} else {
    echo json_encode(["success" => false]);
}


// Consulta para obter os produtos em um pedido específico
$sql = "SELECT P.* FROM Products P
        INNER JOIN OrderProducts O ON P.idProduct = O.idProduct
        WHERE O.idOrder = O.idOrder";

$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class='product__cart__item'>";
        echo "<img src='api/displayImage.php?produto_id=" . $row['idProduct'] . "'>";
        echo "<div class='product__cart__item__text'>";
        echo "<h6>" . $row['nameProduct'] . "</h6>";
        echo "<h5>" . $row['price'] . "</h5>";
        echo "</div>";
        echo "</td>";
        echo "<td class='quantity__item'>";
        echo "<div class='quantity'>";
        echo "<div class='pro-qty'>";
        echo "<input type='text' value='1'>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        echo "<td class='cart__price'>R$ 30.00</td>";
        echo "<td class='cart__close'><span class='icon_close'></span></td>";
        echo "</tr>";
    }
} else {
    echo "Nenhum produto encontrado no pedido.";
}
?>
