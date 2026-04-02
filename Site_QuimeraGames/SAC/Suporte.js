document.addEventListener("DOMContentLoaded", function () {

    console.log("JS carregado!");

    const inputCpf = document.getElementById('cpf');

    if (inputCpf) {
        inputCpf.addEventListener('input', function (event) {
            let valor = event.target.value;

            valor = valor.replace(/\D/g, '');

            if (valor.length > 11) {
                valor = valor.slice(0, 11);
            }

            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            event.target.value = valor;
        });
    }

    const formSuporte = document.getElementById('formSuporte');

    if (formSuporte) {
        formSuporte.addEventListener('submit', function (event) {
            event.preventDefault();

            console.log("Botão clicado!");

            const nome = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const cpf = document.getElementById('cpf').value;
            const reclamacao = document.getElementById('reclamacao').value;

            if (!nome || !email || !cpf || !reclamacao) {
                alert("Preencha todos os campos!");
                return;
            }

            const protocolo = Math.floor(Math.random() * 1000000);

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
            .then(res => res.text())
            .then(texto => {
                console.log("Resposta do PHP:", texto);

                if (texto.includes("sucesso")) {
                    
                    // Pega os elementos do modal no HTML
                    const modal = document.getElementById('modalSucesso');
                    const spanProtocolo = document.getElementById('numeroProtocolo');
                    const btnFechar = document.getElementById('btnFecharModal');

                    // Coloca o número do protocolo na tela
                    spanProtocolo.textContent = protocolo;

                    // Mostra o modal (muda de none para flex)
                    modal.style.display = 'flex';

                    // O que acontece quando clica no OK do Modal
                    btnFechar.onclick = function() {
                        modal.style.display = 'none'; 
                        formSuporte.reset(); 
                    };

                } else {
                    alert("Erro ao enviar: " + texto);
                }
            })
            .catch(erro => {
                console.error("Erro na requisição:", erro);
                alert("Erro de conexão com o servidor.");
            });
        });
    }

});