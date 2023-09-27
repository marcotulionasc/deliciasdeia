function categoryClicked(categoryName) {
    $.ajax({
        url: "Index.php",
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
