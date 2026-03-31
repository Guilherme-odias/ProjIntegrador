document.addEventListener('DOMContentLoaded', () => {

    // =======================================================
    // 1. LÓGICA DO CABEÇALHO (Igual ao da página inicial)
    // =======================================================
    const btnExplorar = document.getElementById('btn-explorar');
    const btnCategorias = document.getElementById('btn-categorias');
    const painelExplorar = document.getElementById('painel-explorar');
    const painelCategorias = document.getElementById('painel-categorias');
    const overlay = document.getElementById('overlay-escuro');

    function atualizarOverlay() {
        if ((painelExplorar && painelExplorar.classList.contains('show')) || 
            (painelCategorias && painelCategorias.classList.contains('show'))) {
            if(overlay) overlay.classList.add('ativo');
        } else {
            if(overlay) overlay.classList.remove('ativo');
        }
    }

    function togglePainel(painelAtual, painelOutro) {
        if (painelOutro && painelOutro.classList.contains('show')) {
            painelOutro.classList.remove('show');
        }
        if(painelAtual) painelAtual.classList.toggle('show');
        atualizarOverlay();
    }

    if (btnExplorar && painelExplorar) {
        btnExplorar.addEventListener('click', (e) => {
            e.stopPropagation();
            togglePainel(painelExplorar, painelCategorias);
        });
    }

    if (btnCategorias && painelCategorias) {
        btnCategorias.addEventListener('click', (e) => {
            e.stopPropagation();
            togglePainel(painelCategorias, painelExplorar);
        });
    }

    document.addEventListener('click', (e) => {
        let clicouFora = false;
        if (painelExplorar && !painelExplorar.contains(e.target) && e.target !== btnExplorar) {
            painelExplorar.classList.remove('show');
            clicouFora = true;
        }
        if (painelCategorias && !painelCategorias.contains(e.target) && e.target !== btnCategorias) {
            painelCategorias.classList.remove('show');
            clicouFora = true;
        }
        if (clicouFora) atualizarOverlay();
    });


    // =======================================================
    // 2. LÓGICA DAS MINIATURAS (Trocar o vídeo pela imagem)
    // =======================================================
    const mainMediaContainer = document.querySelector('.main-media');
    const thumbnails = document.querySelectorAll('.media-thumbnails img');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Quando clica numa miniatura, substitui o iframe/imagem principal pela imagem clicada
            if(mainMediaContainer) {
                mainMediaContainer.innerHTML = `<img src="${this.src}" style="width:100%; height:100%; object-fit:cover;">`;
            }
        });
    });


    // =======================================================
    // 3. LÓGICA DAS ESTRELAS FELIZES (Sistema de Avaliação)
    // =======================================================
    const stars = document.querySelectorAll('.happy-stars .star-icon');
    const notaNumero = document.querySelector('.nota-numero');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            // Atualiza o número da nota com base na estrela clicada (ex: clica na 4ª estrela = 4.0)
            if(notaNumero) {
                notaNumero.innerText = (index + 1).toFixed(1);
            }

            // Pinta as estrelas: deixa amarelas até a que foi clicada, e cinzas as seguintes
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('active');
                    s.classList.remove('inactive');
                } else {
                    s.classList.add('inactive');
                    s.classList.remove('active');
                }
            });
        });
    });

});