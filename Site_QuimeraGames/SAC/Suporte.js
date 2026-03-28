// Selecionamos o botão de continuar
const btnEnviar = document.getElementById('bntContinuar');

// ==========================================
// 1. MÁSCARA DO CPF
// ==========================================
const inputCpf = document.getElementById('cpf');

inputCpf.addEventListener('input', function(event) {
    let valor = event.target.value;
    
    // Tira tudo que não for número
    valor = valor.replace(/\D/g, '');
    
    // Coloca os pontos e o traço
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
    valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    
    // Atualiza o valor no campo
    event.target.value = valor;
});

// ==========================================
// 2. ENVIO DOS DADOS E LIMPEZA DA TELA
// ==========================================
const btnEnviar = document.getElementById('bntContinuar');

btnEnviar.addEventListener('click', function(event) {
    event.preventDefault(); 

    const nome = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const cpf = document.getElementById('cpf').value;
    const reclamacao = document.getElementById('reclamacao').value;

    if (nome === '' || email === '' || cpf === '' || reclamacao === '') {
        alert("Preencha todos os campos!");
        return; 
    }

    const protocolo = "PRT-" + Math.floor(Math.random() * 1000000);

    const dados = new FormData();
    dados.append('nome', nome);
    dados.append('email', email);
    dados.append('cpf', cpf);
    dados.append('reclamacao', reclamacao);
    dados.append('protocolo', protocolo);

    fetch('enviar.php', {
        method: 'POST',
        body: dados
    })
    .then(resposta => resposta.text())
    .then(texto => {
        if (texto.trim() === "sucesso") {
            alert("Enviado com sucesso! Seu protocolo é: " + protocolo);
            
            // Aqui os campos são apagados automaticamente:
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('cpf').value = '';
            document.getElementById('reclamacao').value = '';
        } else {
            alert("Erro ao enviar o e-mail.");
        }
    });
});

btnEnviar.addEventListener('click', function(event) {
    event.preventDefault(); // Evita que a página recarregue ao clicar

    // 1. Pegamos os valores que o usuário digitou
    const nome = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const cpf = document.getElementById('cpf').value;
    const reclamacao = document.getElementById('reclamacao').value;

    // 2. Verificamos se está tudo preenchido
    if (nome === '' || email === '' || cpf === '' || reclamacao === '') {
        alert("Preencha todos os campos!");
        return; // O código para por aqui se tiver erro
    }

    // 3. Criamos um protocolo simples e profissional
    const protocolo = "PRT-" + Math.floor(Math.random() * 1000000);

    // 4. Preparamos os dados para a "viagem" até o PHP
    const dados = new FormData();
    dados.append('nome', nome);
    dados.append('email', email);
    dados.append('cpf', cpf);
    dados.append('reclamacao', reclamacao);
    dados.append('protocolo', protocolo);

    

    // 5. Chamamos o arquivo PHP usando o comando 'fetch'
    fetch('enviar.php', {
        method: 'POST',
        body: dados
    })
    .then(resposta => resposta.text()) // Lemos o que o PHP respondeu
    .then(texto => {
        // Se a resposta do PHP for "sucesso", mostramos o alerta
        if (texto.trim() === "sucesso") {
            alert("Enviado com sucesso! Seu protocolo é: " + protocolo);
            
            // Limpa os campos da tela
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('cpf').value = '';
            document.getElementById('reclamacao').value = '';
        } else {
            alert("Erro ao enviar o e-mail.");
        }
    });
});