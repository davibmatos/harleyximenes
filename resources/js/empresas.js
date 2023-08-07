$(document).ready(function() {
    $('.select2').select2({
        ajax: {
            url: '/api/empresas', // URL da sua API
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // valor que o usuário digitou
                    page: params.page
                };
            },
            processResults: function (data, params) {
                return {
                    results: data.items,
                };
            },
            cache: true
        },
        placeholder: 'Digite o CNPJ da empresa',
        minimumInputLength: 1,
    });
});
