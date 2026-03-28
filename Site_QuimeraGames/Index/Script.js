// 1. Funções Globais (precisam estar fora para o onclick do HTML funcionar)
function gerenciarTroca(index, elementoMin) {
    const slideContainer = document.getElementById('slide' + index);
    const imgPrincipal = document.getElementById('mainImg' + index);
    const infoBox = document.getElementById('infoBox' + index);

    if (!imgPrincipal || !slideContainer) return;

    const urlCapaOriginal = imgPrincipal.getAttribute('data-capa');
    const urlTemporaria = imgPrincipal.src;

    imgPrincipal.src = elementoMin.src;
    elementoMin.src = urlTemporaria;

    if (imgPrincipal.src === urlCapaOriginal) {
        slideContainer.classList.remove('cenario-ativo');
        infoBox.style.opacity = "1";
        infoBox.style.visibility = "visible";
    } else {
        slideContainer.classList.add('cenario-ativo');
        infoBox.style.opacity = "0";
        infoBox.style.visibility = "hidden";
    }
}

// 2. Lógica de Busca e Auto-slide (espera o HTML carregar)
document.addEventListener('DOMContentLoaded', () => {
    const inputBusca = document.querySelector('.busca-input input');
    const carrossel = document.querySelector('.carousel-container');
    const secaoDescontos = document.querySelector('.secao');
    const containerGeral = document.querySelector('.container');

    // Criar o container de resultados apenas uma vez
    let containerResultados = document.getElementById('resultados-busca');
    if (!containerResultados) {
        containerResultados = document.createElement('div');
        containerResultados.id = 'resultados-busca';
        containerResultados.style.display = 'none';
        containerGeral.appendChild(containerResultados);

    }

    // Lógica da Busca Dinâmica
    if (inputBusca) {
        inputBusca.addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length > 0) {
                carrossel.style.display = 'none';
                secaoDescontos.style.display = 'none';
                containerResultados.style.display = 'block';

                // IMPORTANTE: Verifique se o caminho do busca_jogos.php está correto
                fetch(`busca_jogos.php?query=${encodeURIComponent(query)}`)
                    .then(response => response.text())
                    .then(html => {
                        containerResultados.innerHTML = `<h2 style="color:white; margin-bottom:20px;">Resultados para: "${query}"</h2>` + html;
                    })
                    .catch(err => console.error("Erro na busca:", err));
            } else {
                carrossel.style.display = 'block';
                secaoDescontos.style.display = 'block';
                containerResultados.style.display = 'none';
            }
        });
    }

    // Lógica do Auto-slide
    let currentSlide = 1;
    setInterval(() => {
        currentSlide++;
        if (currentSlide > 7) currentSlide = 1;
        const radio = document.getElementById('s' + currentSlide);
        if (radio) {
            radio.checked = true;
        }
    }, 7000);

    // --- LÓGICA DOS BOTÕES EXPLORAR E CATEGORIAS ---
    const btnExplorar = document.getElementById('btn-explorar');
    const btnCategorias = document.getElementById('btn-categorias');
    const painelExplorar = document.getElementById('painel-explorar');
    const painelCategorias = document.getElementById('painel-categorias');

    // Função para alternar os painéis
    function togglePainel(painelAtual, painelOutro) {
        // Se o outro estiver aberto, fecha
        if (painelOutro.classList.contains('show')) {
            painelOutro.classList.remove('show');
        }
        // Alterna o atual (abre se estiver fechado, fecha se estiver aberto)
        painelAtual.classList.toggle('show');
    }

    if (btnExplorar && painelExplorar) {
        btnExplorar.addEventListener('click', (e) => {
            e.stopPropagation(); // Evita que clique feche imediatamente
            togglePainel(painelExplorar, painelCategorias);
        });
    }

    if (btnCategorias && painelCategorias) {
        btnCategorias.addEventListener('click', (e) => {
            e.stopPropagation();
            togglePainel(painelCategorias, painelExplorar);
        });
    }

    // Fecha os painéis se clicar fora deles (no resto do site)
    document.addEventListener('click', (e) => {
        if (!painelExplorar.contains(e.target) && e.target !== btnExplorar) {
            painelExplorar.classList.remove('show');
        }
        if (!painelCategorias.contains(e.target) && e.target !== btnCategorias) {
            painelCategorias.classList.remove('show');
        }

        const gridCategorias = document.getElementById('grid-categorias');
        const setaEsquerda = document.getElementById('seta-esquerda');
        const setaDireita = document.getElementById('seta-direita');

        if (gridCategorias && setaEsquerda && setaDireita) {
            // Quantidade de pixels para rolar a cada clique (Aproximadamente 3 cards)
            const scrollAmount = 450;

            setaEsquerda.addEventListener('click', (e) => {
                e.preventDefault(); // Evita recarregar a tela
                gridCategorias.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            });

            setaDireita.addEventListener('click', (e) => {
                e.preventDefault();
                gridCategorias.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            });
        }
    });
});