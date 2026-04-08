document.addEventListener('DOMContentLoaded', () => {
    // Seleciona todos os radio buttons de método de pagamento
    const radios = document.querySelectorAll('input[name="metodo"]');
    
    // Mapeia os formulários dinâmicos pelos seus IDs
    const forms = {
        cartao: document.getElementById('dados-cartao'),
        pix: document.getElementById('dados-pix'),
        boleto: document.getElementById('dados-boleto')
    };

    radios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            // 1. Remove a classe 'ativo' de TODOS os formulários (esconde eles)
            Object.values(forms).forEach(form => form.classList.remove('ativo'));
            
            // 2. Pega o valor do radio button que o usuário acabou de clicar (ex: 'pix')
            const selecionado = e.target.value;
            
            // 3. Adiciona a classe 'ativo' apenas no formulário correspondente
            if (forms[selecionado]) {
                forms[selecionado].classList.add('ativo');
            }
        });
    });
});