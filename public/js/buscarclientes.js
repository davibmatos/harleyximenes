$('#processo_id').change(function () {
    var numero_processo = $(this).val();
    
    $.ajax({
        url: getClienteUrl,
        type: 'get',
        data: {
            numero_processo: numero_processo
        },
        success: function (response) {
            $('#cliente').val(response.nome);

            // Segunda requisição:
            $.ajax({
                url: '/harleyadvogados/public/get-audiencia-details',
                type: 'get',
                data: {
                    numero_processo: numero_processo
                },
                success: function (response) {
                    $('#data_aud').val(response.data_aud);
                    $('#hora_aud').val(response.hora_aud);
                },
                error: function (response) {
                    $('#data_aud').val('');
                    $('#hora_aud').val('');
                    alert('Detalhes da audiência não encontrados para o processo inserido.');
                }
            });

        },
        error: function (response) {
            $('#cliente').val('');
            alert('Processo não encontrado');
        }
    });
});
