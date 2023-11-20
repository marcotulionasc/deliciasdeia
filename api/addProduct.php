<?php
// Verifique se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Verifique se o cookie 'carrinho' já existe
    if (isset($_COOKIE['carrinho'])) {
        $carrinho = unserialize($_COOKIE['carrinho']);
    } else {
        $carrinho = array();
    }

    // Adicione o produto ao carrinho
    if (isset($carrinho[$product_id])) {
        $carrinho[$product_id]++;
    } else {
        $carrinho[$product_id] = 1;
    }

    // Armazene o carrinho no cookie
    setcookie('carrinho', serialize($carrinho), time() + 3600, '/');
}

// Redirecionar para a página de origem com uma mensagem na URL
header('Location: Products.php' );
exit();
?>
