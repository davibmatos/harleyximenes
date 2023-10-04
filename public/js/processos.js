document.getElementById('btn_buscar_cliente').addEventListener('click', async function (event) {
    event.preventDefault(); 

    const cpf = document.getElementById('busca_cliente').value;
    const nomeAutorField = document.getElementById('nome_autor');

    // Obtendo o token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(`/clientes/search?cpf=${cpf}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Tratando a resposta
    if (response.ok) {
        const data = await response.json();
        if (data && data.nome) {
            nomeAutorField.value = data.nome;
            document.getElementById('clienteIdHidden').value = data.id;
        } else {
            nomeAutorField.value = "Cliente não encontrado";
        }
    } else {
        console.error("Erro ao buscar cliente", await response.text());
    }
});

document.getElementById('btn_buscar_empresa').addEventListener('click', async function (event) {
    event.preventDefault();

    const cnpj = document.getElementById('busca_empresa').value;
    const nomeReField = document.getElementById('nome_re');

    // Obtendo o token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(`/empresas/search?cnpj=${cnpj}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Tratando a resposta
    if (response.ok) {
        const data = await response.json();
        if (data && data.nome) {
            nomeReField.value = data.nome;
            document.getElementById('empresaIdHidden').value = data.id;
        } else {
            nomeReField.value = "Parte adversa não encontrada";
        }
    } else {
        console.error("Erro ao buscar empresa", await response.text());
    }
});
