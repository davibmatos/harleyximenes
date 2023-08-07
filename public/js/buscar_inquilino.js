document.getElementById('cpf').addEventListener('input', async function (e) {
    const cpf = e.target.value.replace(/\D/g, '');

    if (cpf.length === 11) {
        const url = `${window.inquilinosPorCpfUrl}/${cpf}`;
        const response = await fetch(url);
        const inquilino = await response.json();

        if (inquilino) {
            document.getElementById('nome').value = inquilino.nome;
            document.getElementById('telefone').value = inquilino.telefone;
        } else {
            document.getElementById('nome').value = '';
            document.getElementById('telefone').value = '';
        }
    }
});
