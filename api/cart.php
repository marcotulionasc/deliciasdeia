<?php
// Verifique se o cookie 'carrinho' existe
if (isset($_COOKIE['carrinho'])) {
    $carrinho = unserialize($_COOKIE['carrinho']);
} else {
    $carrinho = array();
}
?>

<html>
<head>
    <title>Carrinho de Compras</title>
</head>
<body>
    <h1>Carrinho de Compras</h1>
    <ul>
        <?php
        foreach ($carrinho as $product_id => $quantity) {
            echo "<li>Produto $product_id - Quantidade: $quantity</li>";
        }
        ?>
    </ul>
    <a href="index.php">Continuar Comprando</a>
</body>
</html>
