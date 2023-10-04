function productClicked(idProduct) {
    $.ajax({
        url: "api/processShopCart.php",
        method: "POST",
        data: { idProduct: idProduct}, // Passando idOrder como parâmetro
        success: function (response) {
            $("#dataShopCart").html(response);
        },
        error: function () {
            alert("Erro ao carregar os dados do PHP.");
        },
    });
}
