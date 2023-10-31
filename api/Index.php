<?php
require_once 'connection.php';

// Aqui ele verifica se a categoria da Match

if (isset($_GET['category'])) {
    $category = $_GET['category'];

// Aqui ele prepara uma consulta ao banco de dados, onde tem que ser ativo e com a categoria que vem do Front-end
    $query = "SELECT * FROM Products WHERE active=1 and categoryName = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $category);
    $stmt->execute();

    $result = $stmt->get_result();

// Depois de pegar o resultado, ele devolve pro front-end já em formato HTML e também faz um looping para exibir os produtos
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
            echo '            <div class="product__item__price">R$' . $row['price'] . '</div>';
            echo '            <div class="cart_add">';
            echo '<a href="../shop.html">Conheça nossa loja!</a>';
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