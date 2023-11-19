$(document).ready(function () {
    // Defina a função para a solicitação AJAX
    function fetchProducts(pagina) {
        $.ajax({
            url: "api/Products.php?pagina=" + pagina, // Correção aqui
            method: "GET",
            success: function (response) {
                $("#dataShop").html(response);
            },
            error: function () {
                alert("Erro ao carregar os dados do PHP.");
            }
        });
    }

    // Adiciona um ouvinte de eventos aos links de paginação
    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var pagina = $(this).attr("href").split("=")[1];
        fetchProducts(pagina);
    });
});
