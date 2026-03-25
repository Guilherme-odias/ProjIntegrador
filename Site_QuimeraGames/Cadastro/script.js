// Senha original
let senha = document.getElementById("senha");

// Senha confirmada
let confirma = document.getElementById("confirme");

let check = document.getElementById("verifica");


function mostrarSenha() {

    if (senha.type === "password") {
        senha.type = "text";
        confirma.type = "text";
    } else {
        senha.type = "password";
        confirma.type = "password";
    }
}

function validarSenha() {
    let senha = document.getElementById("senha").value;
    let confirmar = document.getElementById("confirme").value;

    if (senha.length < 6) {
        alert("A senha deve ter pelo menos 6 caracteres!");
        return false;
    }

    if (senha !== confirmar) {
        alert("Senhas não coincidem!");
        return false;
    }

    return true;
}

function voltarPagina(){
    window.location.href = "../Index/index.php";
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