function mostrarSenha() {

    const senha = document.getElementById("senha");
    const confirma = document.getElementById("confirme");

    if (senha.type == "password") {
        senha.type = "text";
        confirma.type = "text";
    } else {
        senha.type = "password";
        confirma.type = "password";
    }
}

function validarSenha() {
    const senha = document.getElementById("senha").value;
    const confirmar = document.getElementById("confirme").value;

    let erros = [];

    if (senha.length < 8) {
        erros.push("A senha deve ter no mínimo 8 caracteres.");
    }

    if (!/[A-Z]/.test(senha)) {
        erros.push("A senha precisa de uma letra maiúscula.");
    }

    if (!/[a-z]/.test(senha)) {
        erros.push("A senha precisa de uma letra minúscula.");
    }

    if (!/[0-9]/.test(senha)) {
        erros.push("A senha precisa de um número.");
    }

    if (!/[\W]/.test(senha)) {
        erros.push("A senha precisa de um caractere especial.");
    }

    if (senha !== confirmar) {
        erros.push("As senhas não coincidem.");
    }

    // Se tiver erro, mostra popup
    if (erros.length > 0) {

        const lista = document.getElementById("listaErros");
        lista.innerHTML = "";

        erros.forEach(function (erro) {
            const li = document.createElement("li");
            li.textContent = erro;
            lista.appendChild(li);
        });

        document.getElementById("popupErro").style.display = "flex";

        return false;
    }

    return true;
}

function fecharPopup() {
    document.getElementById("popupErro").style.display = "none";
}



function voltarPagina(){
    window.location.href = "../index/index.php";
}
const cpfInput = document.getElementById("cpf");

cpfInput.addEventListener("input", function () {

    let valor = cpfInput.value.replace(/\D/g, "");

    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }

    // máscara 000.000.000-00
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    cpfInput.value = valor;

    // 🔥 valida enquanto digita
    validarCPFVisual(valor);
});


// =========================
// FUNÇÃO DE VALIDAR CPF
// =========================
function validaCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');

    if (cpf.length !== 11) return false;
    if (/^(\d)\1+$/.test(cpf)) return false;

    let soma = 0;
    let resto;

    for (let i = 1; i <= 9; i++)
        soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;

    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    soma = 0;

    for (let i = 1; i <= 10; i++)
        soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;

    return resto === parseInt(cpf.substring(10, 11));
}


// =========================
// VALIDAÇÃO VISUAL
// =========================
function validarCPFVisual(cpf) {

    const input = document.getElementById("txtCPF");
    const cpfLimpo = cpf.replace(/\D/g, "");

    if (cpfLimpo.length < 11) {
        input.style.border = "2px solid orange";
        return;
    }

    if (validaCPF(cpfLimpo)) {
        input.style.border = "2px solid green";
    } else {
        input.style.border = "2px solid red";
    }
}
function validaCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');

    if (cpf.length !== 11) return false;

    if (/^(\d)\1+$/.test(cpf)) return false;

    let soma = 0;
    let resto;

    for (let i = 1; i <= 9; i++)
        soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;

    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    soma = 0;

    for (let i = 1; i <= 10; i++)
        soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;

    if (resto !== parseInt(cpf.substring(10, 11))) return false;

    return true;

}

function validarEmail() {
    let email = document.getElementById("email").value;
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regex.test(email)) {
        alert("Email inválido!");
        return false;
    }

    return true;
}

function validarForm() {
    let cpf = document.getElementById("cpf").value;

    if (!validarEmail()) return false;
    if (!validarSenha()) return false;

    if (!validaCPF(cpf)) {
        alert("CPF inválido!");
        return false;
    }

    return true;
}
function senhaFraca() {
        const senhaInput = document.getElementById("confirme");
        const forcaTexto = document.getElementById("forcaSenha");
 
        senhaInput.addEventListener("input", function () {
 
            const senha = senhaInput.value;
 
            let forca = 0;
 
            // critérios
            if (senha.length >= 8) forca++;
            if (/[A-Z]/.test(senha)) forca++;
            if (/[0-9]/.test(senha)) forca++;
            if (/[^A-Za-z0-9]/.test(senha)) forca++;
 
            // resultado
            if (senha.length === 0) {
                forcaTexto.innerText = "";
            }
            else if (forca <= 1) {
                forcaTexto.innerText = "Senha fraca";
                forcaTexto.style.color = "red";
            }
            else if (forca == 2 || forca == 3) {
                forcaTexto.innerText = "Senha média";
                forcaTexto.style.color = "orange";
            }
            else {
                forcaTexto.innerText = "Senha forte";
                forcaTexto.style.color = "limegreen";
            }
 
        });
        }