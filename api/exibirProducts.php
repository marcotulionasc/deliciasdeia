<?php
require_once 'connection.php';

$sql = "SELECT * FROM Products";
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
        echo "<td class='cart__price'>$ 30.00</td>";
        echo "<td class='cart__close'><span class='icon_close'></span></td>";
        echo "<td><button onclick=\"adicionarAoCarrinho(" . $row['idProduct'] . ")\">Adicionar ao Carrinho</button></td>";
        echo "</tr>";
    }
} else {
    echo "Nenhum produto encontrado.";
}
?>
