document.getElementById('btn_buscar_cliente').addEventListener('click', async function (event) {
    event.preventDefault(); // Previne a ação padrão do botão

    const cpf = document.getElementById('busca_cliente').value;

    // Obtendo o token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(`/harleyadvogados/public/clientes/search?cpf=${cpf}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Tratando a resposta
    if (response.ok) {
        const data = await response.json();
        if (data) {
            document.getElementById('nome_autor').value = data.nome;

            document.getElementById('clienteIdHidden').value = data.id;
        }

    } else {
        console.error("Erro ao buscar cliente", await response.text());
    }
});

document.getElementById('btn_buscar_empresa').addEventListener('click', async function (event) {
    event.preventDefault();

    const cnpj = document.getElementById('busca_empresa').value;

    // Obtendo o token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(`/harleyadvogados/public/empresas/search?cnpj=${cnpj}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Tratando a resposta
    if (response.ok) {
        const data = await response.json();
        if (data) {
            document.getElementById('nome_re').value = data.nome;
            
            document.getElementById('empresaIdHidden').value = data.id;
        }
    } else {
        console.error("Erro ao buscar empresa", await response.text());
    }
});



