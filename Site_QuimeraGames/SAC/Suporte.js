document.addEventListener("DOMContentLoaded", function () {

    // ========================
    // MÁSCARA DO CPF
    // ========================
    const inputCpf = document.getElementById('cpf');
    if (inputCpf) {
        inputCpf.addEventListener('input', function (event) {
            let valor = event.target.value.replace(/\D/g, '').slice(0, 11);
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            event.target.value = valor;
        });
    }

    // ========================
    // FUNÇÕES DE VALIDAÇÃO
    // ========================
    function validarNome(nome) {
        return nome.trim().length >= 3 && /^[a-zA-ZÀ-ÿ\s]+$/.test(nome.trim());
    }

    function validarEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
    }

    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]/g, '');
        if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

        let soma = 0;
        for (let i = 0; i < 9; i++) soma += parseInt(cpf[i]) * (10 - i);
        let resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf[9])) return false;

        soma = 0;
        for (let i = 0; i < 10; i++) soma += parseInt(cpf[i]) * (11 - i);
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        return resto === parseInt(cpf[10]);
    }

    // ========================
    // FEEDBACK VISUAL
    // ========================
    function setStatus(id, valido) {
        document.getElementById(id).style.outline = valido
            ? '2px solid #4caf50'
            : '2px solid #e63b2e';
    }

    function mostrarErros(erros) {
        const bloco = document.getElementById('blocoErro');
        const lista = document.getElementById('listaErros');
        lista.innerHTML = '';
        erros.forEach(function (e) {
            const li = document.createElement('li');
            li.textContent = e;
            lista.appendChild(li);
        });
        bloco.style.display = 'block';
    }

    function limparErros() {
        document.getElementById('blocoErro').style.display = 'none';
        document.getElementById('listaErros').innerHTML = '';
    }

    // ========================
    // ENVIO DO FORMULÁRIO
    // ========================
    const formSuporte = document.getElementById('formSuporte');

    if (formSuporte) {
        formSuporte.addEventListener('submit', function (event) {
            event.preventDefault();

            const nome      = document.getElementById('name').value;
            const email     = document.getElementById('email').value;
            const cpf       = document.getElementById('cpf').value;
            const reclamacao = document.getElementById('reclamacao').value;

            const erros = [];

            if (!validarNome(nome))            { erros.push('Nome inválido (mín. 3 letras, sem números).'); setStatus('name', false); }
            if (!validarEmail(email))           { erros.push('E-mail inválido.');                           setStatus('email', false); }
            if (!validarCPF(cpf))               { erros.push('CPF inválido.');                              setStatus('cpf', false); }
            if (reclamacao.trim().length < 20)  { erros.push('Mensagem muito curta (mín. 20 caracteres).'); setStatus('reclamacao', false); }

            if (erros.length > 0) {
                mostrarErros(erros);
                return;
            }

            limparErros();

            const dados = new FormData();
            dados.append('nome', nome);
            dados.append('email', email);
            dados.append('cpf', cpf);
            dados.append('reclamacao', reclamacao);

            fetch('enviar.php', {
                method: 'POST',
                body: dados
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.sucesso) {
                    const modal        = document.getElementById('modalSucesso');
                    const spanProtocolo = document.getElementById('numeroProtocolo');
                    const btnFechar    = document.getElementById('btnFecharModal');

                    spanProtocolo.textContent = data.protocolo;
                    modal.style.display = 'flex';

                    btnFechar.onclick = function () {
                        modal.style.display = 'none';
                        formSuporte.reset();
                        ['name', 'email', 'cpf', 'reclamacao'].forEach(function (id) {
                            document.getElementById(id).style.outline = '';
                        });
                    };
                } else {
                    mostrarErros([data.erro || 'Erro ao enviar. Tente novamente.']);
                }
            })
            .catch(function () {
                mostrarErros(['Erro de conexão com o servidor.']);
            });
        });
    }

});