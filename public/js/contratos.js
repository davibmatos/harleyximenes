window.inquilinosPorCpfUrl = window.inquilinosPorCpfUrl || '/inquilinos/por-cpf';

document.getElementById('cpf').addEventListener('change', async function () {
    const cpf = this.value;

    try {
        const response = await fetch(window.inquilinosPorCpfUrl + '/' + cpf);
        if (response.ok) {
            const inquilinos = await response.json();

            if (inquilinos.length === 1) {
                const inquilino = inquilinos[0];
                document.getElementById('nome').value = inquilino.nome;
                document.getElementById('telefone').value = inquilino.telefone;
                document.getElementById('inquilino_id').value = inquilino.id;
            } else if (inquilinos.length > 1) {
                document.getElementById('nome').value = '';
                document.getElementById('telefone').value = '';
                document.getElementById('inquilino_id').value = '';
                alert('Há vários inquilinos com o mesmo CPF. Entre em contato com o administrador.');
            } else {
                document.getElementById('nome').value = '';
                document.getElementById('telefone').value = '';
                document.getElementById('inquilino_id').value = '';
                alert('Inquilino não encontrado');
            }
        } else {
            throw new Error('Erro ao buscar inquilino');
        }
    } catch (error) {
        console.error(error);
    }
});

document.getElementById('edificio').addEventListener('change', async function () {
    const edificio = this.value;
    const apartamentosPorEdificioUrl = `/predial/public/imoveis/${encodeURIComponent(edificio)}/apartamentos`;

    try {
        const response = await fetch(apartamentosPorEdificioUrl);
        if (response.ok) {
            const apartamentos = await response.json();
            const apartamentoSelect = document.getElementById('apartamento');
            apartamentoSelect.innerHTML = '<option value="" selected disabled>Selecione um apartamento</option>';
            apartamentos.forEach(apartamento => {
                const option = document.createElement('option');
                option.value = apartamento.id;
                option.text = apartamento.numero;
                option.dataset.valor = apartamento.valor;
                apartamentoSelect.add(option);
            });
            apartamentoSelect.disabled = false;
        } else {
            throw new Error('Erro ao buscar apartamentos');
        }
    } catch (error) {
        console.error(error);
    }
});

document.getElementById('apartamento').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const valor = selectedOption.dataset.valor;
    document.getElementById('valor').value = valor;
});
