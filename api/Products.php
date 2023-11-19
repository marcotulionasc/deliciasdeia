<?php
session_start();
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
require_once 'connection.php';

// Número de itens por página
$itensPorPagina = 8;

// Página atual (padrão para 1 se não for definido)
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Validar e ajustar a página atual
if ($paginaAtual < 1) {
    $paginaAtual = 1;
}

// Calcular o offset (deslocamento) com base na página atual
$offset = ($paginaAtual - 1) * $itensPorPagina;

// Construir a base da consulta SQL sem LIMIT e OFFSET
$baseQuery = "SELECT * FROM Products WHERE active=1";

// Adicionar cláusulas adicionais conforme necessário
// Exemplo: $baseQuery .= " AND category = 'AlgumaCategoria'";

// Consulta SQL para obter os produtos ativos paginados
$query = $baseQuery . " LIMIT $itensPorPagina OFFSET $offset";
$result = $db->query($query);

// Verifica se a consulta foi bem-sucedida
if ($result) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        // (código de exibição dos produtos)
    }
    echo '</div>';

    // Calcula o número total de produtos após a consulta
    $totalProdutos = $db->query("SELECT COUNT(*) as total FROM Products WHERE active=1")->fetch_assoc()['total'];
    $totalPaginas = ceil($totalProdutos / $itensPorPagina);

    // Adiciona links de navegação
    echo '<div class="pagination">';
    for ($i = 1; $i <= $totalPaginas; $i++) {
        // Atualiza apenas o parâmetro 'pagina' na URL
        $parametrosURL = http_build_query(array_merge($_GET, ['pagina' => $i]));
        echo '<a href="?' . $parametrosURL . '">' . $i . '</a>';
    }
    echo '</div>';

} else {
    echo "Erro na consulta: " . $db->error;
}

// Fecha a conexão com o banco de dados
$db->close();
?>
