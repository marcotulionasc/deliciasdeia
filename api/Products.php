<?php
session_start();
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
require_once 'connection.php';

/// Classe para Paginação
class Paginacao {
    private $db;
    private $produtosPorPagina;

    public function __construct($db, $produtosPorPagina = 8) {
        $this->db = $db;
        $this->produtosPorPagina = $produtosPorPagina;
    }

    public function getTotalPaginas() {
        $query = "SELECT COUNT(*) as total FROM Products WHERE active=1";
        $result = $this->db->query($query);
        $totalProdutos = $result->fetch_assoc()['total'];
        return ceil($totalProdutos / $this->produtosPorPagina);
    }

    public function getProdutosDaPagina($paginaAtual) {
        $offset = ($paginaAtual - 1) * $this->produtosPorPagina;
        $query = "SELECT * FROM Products WHERE active=1 LIMIT $this->produtosPorPagina OFFSET $offset";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

$paginacao = new Paginacao($db);

// Obtém o número da página atual a partir do parâmetro da URL, se não estiver definido, assume a página 1
$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Obtém os produtos da página atual
$produtos = $paginacao->getProdutosDaPagina($paginaAtual);

echo '<div class="row">';
foreach ($produtos as $row) {
    echo '<div class="col">';
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
    echo '<a href="api/addProduct.php?id=' . $row['idProduct'] . '">Adicionar ao carrinho</a>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '</div>';
}
echo '</div>';

// Adiciona links de paginação
$totalPaginas = $paginacao->getTotalPaginas();
echo '<div class="pagination">';
for ($i = 1; $i <= $totalPaginas; $i++) {
    echo '<a href="?pagina=' . $i . '">' . $i . '</a>';
}
echo '</div>';

echo '</body>';
echo '</html>';

// Fecha a conexão com o banco de dados
$db->close();
?>