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

function validarForm() {
    let senha = document.getElementById("senha").value;
    let confirmar = document.getElementById("confirme").value;

    if(senha !== confirmar){
        alert("Senhas não coincidem!");
        return false;
    }

    return true;
}

