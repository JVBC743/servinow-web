document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const senhaInput = document.getElementById('senha');
    const repetirSenhaInput = document.getElementById('repetir_senha');
    const cpfInput = document.getElementById('cpf');
    const cepInput = document.getElementById('cep');
    const celularInput = document.getElementById('celular');

    if (form) {
        form.addEventListener('submit', function (event) {
            // Validação de senha
            if (senhaInput.value !== repetirSenhaInput.value) {
                alert('As senhas não coincidem!');
                event.preventDefault(); // Impede o envio do formulário
                repetirSenhaInput.focus();
                return;
            }

            // Adicione outras validações aqui se desejar
            // Ex: Formato do CPF, CEP, etc.
            // No entanto, lembre-se que a validação robusta deve ser feita no backend (Laravel)
        });
    }

    // Máscaras simples (exemplo básico, para máscaras complexas use bibliotecas)
    if (cpfInput) {
        cpfInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value.slice(0, 14); // Limita ao tamanho do CPF formatado
        });
    }

    if (cepInput) {
        cepInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/^(\d{5})(\d)/, '$1-$2');
            e.target.value = value.slice(0, 9); // Limita ao tamanho do CEP formatado
        });
    }

    if (celularInput) {
        celularInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');

            if (value.length > 2) {
                value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
            }

            value = value.replace(/\D/g, '');

            if (value.length > 2) {
                const ddd = value.substring(0, 2);
                const num = value.substring(2);

                if (num.length <= 4) {
                    value = `(${ddd}) ${num}`;
                } else if (num.length <= 8) {
                    value = `(${ddd}) ${num.substring(0, 4)}-${num.substring(4)}`;
                } else {
                    value = `(${ddd}) ${num.substring(0, 5)}-${num.substring(5, 9)}`;
                }
            }

            e.target.value = value;
        });
    }


    // Funcionalidade para buscar CEP com BrasilAPI
    if (cepInput) {
        cepInput.addEventListener('blur', async function () {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length === 8) {
                try {
                    const response = await fetch(`https://brasilapi.com.br/api/cep/v1/${cep}`);
                    if (!response.ok) throw new Error('CEP não encontrado');
                    const data = await response.json();

                    // BrasilAPI retorna: cep, state, city, neighborhood, street
                    document.getElementById('logradouro').value = data.street || '';
                    document.getElementById('bairro').value = data.neighborhood || '';
                    document.getElementById('cidade').value = data.city || '';
                    document.getElementById('uf').value = data.state || '';
                    document.getElementById('numero').focus();
                } catch (error) {
                    console.error('Erro ao buscar CEP:', error);
                    alert('Erro ao buscar CEP. Verifique se o CEP é válido.');
                }
            }
        });
    }

});

document.addEventListener('DOMContentLoaded', function () {
    const lazyImages = document.querySelectorAll('img.lazy');

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '2px'
    });

    lazyImages.forEach(image => observer.observe(image));
});
