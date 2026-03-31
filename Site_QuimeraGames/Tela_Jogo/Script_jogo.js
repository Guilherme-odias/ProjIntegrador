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
    // 2. LÓGICA DA GALERIA (Miniaturas e Vídeo)
    // =======================================================
    const painelMidia = document.getElementById('painel-midia');
    const btnVoltarVideo = document.getElementById('btn-voltar-video');
    const thumbItems = document.querySelectorAll('.thumb-item');
    
    // Salva o HTML original (que contém o iframe do trailer)
    let iframeOriginalHTML = painelMidia ? painelMidia.innerHTML : '';

    // Quando clica numa imagem da miniatura
    thumbItems.forEach(thumb => {
        thumb.addEventListener('click', function() {
            if(painelMidia) {
                // Joga a imagem clicada para a tela principal
                painelMidia.innerHTML = `<img src="${this.src}" style="width:100%; height:100%; object-fit:contain; background:#000;">`;
            }
        });
    });

    // Quando clica no botão "Ver Trailer", restaura o iframe
    if (btnVoltarVideo) {
        btnVoltarVideo.addEventListener('click', function() {
            painelMidia.innerHTML = iframeOriginalHTML;
        });
    }

    // =======================================================
    // 3. SISTEMA DE AVALIAÇÃO (Apenas Logados)
    // =======================================================
    const stars = document.querySelectorAll('.happy-stars .star-icon');
    const msgLogin = document.getElementById('msg-login-rating');
    
    // Variável simulando que o usuário NÃO está logado. 
    // No futuro, você vai alterar isso puxando a sessão do PHP.
    const usuarioLogado = false; 

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            if (!usuarioLogado) {
                msgLogin.style.display = 'block';
                return; // Bloqueia o clique
            }

            // Se estiver logado, faz a lógica de pintar a estrela
            const notaNumero = document.querySelector('.nota-numero');
            if(notaNumero) notaNumero.innerText = (index + 1).toFixed(1);

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
            
            // Exemplo de cupom válido: QUIMERA15 (dá 15% de desconto extra)
            if (cupomDigitado === 'QUIMERA15') {
                // Pega o valor original salvo no data-valor do HTML
                let valorBase = parseFloat(precoFinal.getAttribute('data-valor'));
                let valorComDescontoExtra = valorBase * 0.85; // Tira 15%
                
                // Formata para Reais (R$)
                let valorFormatado = valorComDescontoExtra.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                
                precoFinal.innerText = 'R$ ' + valorFormatado;
                msgCupom.innerText = "Cupom de 15% aplicado com sucesso!";
                msgCupom.style.color = "#4CAF50"; // Verde
                inputCupom.disabled = true; // Bloqueia pra não usar duas vezes
                btnCupom.disabled = true;
            } else if (cupomDigitado === '') {
                msgCupom.innerText = "Digite um cupom válido.";
                msgCupom.style.color = "#e50914"; // Vermelho
            } else {
                msgCupom.innerText = "Cupom inválido ou expirado.";
                msgCupom.style.color = "#e50914"; // Vermelho
            }
        });
    }

});