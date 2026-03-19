// Senha original
let senha = document.getElementById("senha");

// Senha confirmada
let confirma = document.getElementById("confirme");

let check = document.getElementById("verifica");


check.addEventListener('click', function() {

    if (senha.getAttribute('type') == 'password' ) {
        
        

        senha.setAttribute('type', 'text')
    }
    
    else {
        
        senha.setAttribute('type', 'password')
    }
});


