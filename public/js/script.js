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

document.addEventListener('DOMContentLoaded', function() {
    const formServico = document.getElementById('form-servico');
    if (!formServico) return;

    const inputImagem = document.getElementById('imagem');
    const uploadArea = document.getElementById('upload-area');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const uploadPreview = document.getElementById('upload-preview');
    const imgPreview = document.getElementById('img-preview');

    if (uploadArea && inputImagem) {
        const btnUpload = document.querySelector('.btn-upload-custom');
        if (btnUpload) {
            btnUpload.addEventListener('click', (e) => {
                e.stopPropagation();
                inputImagem.click();
            });
        }

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                inputImagem.files = files;
                previewImage(files[0]);
            }
        });

        inputImagem.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                previewImage(file);
            }
        });

        function previewImage(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (imgPreview && uploadPlaceholder && uploadPreview) {
                    imgPreview.src = e.target.result;
                    uploadPlaceholder.classList.add('d-none');
                    uploadPreview.classList.remove('d-none');
                }
            };
            reader.readAsDataURL(file);
        }

        const btnChangeImage = document.querySelector('.btn-change-custom');
        if (btnChangeImage) {
            btnChangeImage.addEventListener('click', (e) => {
                e.stopPropagation();
                inputImagem.click();
            });
        }
    }

    const nomeInput = document.getElementById('nome');
    const nomeCounter = document.getElementById('nome-count');
    const descricaoInput = document.getElementById('descricao');
    const descricaoCounter = document.getElementById('descricao-count');

    if (nomeInput && nomeCounter) {
        nomeInput.addEventListener('input', () => {
            nomeCounter.textContent = nomeInput.value.length;
            updateCharacterCountColor(nomeInput, nomeCounter, 40);
        });
    }

    if (descricaoInput && descricaoCounter) {
        descricaoInput.addEventListener('input', () => {
            descricaoCounter.textContent = descricaoInput.value.length;
            updateCharacterCountColor(descricaoInput, descricaoCounter, 750);
        });
    }

    function updateCharacterCountColor(input, counter, max) {
        const length = input.value.length;
        const percentage = (length / max) * 100;
        
        if (percentage >= 90) {
            counter.style.color = '#dc3545';
        } else if (percentage >= 70) {
            counter.style.color = '#fd7e14';
        } else {
            counter.style.color = '#6c757d';
        }
    }

    if (nomeInput && nomeCounter) {
        nomeCounter.textContent = nomeInput.value.length;
        updateCharacterCountColor(nomeInput, nomeCounter, 40);
    }
    
    if (descricaoInput && descricaoCounter) {
        descricaoCounter.textContent = descricaoInput.value.length;
        updateCharacterCountColor(descricaoInput, descricaoCounter, 750);
    }

    // Máscara de dinheiro para o campo preço
    const precoInput = document.getElementById('preco');
    if (precoInput) {
        precoInput.addEventListener('input', function(e) {
            let value = e.target.value;
            
            // Remove tudo que não é dígito
            value = value.replace(/\D/g, '');
            
            // Converte para centavos
            value = (parseInt(value) / 100).toFixed(2);
            
            // Adiciona formatação brasileira
            value = value.replace('.', ',');
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            
            e.target.value = value;
        });

        // Formatar valor inicial se existir
        if (precoInput.value) {
            let initialValue = precoInput.value.replace(/\D/g, '');
            initialValue = (parseInt(initialValue) / 100).toFixed(2);
            initialValue = initialValue.replace('.', ',');
            initialValue = initialValue.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            precoInput.value = initialValue;
        }

        // Converter para formato correto antes do submit
        formServico.addEventListener('submit', function() {
            let submitValue = precoInput.value;
            // Remove pontos e substitui vírgula por ponto
            submitValue = submitValue.replace(/\./g, '').replace(',', '.');
            precoInput.value = submitValue;
        });
    }

    formServico.addEventListener('submit', function(e) {
        const inputs = formServico.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            const firstError = formServico.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
});
