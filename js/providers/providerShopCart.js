function fetchProducts() {
    $.ajax({
        url: "api/processShopCart.php",
        method: "GET",
        data: { idProduto: idProduto }, // Você precisa passar o ID do produto na solicitação GET
        success: function (response) {
            $("#dataShopCart").html(response);
        },
        error: function () {
            alert("Erro ao carregar os dados do PHP.");
        },
    });
}

// Certifique-se de chamar a função em algum lugar, passando o ID do produto
// Por exemplo, ao clicar no botão "Adicionar ao Carrinho":
// fetchProducts(idProduto);
