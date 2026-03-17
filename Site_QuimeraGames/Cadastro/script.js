// Senha original
let senha = document.getElementById("senha");

// Senha confirmada
let confirma = document.getElementById("confirme");

let check = document.getElementById("verifica");


check.addEventListener('click', function() {

    if (senha.getAttribute('type') == 'password' ) {
        
        console.log("Acabou de ser marcado!");

        senha.setAttribute('type', 'text')
    }
    
    else {
        console.log("Acabou de ser desmarcado!");
        enha.setAttribute('type', 'password')
    }
});


