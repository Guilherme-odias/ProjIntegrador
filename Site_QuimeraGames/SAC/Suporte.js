document.addEventListener("DOMContentLoaded", function () {

    console.log("JS carregado!");

    // ==========================
    // MÁSCARA DO CPF
    // ==========================
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

    // ==========================
    // ENVIO DO FORMULÁRIO
    // ==========================
    const formSuporte = document.getElementById('formSuporte');

    if (formSuporte) {
        formSuporte.addEventListener('submit', function (event) {
            event.preventDefault();

            console.log("Botão clicado!");

            const nome = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const cpf = document.getElementById('cpf').value;
            const reclamacao = document.getElementById('reclamacao').value;

            // Validação simples
            if (!nome || !email || !cpf || !reclamacao) {
                alert("Preencha todos os campos!");
                return;
            }

            const protocolo = "QG-" + Math.floor(Math.random() * 1000000);

            const dados = new FormData();
            dados.append('nome', nome);
            dados.append('email', email);
            dados.append('cpf', cpf);
            dados.append('reclamacao', reclamacao);
            dados.append('protocolo', protocolo);

            // ==========================
            // ENVIO PARA O PHP
            // ==========================
            fetch('enviar.php', {
                method: 'POST',
                body: dados
            })
            .then(res => res.text())
            .then(texto => {
                console.log("Resposta do PHP:", texto);

                if (texto.includes("sucesso")) {
                    alert("Enviado com sucesso! Seu protocolo é: " + protocolo);

                    // ✅ LIMPA O FORMULÁRIO
                    formSuporte.reset();

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