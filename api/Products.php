<?php
session_start();
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
require_once 'connection.php';

// Número de itens por página
$itensPorPagina = 8;

// Página atual (padrão para 1 se não for definido)
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 2;

// Validar e ajustar a página atual
if ($paginaAtual < 1) {
    $paginaAtual = 1;
}

$totalProdutos = $db->query("SELECT COUNT(*) as total FROM Products WHERE active = TRUE")->fetch_assoc()['total'];

// Calcular o offset (deslocamento) com base na página atual
$offset = ($paginaAtual - 1) * $itensPorPagina;

$query = "SELECT * FROM Products WHERE active = 1 LIMIT $itensPorPagina OFFSET $offset";
$result = $db->query($query);

// Verifica se a consulta foi bem-sucedida
if ($result) {
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
        echo '            <div class="product__item__price">R$ ' . $row['price'] . '</div>';
        echo '            <div class="cart_add">';
        echo '<a href="api/addProduct.php?id=' . $row['idProduct'] . '">Adicionar ao carrinho</a>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
    echo '</div>';

    // Adiciona links de navegação
    echo '<div class="shop__pagination">';
    for ($i = 1; $i <= ceil($totalProdutos / $itensPorPagina); $i++) {
        // Adiciona os parâmetros existentes na URL
        $parametrosURL = http_build_query(array_merge($_GET, ['pagina' => $i]));
        echo '<a href="?' . $parametrosURL . '">' . $i . '</a>';
    }
    echo '</div>';

} else {
    echo "Erro na consulta: " . $db->error;
}

$db->close();
?>
