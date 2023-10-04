function productClicked(idProduct) {
    $.ajax({
        url: "api/processShopCart.php",
        method: "GET",
        data: { idProduct: idProduct }, // Você precisa passar o ID do produto na solicitação GET
        success: function (response) {
            $("#dataShopCart").html(response);
        },
        error: function () {
            alert("Erro ao carregar os dados do PHP.");
        },
    });
}
