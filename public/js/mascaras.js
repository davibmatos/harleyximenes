function aplicarMascaras() {
    $('#telefone').mask('(00) 00000-0000');
    $('#telefone2').mask('(00) 00000-0000');
    $('#cpf').mask('000.000.000-00');
    $('#cep').mask('00000-000');
    $('#cnpj').mask('00.000.000/0000-00');
    $('#valor').maskMoney({ prefix: 'R$ ', thousands: '.', decimal: ',', allowZero: true, allowNegative: false });
}