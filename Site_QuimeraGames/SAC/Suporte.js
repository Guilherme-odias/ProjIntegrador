// ==========================================
// 1. MÁSCARA DO CPF
// ==========================================
const inputCpf = document.getElementById('cpf');

inputCpf.addEventListener('input', function(event) {
    let valor = event.target.value;
    
    // Tira tudo que não for número
    valor = valor.replace(/\D/g, '');
    
    // Limita a 11 números
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }
    
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
    event.preventDefault(); // Evita que a página recarregue ao clicar

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
            
            // Aqui os campos são apagados (limpos)
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('cpf').value = '';
            document.getElementById('reclamacao').value = '';
        } else {
            alert("Erro ao enviar o e-mail.");
        }
    })
    .catch(erro => {
        console.error("Erro na requisição:", erro);
        alert("Erro na comunicação com o servidor.");
    });
});