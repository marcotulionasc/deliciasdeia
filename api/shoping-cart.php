<?php
// O carrinho existe, então ele guarda nos Cookies da página
// Se não for o caso ele devolve o array
if (isset($_COOKIE['carrinho'])) {
    $carrinho = unserialize($_COOKIE['carrinho']);
} else {
    $carrinho = array();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delicias Deia</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">

    <script src="../script.js"></script>
</head>

<body>
    <!-- Here is a page Preloder, this implementation is optional -->
    <!-- Page Preloder <div id="preloder"> <div class="loader"></div> </div> -->

    <!-- Logo of webiste -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">

        <div class="offcanvas__logo">
            <a href="../index.html"><img src="../img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__option">

        </div>
    </div>
    <!-- End Logo of webiste -->

    <!-- Navigation shop-details -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__top__inner">
                            <div class="header__top__left">
                            </div>
                            <div class="header__logo">
                                <a href="../index.html"><img src="../img/deliciasDeiaLogo.png"
                                        alt="Logo delicias da deia"></a>
                            </div>
                            <div class="header__top__right">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="../index.html">Início</a></li>
                            <li><a href="../shop.html">Loja</a></li>
                            <li class="active"><a href="shoping-cart.php">Carrinho</a></li>
                            <li><a href="../contact.html">Contato</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- End navigation shop-details -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Carrinho</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="../index.html">Início</a>
                        <span>Carrinho</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Começo da lógica de implementação do carrinho -->

                                <?php
                                require_once 'connection.php';

                                // Inicialize a variável da mensagem do WhatsApp fora do loop
                                $message = 'Meu pedido: ' . PHP_EOL;
                                $totalCompra = 0;
                                $couponCode = 'MARCO2023'; // Aqui tem que ser o mesmo do JavaScript
                                
                                // Verifique se o código do cupom é válido
                                if ($couponCode === 'MARCO2023') {
                                    // Defina o valor do desconto
                                    $discountAmount = 10; // Substitua pelo valor do desconto desejado
                                
                                    // Recalcule o total com o desconto
                                    $totalCompra -= $discountAmount;
                                } else {
                                    echo "Erro na aplicação do desconto, cupom inválido ou expirado";
                                }


                                foreach ($carrinho as $product_id => $quantity) {
                                    // Consulta para obter o produto específico pelo ID do produto
                                    $query = "SELECT * FROM Products WHERE idProduct = $product_id AND active = 1";
                                    $result = $db->query($query);

                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Adicione os detalhes do produto à mensagem do WhatsApp
                                            $message .= 'Nome: ' . $row['nameProduct'] . PHP_EOL;
                                            $message .= 'Quantidade: ' . $quantity . PHP_EOL;
                                            $message .= 'Preço: R$ ' . $row['price'] . PHP_EOL;

                                            $totalCompra += ($row['price'] * $quantity);

                                            // Código que exibe produto no carrinho
                                            echo '<tr>';
                                            echo '<td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="displayImage.php?produto_id=' . $row['idProduct'] . '" alt="' . $row['nameProduct'] . '" style="width: 200px; height: 150px;">
                                                    <div class="product__cart__item__text">
                                                    <h5 style="text-align: center;">' . $row['nameProduct'] . '</h5>
                                                </div>
                                                    </div>
                                                
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div>
                                                    <input type="number" class="quantity-input" value="' . $quantity . '" data-product-id="' . $row['idProduct'] . '" style="width: 50px;" min="1">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price" data-product-id="' . $row['idProduct'] . '" data-product-price="' . $row['price'] . '">R$ ' . ($row['price'] * $quantity) . '</td>
                                            <td class="cart__remove">
                                            <button class="remove-button" data-product-id="' . $row['idProduct'] . '">Remover</button>
                                        </td>';
                                            echo '</tr>';
                                        }
                                    }
                                }


                                // Adicionando o total da compra à mensagem do WhatsApp
                                $message .= 'Total da compra: R$ ' . $totalCompra . PHP_EOL;

                                // Encode a mensagem para URL
                                $message = rawurlencode($message);

                                // Construa a URL do WhatsApp com a mensagem
                                $whatsapp_url = 'https://wa.me/5519997602293?text=' . $message;
                                ?>

                                <!-- Fim da lógica do carrinho -->
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="../shop.html">Mais alguma coisa?</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="<?php echo $whatsapp_url; ?>" target="_blank"><i class="fa fa-whatsapp"></i>
                                    Enviar para o WhatsApp!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Códigos para desconto</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Aplicar</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Total da compra</h6>
                        <ul>
                            <li>Desconto <span>R$ 00.00</span></li>
                            <li>Total <span>R$ 00.00</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Horário de funcionamento</h6>
                        <ul>
                            <li>Segunda - Sexta: 09 : 00 – 18 : 00</li>
                            <li>Sábado: 07 : 00 – 12 : 00</li>
                            <li>Domingo: 07 : 00 – 12 : 00</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/deliciasDeiaFooter.png" alt=""></a>
                        </div>
                        <p>Transformando simplicidade em doçura e momentos em memórias açucaradas, um sabor de
                            felicidade a cada mordida.</p>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="https://api.whatsapp.com/send?phone=+5519996062135"><i
                                    class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__newslatter">
                        <h6>Inscreva-se</h6>
                        <p>E fique ligado as nossas novidades e promoções.</p>
                        <form action="#">
                            <input type="text" placeholder="Digite seu melhor e-mail!">
                            <button type="submit"><i class="fa fa-send-o"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <p class="copyright__text text-white">
                            Copyright &copy; Delicias Déia 2023
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="copyright__widget">
                            <ul>
                                <li><a href="#">Politicas e privacidades</a></li>
                                <li><a href="#">Termos e condições</a></li>

                                <li><a href="#">Whatsapp</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.nice-select.min.js"></script>
    <script src="../js/jquery.barfiller.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.nicescroll.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const quantityInput = document.querySelector(".quantity-input");

        quantityInput.addEventListener("input", (event) => {
            const value = event.target.value;

            if (value <= 0) {
                event.target.value = "";
                alert("A quantidade deve ser maior que 0.");
            }
        });


        // Aqui eu fiz uma var que controla se o desconto foi aplicado
        let discountApplied = false;

        // Função para atualizar o carrinho de compras no armazenamento local (localStorage)
        function updateCartInLocalStorage() {
            localStorage.setItem('cart', JSON.stringify(cartData));
        }
        // Função para calcular o subtotal e o total do carrinho
        function calcularTotal() {
            let subtotal = 0;

            // Loop através de cada item no carrinho
            $('.cart__price').each(function () {
                const price = parseFloat($(this).data('product-price'));
                const quantity = parseInt($(this).closest('tr').find('.quantity-input').val());
                const itemTotal = price * quantity;
                subtotal += itemTotal;
            });

            // Atualize o subtotal e o total na página
            const totalElement = $('.cart__total li:last span');
            totalElement.text('R$ ' + subtotal.toFixed(2));

            if (discountApplied) {
                const discountAmount = 10; // Substitua pelo valor do desconto desejado
                const total = subtotal - discountAmount;
                $('.cart__total li:first span').text('R$ ' + discountAmount);
                totalElement.text('R$ ' + total.toFixed(2));

            }
        }

        // Função para atualizar o preço ao alterar a quantidade
        function updatePrice(productId, quantity) {
            const priceElement = $(`.cart__price[data-product-id="${productId}"]`);
            const productPrice = parseFloat(priceElement.data('product-price'));
            const newPrice = productPrice * quantity;
            priceElement.text(`R$ ${newPrice.toFixed(2)}`);

            // Atualizar o preço no armazenamento local (localStorage)
            const cartData = JSON.parse(localStorage.getItem('cart')) || {};
            cartData[productId] = quantity;
            localStorage.setItem('cart', JSON.stringify(cartData));

            // Após atualizar o preço, recalcule o total
            calcularTotal();
        }

        function applyCoupon(couponCode) {
            if (!discountApplied && couponCode === 'MARCO2023') { // Verifica se o desconto ainda não foi aplicado
                // Defina aqui o valor do desconto
                const discountAmount = 10; // Substitua pelo valor do desconto desejado
                // Recalcule o total com o desconto
                const subtotalElement = $('.cart__total li:last span');
                const subtotal = parseFloat(subtotalElement.text().replace('R$ ', ''));
                const total = subtotal - discountAmount;
                // Atualize o total na página
                $('.cart__total li:first span').text('R$ ' + discountAmount);
                subtotalElement.text('R$ ' + total.toFixed(2));
                // Marque o desconto como aplicado
                discountApplied = true;

            } else if (discountApplied) {
                alert('O desconto já foi aplicado.');
            } else {
                alert('Cupom de desconto inválido');
            }
        }
        // Adicione um manipulador de eventos para o botão "Remover"
        $('.remove-button').on('click', function () {
            const productId = $(this).data('product-id');
            // Remova o produto do carrinho no armazenamento local (localStorage)
            const cartData = JSON.parse(localStorage.getItem('cart')) || {};
            delete cartData[productId];
            localStorage.setItem('cart', JSON.stringify(cartData));

            // Remova a linha da tabela do carrinho
            $(this).closest('tr').remove();
            delete cartData[productId];

            // Recalcule o total após remover o produto
            calcularTotal();

        });

        // Lidar com o envio do formulário de cupom de desconto
        $('form').submit(function (e) {
            e.preventDefault();
            const couponCode = $('input[type="text"]').val();
            applyCoupon(couponCode);
        });

        // Lidar com a mudança na quantidade
        $('.quantity-input').on('change', function () {
            const productId = $(this).data('product-id');
            const newQuantity = parseInt($(this).val());
            updatePrice(productId, newQuantity);
        });

        // Recuperar o estado do carrinho do armazenamento local (localStorage)
        const cartData = JSON.parse(localStorage.getItem('cart')) || {};
        for (const productId in cartData) {
            const quantity = cartData[productId];
            updatePrice(productId, quantity);
        }

        // Chame a função de cálculo inicial para definir o valor correto na primeira carga da página
        calcularTotal();

    </script>

</body>

</html>