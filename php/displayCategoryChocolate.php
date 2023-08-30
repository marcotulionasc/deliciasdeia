<?php
require_once 'db_connection.php';

$query = "SELECT title, image, price FROM products WHERE Category = ?";

$stmt = $conn->prepare($query);
$category = "Chocolate"; // Categoria desejada

$stmt->bind_param("s", $category);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-3 col-md-6 col-sm-6">';
        echo '    <div class="product__item">';
        echo '        <div class="product__item__pic set-bg" data-setbg="' . $row['image'] . '">';
        echo '            <div class="product__label">';
        echo '                <span>Chocolate</span>';
        echo '            </div>';
        echo '        </div>';
        echo '        <div class="product__item__text">';
        echo '            <h6><a href="#">' . $row['title'] . '</a></h6>';
        echo '            <div class="product__item__price">$' . $row['price'] . '</div>';
        echo '            <div class="cart_add">';
        echo '                <a href="#">Pedir no Whatsapp!</a>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "Nenhum item encontrado na categoria Chocolate.";
}

$stmt->close();
$conn->close();


?>