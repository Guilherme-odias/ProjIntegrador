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
    
if (senha.length < 8) {
        alert("A senha deve ter no mínimo 8 caracteres.");
        return false;
    }

    if (!/[A-Z]/.test(senha)) {
        alert("A senha deve conter pelo menos uma letra MAIÚSCULA.");
        return false;
    }

    if (!/[a-z]/.test(senha)) {
        alert("A senha deve conter pelo menos uma letra minúscula.");
        return false;
    }

    if (!/[0-9]/.test(senha)) {
        alert("A senha deve conter pelo menos um número.");
        return false;
    }

    if (!/[\W]/.test(senha)) {
        alert("A senha deve conter pelo menos um caractere especial.");
        return false;
    }

    if (senha !== confirmar) {
        alert("As senhas não coincidem!");
        return false;
    }

    return true;
}


function voltarPagina(){
    window.location.href = "../index/index.php";
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