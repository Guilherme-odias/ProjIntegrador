// Função para exibir/esconder o campo de digitar usuário
function toggleInputs() {
    const modo = document.querySelector('input[name="modo"]:checked').value;
    const userInput = document.getElementById('user_input');

    if (modo === 'desejos' || modo === 'biblioteca') {
        userInput.style.display = 'inline-block';
        userInput.required = true;
    } else {
        userInput.style.display = 'none';
        userInput.required = false;
    }
}

// Animação da alavanca que envia o formulário
function puxarAlavanca() {
    const haste = document.getElementById('haste-alavanca');
    haste.classList.add('haste-puxada');

    setTimeout(() => {
        haste.classList.remove('haste-puxada');

        // Aguarda a alavanca subir novamente para enviar os dados
        setTimeout(() => {
            document.getElementById('form-sorteio').submit();
        }, 300);
    }, 300); // Tempo para a mola descer
}