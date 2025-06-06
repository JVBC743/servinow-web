document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const senhaInput = document.getElementById('senha');
    const repetirSenhaInput = document.getElementById('repetir_senha');
    const cpfInput = document.getElementById('cpf');
    const cepInput = document.getElementById('cep');
    const celularInput = document.getElementById('celular');

    if (form) {
        form.addEventListener('submit', function(event) {
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
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value.slice(0, 14); // Limita ao tamanho do CPF formatado
        });
    }

    if (cepInput) {
        cepInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/^(\d{5})(\d)/, '$1-$2');
            e.target.value = value.slice(0, 9); // Limita ao tamanho do CEP formatado
        });
    }

    if (celularInput) {
        celularInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = `(${value.substring(0,2)}) ${value.substring(2)}`;
            }
            if (value.length > 9 && value.length <= 13) { // (XX) XXXXX-XXXX (com 9 dígitos)
                 value = value.replace(/(\d{5})(\d)/, '$1-$2');
            } else if (value.length > 9) { // (XX) XXXXX-XXXX (com 8 dígitos)
                 value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value.slice(0, 15); // Limita (XX) XXXXX-XXXX
        });
    }

    // Funcionalidade para buscar CEP (exemplo usando ViaCEP)
    if (cepInput) {
        cepInput.addEventListener('blur', async function() { // 'blur' é quando o campo perde o foco
            const cep = this.value.replace(/\D/g, ''); // Remove não dígitos
            if (cep.length === 8) {
                try {
                    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                    if (!response.ok) throw new Error('CEP não encontrado');
                    const data = await response.json();

                    if (!data.erro) {
                        document.getElementById('logradouro').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('uf').value = data.uf || '';
                        document.getElementById('numero').focus(); // Move o foco para o número
                    } else {
                        alert('CEP não encontrado.');
                    }
                } catch (error) {
                    console.error('Erro ao buscar CEP:', error);
                    alert('Erro ao buscar CEP. Verifique o console para mais detalhes.');
                }
            }
        });
    }
});