function categoryClicked(categoryName) {
    $.ajax({
        url: "php/indexProducts/Index.php",
        method: "GET",
        data: { category: categoryName },
        success: function(response) {
            $("#dataIndex").html(response);
        },
        error: function() {
            alert("Erro ao carregar os dados do PHP.");
        }
    });
}
