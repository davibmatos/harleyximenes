document.getElementById('comarca').addEventListener('change', async function (event) {
    const comarcaId = event.target.value;

    // Obtendo o token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(`/get-varas?comarca_id=${comarcaId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Tratando a resposta
    if (response.ok) {
        const data = await response.json();
        let varaDropdown = document.getElementById('vara');
        varaDropdown.innerHTML = ''; // limpar opções existentes

        data.forEach(vara => {
            let option = document.createElement('option');
            option.value = vara.id;
            option.textContent = vara.numero; // assumindo que 'nome' é a propriedade que você quer mostrar
            varaDropdown.appendChild(option);
        });
    } else {
        console.error("Erro ao buscar varas", await response.text());
    }

});
