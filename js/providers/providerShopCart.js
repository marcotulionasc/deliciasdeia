function fetchProducts(idProduto) {
    
    $.ajax({
        url: "api/exibirProducts.php",
            method: "GET",
            success: function(response) {
                $("#dataShopCart").html(response);
            },
            error: function() {
                alert("Erro ao carregar os dados do PHP.");
            }
        });
    fetchProducts();
}

