<?php
require_once 'connection.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $query = "SELECT * FROM Products WHERE active=1 and categoryName = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $category);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-3 col-md-6 col-sm-6">';
            echo '    <div class="product__item">';
            echo '        <div class="product__item__pic set-bg">';
            echo '            <img src="api/displayImage.php?produto_id=' . $row['idProduct'] . '" alt="' . $row['nameProduct'] . '">';
            echo '            <div class="product__label">';
            echo '                <span>' . $row['categoryName'] . '</span>';
            echo '            </div>';
            echo '        </div>';
            echo '        <div class="product__item__text">';
            echo '            <h6><a href="#">' . $row['nameProduct'] . '</a></h6>';
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
        echo "Nenhum item encontrado na categoria $category.";
    }

    $stmt->close();
} else {
    echo "Categoria não especificada.";
}

$db->close();
?>
