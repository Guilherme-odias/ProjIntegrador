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
    // 2. LÓGICA DA GALERIA (SWAP DINÂMICO PERFEITO)
    // =======================================================
    const galeriaThumbnails = document.getElementById('galeria-thumbnails');
    const painelMidia = document.getElementById('painel-midia');
    const videoContainer = document.getElementById('media-video-container');
    const imageContainer = document.getElementById('media-image-container');
    const iframeVideo = document.getElementById('video-iframe');
    const mainImage = document.getElementById('main-image');

    if (galeriaThumbnails && painelMidia) {
        galeriaThumbnails.addEventListener('click', function (e) {
            // Busca a div envolvente (.thumb-wrapper) que recebeu o clique
            const clickedWrapper = e.target.closest('.thumb-wrapper');
            if (!clickedWrapper) return;

            // 1. Pega os dados do que foi CLICADO
            const clickedType = clickedWrapper.dataset.type;
            const clickedSrc = clickedWrapper.dataset.src;

            // 2. Pega os dados de quem está no TELÃO PRINCIPAL
            const mainType = painelMidia.dataset.type;
            const mainSrc = painelMidia.dataset.src;

            // 3. TROCA OS DADOS (SWAP)
            painelMidia.dataset.type = clickedType;
            painelMidia.dataset.src = clickedSrc;

            clickedWrapper.dataset.type = mainType;
            clickedWrapper.dataset.src = mainSrc;

            // 4. ATUALIZA O VISUAL DO TELÃO PRINCIPAL
            if (clickedType === 'video') {
                videoContainer.style.display = 'block';
                imageContainer.style.display = 'none';
                iframeVideo.src = clickedSrc;
            } else {
                videoContainer.style.display = 'none';
                imageContainer.style.display = 'block';
                mainImage.src = clickedSrc;
                
                // Pausa o vídeo recarregando o iframe caso o trailer desça para as miniaturas
                if (iframeVideo && iframeVideo.src !== '') {
                    iframeVideo.src = iframeVideo.src;
                }
            }

            // 5. ATUALIZA O VISUAL DA MINIATURA CLICADA
            if (mainType === 'video') {
                // Se o que estava no telão era o vídeo, a miniatura vira o botão de trailer
                // Ajuste as classes CSS aqui conforme o estilo do seu botão original
                clickedWrapper.innerHTML = `
                    <div class="thumb-video-btn" style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#222; color:#fff; border-radius:4px;">
                        <span>▶ Trailer</span>
                    </div>`;
            } else {
                // Se o que estava no telão era imagem, a miniatura recebe essa imagem
                clickedWrapper.innerHTML = `
                    <img src="${mainSrc}" class="thumb-item" style="width:100%; height:100%; object-fit:cover; display:block;" alt="Cenário">
                `;
            }
        });
    }

    // =======================================================
    // 3. SISTEMA DE AVALIAÇÃO (Apenas Logados)
    // =======================================================
    const stars = document.querySelectorAll('.happy-stars .star-icon');
    const msgLogin = document.getElementById('msg-login-rating');

    const usuarioLogado = false; // Quando tiver PHP de sessão, mude para true

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