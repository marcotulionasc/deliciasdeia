$(document).ready(function() {
     
    function fetchProducts() {
        $.ajax({
            url: "api/Products.php",
            method: "GET",
            data: {pagina : 2},
            success: function(response) {
                $("#dataShop").html(response);
            },
            error: function() {
                alert("Erro ao carregar os dados do PHP.");
            }
        });
    }

    fetchProducts();
});