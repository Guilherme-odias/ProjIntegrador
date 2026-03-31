document.addEventListener('DOMContentLoaded', () => {

    // =======================================================
    // 1. LÓGICA DO CABEÇALHO E MENU
    // =======================================================
    const btnExplorar = document.getElementById('btn-explorar');
    const btnCategorias = document.getElementById('btn-categorias');
    const painelExplorar = document.getElementById('painel-explorar');
    const painelCategorias = document.getElementById('painel-categorias');
    const overlay = document.getElementById('overlay-escuro');

    function atualizarOverlay() {
        if ((painelExplorar && painelExplorar.classList.contains('show')) ||
            (painelCategorias && painelCategorias.classList.contains('show'))) {
            if (overlay) overlay.classList.add('ativo');
        } else {
            if (overlay) overlay.classList.remove('ativo');
        }
    }

    function togglePainel(painelAtual, painelOutro) {
        if (painelOutro && painelOutro.classList.contains('show')) {
            painelOutro.classList.remove('show');
        }
        if (painelAtual) painelAtual.classList.toggle('show');
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
    // 2. LÓGICA DA GALERIA (Troca sucessiva igual carrossel)
    // =======================================================
    const painelMidia = document.getElementById('painel-midia');
    const galeriaThumbnails = document.getElementById('galeria-thumbnails');

    if (painelMidia && galeriaThumbnails) {
        galeriaThumbnails.addEventListener('click', function (e) {
            // Verifica o que foi clicado (a imagem ou o botão vermelho do trailer)
            const clickedThumb = e.target.closest('.thumb-item, .thumb-video-btn');
            if (!clickedThumb) return;

            // 1. Descobre o que está no Painel Principal agora
            const mainIframe = painelMidia.querySelector('iframe');
            const mainImg = painelMidia.querySelector('img');

            let mainType = mainIframe ? 'video' : 'imagem';
            let mainSrc = mainIframe ? mainIframe.src : mainImg.src;

            // 2. Descobre o que acabou de ser clicado na Miniatura
            let clickedType = clickedThumb.classList.contains('thumb-video-btn') ? 'video' : 'imagem';
            let clickedSrc = clickedType === 'video' ? clickedThumb.getAttribute('data-src') : clickedThumb.src;

            // 3. Joga o conteúdo Clicado para o Painel Principal
            if (clickedType === 'video') {
                painelMidia.innerHTML = `<iframe src="${clickedSrc}" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
            } else {
                painelMidia.innerHTML = `<img src="${clickedSrc}" style="width:100%; height:100%; object-fit:contain; background:#000;">`;
            }

            // 4. Joga o que estava no Painel Principal para o lugar da Miniatura (SWAP)
            if (mainType === 'video') {
                const btnVideo = document.createElement('div');
                btnVideo.className = 'thumb-video-btn';
                btnVideo.setAttribute('data-src', mainSrc); // Salva o link do drive no botão
                btnVideo.innerHTML = '<span>▶ Ver Trailer</span>';
                clickedThumb.replaceWith(btnVideo);
            } else {
                const newImg = document.createElement('img');
                newImg.className = 'thumb-item';
                newImg.src = mainSrc;
                clickedThumb.replaceWith(newImg);
            }
        });
    }

    // =======================================================
    // 3. SISTEMA DE AVALIAÇÃO (Apenas Logados)
    // =======================================================
    const stars = document.querySelectorAll('.happy-stars .star-icon');
    const msgLogin = document.getElementById('msg-login-rating');

    const usuarioLogado = false;

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            if (!usuarioLogado) {
                msgLogin.style.display = 'block';
                return;
            }

            const notaNumero = document.querySelector('.nota-numero');
            if (notaNumero) notaNumero.innerText = (index + 1).toFixed(1);

            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('active'); s.classList.remove('inactive');
                } else {
                    s.classList.add('inactive'); s.classList.remove('active');
                }
            });
        });
    });

    // =======================================================
    // 4. LÓGICA DO CUPOM DE DESCONTO
    // =======================================================
    const btnCupom = document.getElementById('btn-aplicar-cupom');
    const inputCupom = document.getElementById('input-cupom');
    const msgCupom = document.getElementById('msg-cupom');
    const precoFinal = document.getElementById('preco-final');

    if (btnCupom && inputCupom && precoFinal) {
        btnCupom.addEventListener('click', () => {
            const cupomDigitado = inputCupom.value.trim().toUpperCase();

            if (cupomDigitado === 'QUIMERA15') {
                let valorBase = parseFloat(precoFinal.getAttribute('data-valor'));
                let valorComDescontoExtra = valorBase * 0.85;
                let valorFormatado = valorComDescontoExtra.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                precoFinal.innerText = 'R$ ' + valorFormatado;
                msgCupom.innerText = "Cupom de 15% aplicado com sucesso!";
                msgCupom.style.color = "#4CAF50";
                inputCupom.disabled = true;
                btnCupom.disabled = true;
            } else if (cupomDigitado === '') {
                msgCupom.innerText = "Digite um cupom válido.";
                msgCupom.style.color = "#e50914";
            } else {
                msgCupom.innerText = "Cupom inválido ou expirado.";
                msgCupom.style.color = "#e50914";
            }
        });
    }

});