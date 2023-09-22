$(document).ready(function() {
    $("#advogado").change(function() {
        var selectedAdvogados = [];
        $("#advogado option:selected").each(function() {
            selectedAdvogados.push($(this).text());
        });
        $(".selected-advogados").val(selectedAdvogados.join(", "));
    });
});
