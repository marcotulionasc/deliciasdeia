<?php
// Dentro de products nos já abrimos uma sessão e vê se tem um carrinho existente
// Caso não tenha ele prepara um Array para o mesmo
session_start();
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
require_once 'connection.php';
// Aqui consultamos os produtos ativos diretmante do banco de dados
$query = "SELECT * FROM Products WHERE active=1";
$result = $db->query($query);
// E devolvemos para o front-end já em HTML o que a gente conseguiu filtrar no banco de dados
if ($result) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-3 col-md-6 col-sm-6">';
        echo '    <div class="product__item">';
        echo '        <div class="product__item__pic set-bg"">';
        echo '            <img src="api/displayImage.php?produto_id=' . $row['idProduct'] . '" alt="' . $row['nameProduct'] . '">';
        echo '            <div class="product__label">';
        echo '                <span>' . $row['categoryName'] . '</span>';
        echo '            </div>';
        echo '        </div>';
        echo '        <div class="product__item__text">';
        echo '            <h6><a href="#">' . $row['nameProduct'] . '</a></h6>';
        echo '            <div class="product__item__price">R$' . $row['price'] . '</div>';
        echo '            <div class="cart_add">';
        echo '<a href="api/addProduct.php?id=' . $row['idProduct'] . '">Adicionar ao carrinho</a>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "Erro na consulta: " . $db->error;
}

$db->close();

?>