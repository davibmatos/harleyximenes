$(document).ready(function(){
    $('#processo_id').change(function(){
        var processo_id = $(this).val();
        $.ajax({
            url: getClienteUrl,
            type: 'get',
            data: {processo_id: processo_id},
            success: function(response){
                // Preenche o campo do nome do cliente com a resposta
                $('#cliente').val(response.nome);
            },
            error: function(response) {
                // Limpa o campo do nome do cliente se houver um erro
                $('#cliente').val('');
                alert('Processo não encontrado');
            }
        });
    });
});
