$(document).ready(function(){
    $('#empresa').change(function(){
        var cnpj = $(this).val();
        $.ajax({
            url: '/getEmpresa',
            type: 'get',
            data: {cnpj: cnpj},
            success: function(response){
                // Preenche o campo do nome da empresa com a resposta
                $('#nomeEmpresa').val(response.nome);
            },
            error: function(response) {
                // Limpa o campo do nome da empresa se houver um erro
                $('#nomeEmpresa').val('');
                alert('Empresa não encontrada');
            }
        });
    });

    var count = 1;
    $('.add-cnpj').click(function() {
        count++;
        var newField = $(`
            <div id="cnpjField${count}">
                <div class="form-group">
                    <label for="empresa${count}">CNPJ da Empresa ${count}</label>
                    <input type="text" class="form-control cnpj-field" id="empresa${count}" name="empresa${count}">
                </div>
                <div class="form-group">
                    <label for="nomeEmpresa${count}">Nome da Empresa ${count}</label>
                    <input type="text" class="form-control" id="nomeEmpresa${count}" name="nomeEmpresa${count}" readonly>
                </div>
            </div>
        `);
        newField.insertBefore($(this));
    });

    // Use event delegation para manipular eventos de elementos que ainda não foram criados
    $('form').on('change', '.cnpj-field', function() {
        var idNum = this.id.replace(/\D/g,'');
        var cnpj = $(this).val();
        $.ajax({
            url: '/getEmpresa',
            type: 'get',
            data: {cnpj: cnpj},
            success: function(response){
                $('#nomeEmpresa' + idNum).val(response.nome);
            },
            error: function(response) {
                $('#nomeEmpresa' + idNum).val('');
                alert('Empresa não encontrada');
            }
        });
    });
});
