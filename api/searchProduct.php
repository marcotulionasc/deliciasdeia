<?php
require_once 'connection.php';

$produtosPorPagina = 8;

$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $produtosPorPagina;

$searchTerm = isset($_GET['q']) ? $_GET['q'] : '';
$whereClause = $searchTerm !== '' ? "AND nameProduct LIKE '%$searchTerm%'" : "";

$query = "SELECT * FROM Products WHERE active=1 $whereClause ORDER BY price ASC LIMIT $produtosPorPagina OFFSET $offset";
$result = $db->query($query);

if ($result) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-3 col-md-6 col-sm-6">';
        echo '    <div class="product__item">';
        echo '        <div class="product__item__pic set-bg">';
        echo '            <img src="displayImage.php?produto_id=' . $row['idProduct'] . '" alt="' . $row['nameProduct'] . '">';
        echo '            <div class="product__label">';
        echo '                <span>' . $row['categoryName'] . '</span>';
        echo '            </div>';
        echo '        </div>';
        echo '        <div class="product__item__text">';
        echo '            <h6><a href="#">' . $row['nameProduct'] . '</a></h6>';
        echo '            <div class="product__item__price">R$ ' . str_replace('.', ',', $row['price']) . '</div>';
        echo '            <div class="cart_add">';
        echo '<a href="addProduct.php?id=' . $row['idProduct'] . '">Adicionar ao carrinho</a>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
     echo '</div>';

    $query = "SELECT COUNT(*) as total FROM Products WHERE active=1";
    $result = $db->query($query);
    $totalProdutos = $result->fetch_assoc()['total'];
    $totalPaginas = ceil($totalProdutos / $produtosPorPagina);

    echo '<div class="shop__pagination">';
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo '<a href="Products.php?pagina=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';
    
} else {
    echo "Erro na consulta: " . $db->error;
}

$db->close();
?>
