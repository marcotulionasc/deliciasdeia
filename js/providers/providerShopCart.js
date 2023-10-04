function productClicked(idProduct) {
    $.ajax({
        url: "api/processShopCart.php",
        method: "POST", // Altere o método para "POST"
        data: { idProduct: idProduct },
        success: function (response) {
            $("#dataShopCart").html(response);
        },
        error: function () {
            alert("Erro ao carregar os dados do PHP.");
        },
    });
}
