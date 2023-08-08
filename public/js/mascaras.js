function aplicarMascaras() {
    $('#telefone').mask('(00) 00000-0000');
    $('#telefone2').mask('(00) 00000-0000');
    $('#cpf').mask('000.000.000-00');
    $('#cep').mask('00000-000');
    $('#salario').maskMoney({
        prefix: 'R$ ',
        thousands: '.',
        decimal: ',',
        allowZero: true,
        allowNegative: false
    });
    var masks = ['000.000.000-009', '00.000.000/0000-00'];
    var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? masks[0] : masks[1];
    };

    $('#campoCpfCnpj, #busca_cliente, #busca_empresa').mask(maskBehavior, {
        onKeyPress: function (val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
        }
    });

    var mask16 = '000000.0000.00.000/0';
    var mask20 = '0000000-00.0000.0.00-0000';

    $('#numero').on('blur', function () {
        var val = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos

        $(this).unmask(); // Desmascarar

        if (val.length <= 16) {
            $(this).val(val).mask(mask16);
        } else {
            $(this).val(val).mask(mask20);
        }
    }).on('focus', function () {
        $(this).unmask(); // Desmascarar quando o campo é selecionado
    });
}
