document.addEventListener('DOMContentLoaded', () => {

    // 1. Menu Sanfona
    const botoesFiltro = document.querySelectorAll('.btn-filtro-toggle');
    botoesFiltro.forEach(botao => {
        botao.addEventListener('click', () => {
            const conteudo = botao.nextElementSibling;
            const seta = botao.querySelector('.seta');
            conteudo.classList.toggle('ativo');
            seta.style.transform = conteudo.classList.contains('ativo') ? 'rotate(180deg)' : 'rotate(0deg)';
        });
    });

    // 2. Lógica de Filtragem
    const inputBusca = document.getElementById('input-filtro-nome');
    const checkboxes = document.querySelectorAll('.filtro-checkbox');
    const jogosCards = document.querySelectorAll('.jogo-card');

    function aplicarFiltros() {
        const termoDigitado = inputBusca ? inputBusca.value.toLowerCase().trim() : '';
        const chkGratis = document.getElementById('chk-gratis')?.checked;
        const chkAte50 = document.getElementById('chk-ate50')?.checked;
        const chkDesconto = document.getElementById('chk-desconto')?.checked;

        jogosCards.forEach(card => {
            const tituloJogo = card.getAttribute('data-titulo');
            const isGratis = card.getAttribute('data-gratis') === 'true';
            const isAte50 = card.getAttribute('data-ate50') === 'true';
            const hasDesconto = card.getAttribute('data-desconto') === 'true';

            let mostrar = true;

            // Filtro de Texto
            if (termoDigitado !== '' && !tituloJogo.includes(termoDigitado)) {
                mostrar = false;
            }

            // Filtro de Preço
            if (mostrar && (chkGratis || chkAte50 || chkDesconto)) {
                let atendeFiltroPreco = false;
                if (chkGratis && isGratis) atendeFiltroPreco = true;
                if (chkAte50 && isAte50) atendeFiltroPreco = true;
                if (chkDesconto && hasDesconto) atendeFiltroPreco = true;

                if (!atendeFiltroPreco) mostrar = false;
            }

            card.style.display = mostrar ? 'flex' : 'none';
        });
    }

    if (inputBusca) inputBusca.addEventListener('input', aplicarFiltros);
    checkboxes.forEach(chk => chk.addEventListener('change', aplicarFiltros));
});