$(document).ready(function() {
    // Defina a função para a solicitação AJAX
    function fetchProducts(page) {
        $.ajax({
            url: "api/Products.php",
            method: "GET",
            data: { pagina: page }, // Adicione o parâmetro de página aqui
            success: function(response) {
                $("#dataShop").html(response);
            },
            error: function() {
                alert("Erro ao carregar os dados do PHP.");
            }
        });
    }

    // Chame a função para disparar a solicitação AJAX com a página inicial (1)
    fetchProducts(1);

    // Adicione um listener para os links de paginação
    $(document).on("click", ".shop__pagination a", function(e) {
        e.preventDefault();
        var page = $(this).text(); // Obtenha o número da página do link clicado
        fetchProducts(page);
    });
});
