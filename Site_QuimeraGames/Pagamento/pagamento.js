// ==========================================================
// 1. VARIÁVEIS GLOBAIS E CONTROLE
// ==========================================================
var pixInterval = null;
const PRECO_REAL_JOGO = typeof PRECO_JOGO !== 'undefined' ? PRECO_JOGO : 0;
let saldoCoinsAtual = typeof SALDO_COINS_INICIAL !== 'undefined' ? SALDO_COINS_INICIAL : 0;

function atualizarInterfacePreco() {
    const chk = document.getElementById('chk-usar-coins');
    const querUsarCoins = chk ? chk.checked : false;

    const desconto = querUsarCoins ? (saldoCoinsAtual * 0.01) : 0;
    const precoCalculado = Math.max(0, PRECO_REAL_JOGO - desconto);

    const display = document.getElementById('preco-exibicao');
    if (display) {
        display.innerText = 'R$ ' + precoCalculado.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    const msgGratis = document.getElementById('msg-compra-gratis');
    const formPagto = document.getElementById('form-pagamento');

    if (precoCalculado <= 0 && querUsarCoins) {
        if (msgGratis) msgGratis.style.display = 'block';
        if (formPagto) formPagto.style.display = 'none';
    } else {
        if (msgGratis) msgGratis.style.display = 'none';
        if (formPagto) formPagto.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', () => {

    const chk = document.getElementById('chk-usar-coins');
    if (chk) chk.addEventListener('change', atualizarInterfacePreco);

    const boxCoinsUI = document.getElementById('box-usar-moedas');
    if (boxCoinsUI) {
        boxCoinsUI.addEventListener('click', (e) => {
            if (e.target !== chk && e.target.tagName !== 'LABEL') {
                chk.checked = !chk.checked;
                atualizarInterfacePreco();
            }
        });
    }

    var radios = document.querySelectorAll('input[name="metodo"]');
    radios.forEach(function (r) {
        r.addEventListener('change', function (e) {
            var forms = { cartao: document.getElementById('dados-cartao'), pix: document.getElementById('dados-pix'), boleto: document.getElementById('dados-boleto') };
            var cards = { cartao: document.getElementById('mc-cartao'), pix: document.getElementById('mc-pix'), boleto: document.getElementById('mc-boleto') };
            Object.values(forms).forEach(function (f) { if (f) f.classList.remove('ativo'); });
            Object.values(cards).forEach(function (c) { if (c) c.classList.remove('sel'); });
            if (forms[e.target.value]) forms[e.target.value].classList.add('ativo');
            if (cards[e.target.value]) cards[e.target.value].classList.add('sel');
        });
    });

    document.querySelectorAll('.overlay').forEach(function (ov) {
        ov.addEventListener('click', function (e) {
            if (e.target === ov) fecharTudo();
        });
    });

    // MÁSCARAS DE INPUT PARA CARTÃO DE CRÉDITO
    const inputNumCartao = document.getElementById('num-cartao');
    if (inputNumCartao) {
        inputNumCartao.addEventListener('input', function (e) {
            let v = e.target.value.replace(/\D/g, ''); // Remove não números
            v = v.replace(/(\d{4})/g, '$1 ').trim(); // Adiciona espaço a cada 4
            e.target.value = v.substring(0, 19);
        });
    }

    const inputValidade = document.getElementById('val-cartao');
    if (inputValidade) {
        inputValidade.addEventListener('input', function (e) {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length > 2) {
                v = v.substring(0, 2) + '/' + v.substring(2, 4);
            }
            e.target.value = v;
        });
    }

    const inputCVV = document.getElementById('cvv-cartao');
    if (inputCVV) {
        inputCVV.addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
    }

    // GAMIFICAÇÃO MASCOTE (Omitido para focar na resposta, mantenha o seu bloco idêntico aqui caso necessário)
    // ... [Mantenha a lógica do mascote gamification aqui] ...
});

// ==========================================================
// REGISTRO DE COMPRA REAL (INTEGRAÇÃO COM PHP)
// ==========================================================
function registrarCompra(metodo, codigo) {
    // Verifica se a opção de usar coins está marcada
    const chkCoins = document.getElementById('chk-usar-coins');
    const usarCoins = (chkCoins && chkCoins.checked) ? '1' : '0';

    // Monta os dados que serão enviados via POST
    const formData = new FormData();
    formData.append('metodo', metodo);
    formData.append('usar_coins', usarCoins);

    // Envia a requisição para o PHP
    return fetch('confirmar_compra.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Tenta converter a resposta do PHP para JSON
        if (!response.ok) {
            throw new Error('Erro na resposta do servidor');
        }
        return response.json();
    })
    .then(data => {
        // data.sucesso virá como true ou false do seu PHP
        return data; 
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
        return { 
            sucesso: false, 
            msg: 'Erro ao se comunicar com o servidor. Tente novamente.' 
        };
    });
}

// ==========================================================
// VALIDAÇÃO DO CARTÃO DE CRÉDITO
// ==========================================================
function validarCartao() {
    let valido = true;

    const num = document.getElementById('num-cartao');
    const nome = document.getElementById('nome-cartao');
    const val = document.getElementById('val-cartao');
    const cvv = document.getElementById('cvv-cartao');

    const errNum = document.getElementById('err-num');
    const errNome = document.getElementById('err-nome');
    const errValCvv = document.getElementById('err-valcvv');

    // Resetar erros visuais
    [num, nome, val, cvv].forEach(el => { if(el) el.classList.remove('input-error'); });
    [errNum, errNome, errValCvv].forEach(el => { if(el) el.style.display = 'none'; });

    // Validar Número (Exige 16 dígitos)
    const numLimpo = num.value.replace(/\s/g, '');
    if (numLimpo.length < 16) {
        num.classList.add('input-error');
        errNum.style.display = 'block';
        valido = false;
    }

    // Validar Nome (Não vazio e mínimo 2 palavras)
    if (nome.value.trim().split(' ').length < 2) {
        nome.classList.add('input-error');
        errNome.style.display = 'block';
        valido = false;
    }

    // Validar Validade (MM/AA e Data Futura)
    const valRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
    let validadeOk = false;
    if (valRegex.test(val.value)) {
        const [mes, ano] = val.value.split('/');
        const dataAtual = new Date();
        const anoAtual = parseInt(dataAtual.getFullYear().toString().substr(-2));
        const mesAtual = dataAtual.getMonth() + 1;
        
        if (parseInt(ano) > anoAtual || (parseInt(ano) === anoAtual && parseInt(mes) >= mesAtual)) {
            validadeOk = true;
        }
    }
    
    // Validar CVV (3 ou 4 dígitos)
    const cvvOk = cvv.value.length >= 3;

    if (!validadeOk || !cvvOk) {
        if (!validadeOk) val.classList.add('input-error');
        if (!cvvOk) cvv.classList.add('input-error');
        errValCvv.style.display = 'block';
        valido = false;
    }

    return valido;
}


function iniciarPagamento() {
    var checked = document.querySelector('input[name="metodo"]:checked');
    if (!checked) return;
    var m = checked.value;

    if (m === 'cartao') { 
        if (validarCartao()) {
            fluxoCartao(); 
        }
    }
    else if (m === 'pix') { fluxoPix(); }
    else { fluxoBoleto(); }
}

// ==========================================================
// MODAIS DE PAGAMENTO
// ==========================================================
function fluxoCoins() {
    document.getElementById('ov-cartao').classList.add('show');
    document.getElementById('steps-cartao').style.display = 'none';
    document.getElementById('cartao-body').innerHTML = `
        <div class="spinner"></div>
        <h2>Resgatando jogo...</h2>
        <p>A deduzir as suas moedas e a liberar o jogo na biblioteca.</p>
    `;

    registrarCompra('coins', 'FREE-' + Math.floor(Math.random() * 10000)).then(function (resultado) {
        if (resultado && resultado.sucesso) {
            document.getElementById('cartao-body').innerHTML = `
                <div class="check-circle">&#10003;</div>
                <h2 style="color:#22c55e">Jogo Resgatado!</h2>
                <p>As suas moedas foram aplicadas com sucesso.</p>
                <button class="btn-modal-primary" onclick="window.location.href='../Usuario_Logado/meus_pedidos.php'">Ir para a Biblioteca</button>
            `;
        } else {
            document.getElementById('cartao-body').innerHTML = `
                <div class="x-circle">&#10005;</div>
                <h2 style="color:#e62429">Erro</h2>
                <p>${resultado?.msg || 'Erro desconhecido'}</p>
                <button class="btn-modal-ghost" onclick="fecharTudo()">Fechar</button>
            `;
        }
    });
}

function fluxoCartao() {
    document.getElementById('ov-cartao').classList.add('show'); setStep(1);
    document.getElementById('cartao-body').innerHTML = `
        <div class="spinner"></div>
        <h2>Validando dados</h2>
        <div class="prog-wrap"><div class="prog-bar" id="pb1" style="width:0%"></div></div>
        <p class="prog-label" id="pl1">A conectar ao banco...</p>
    `;

    var msgs = ['A conectar...', 'A validar cartão...', 'A verificar titularidade...', 'A checar limite...'];
    var pct = 0, mi = 0;
    var iv = setInterval(function () {
        pct += 7;
        var pb = document.getElementById('pb1');
        var pl = document.getElementById('pl1');
        if (pb) pb.style.width = Math.min(pct, 100) + '%';
        if (pl && pct % 25 === 0 && mi < msgs.length) pl.textContent = msgs[mi++];
        if (pct >= 100) { clearInterval(iv); setTimeout(cartaoFase2, 400); }
    }, 120);
}

function cartaoFase2() {
    setStep(2);
    document.getElementById('cartao-body').innerHTML = `
        <div class="spinner"></div>
        <h2>A processar pagamento</h2>
        <div class="prog-wrap"><div class="prog-bar" id="pb2" style="width:0%"></div></div>
        <p class="prog-label" id="pl2">A processar...</p>
    `;

    var msgs = ['Iniciando transação...', 'A comunicar operadora...', 'Aguardando aprovação...', 'A finalizar...'];
    var pct = 0, mi = 0;
    var iv = setInterval(function () {
        pct += 4;
        var pb = document.getElementById('pb2');
        var pl = document.getElementById('pl2');
        if (pb) pb.style.width = Math.min(pct, 100) + '%';
        if (pl && pct % 20 === 0 && mi < msgs.length) pl.textContent = msgs[mi++];
        if (pct >= 100) { clearInterval(iv); setTimeout(cartaoFase3, 400); }
    }, 100);
}

function cartaoFase3() {
    setStep(3);
    document.getElementById('cartao-body').innerHTML = '<div class="spinner"></div><h2>A registar compra...</h2>';
    registrarCompra('cartao', '#QG-' + Math.random().toString(36).substr(2, 8).toUpperCase()).then(function (resultado) {
        if (resultado && resultado.sucesso) {
            document.getElementById('cartao-body').innerHTML = `
                <div class="check-circle">&#10003;</div>
                <h2 style="color:#22c55e">Pagamento aprovado!</h2>
                <p>Compra realizada com sucesso e jogo enviado para a biblioteca.</p>
                <button class="btn-modal-primary" onclick="window.location.href='../Usuario_Logado/meus_pedidos.php'">Concluir</button>
            `;
        } else {
            document.getElementById('cartao-body').innerHTML = `
                <div class="x-circle">&#10005;</div>
                <h2 style="color:#e62429">Erro</h2>
                <p>${resultado?.msg || 'Erro'}</p>
                <button class="btn-modal-ghost" onclick="fecharTudo()">Fechar</button>
            `;
        }
    });
}

function fluxoPix() {
    document.getElementById('ov-pix').classList.add('show');
    document.getElementById('pix-body').innerHTML = '<div class="spinner"></div><h2>A gerar QR Code</h2>';
    setTimeout(function () {
        document.getElementById('pix-body').innerHTML = `
            <h2>Pague com Pix</h2>
            <div class="qr-container"><img src="../pagamento/img/qrcode-pix.png" width="190" height="190" alt="QR Code Pix"></div>
            <button class="btn-modal-primary" onclick="simularPagamentoPix()">&#10003; Já fiz o pagamento</button>
            <button class="btn-modal-ghost" onclick="fecharTudo()">Cancelar</button>
        `;
    }, 1500);
}

function simularPagamentoPix() {
    document.getElementById('pix-body').innerHTML = '<div class="spinner"></div><h2>A confirmar...</h2>';
    setTimeout(function () {
        registrarCompra('pix', 'E' + Math.random().toString().substr(2, 23).toUpperCase()).then(function (resultado) {
            if (resultado && resultado.sucesso) {
                document.getElementById('pix-body').innerHTML = `
                    <div class="check-circle">&#10003;</div>
                    <h2 style="color:#22c55e">Pix confirmado!</h2>
                    <p>${resultado.msg}</p>
                    <button class="btn-modal-primary" onclick="window.location.href='../usuario_logado/meus_pedidos.php'">Concluir</button>
                `;
            } else {
                document.getElementById('pix-body').innerHTML = `
                    <div class="x-circle">&#10005;</div>
                    <h2 style="color:#e62429">Erro</h2>
                    <p>${resultado?.msg || 'Erro'}</p>
                    <button onclick="fecharTudo()">Fechar</button>
                `;
            }
        });
    }, 2000);
}

function fluxoBoleto() {
    document.getElementById('ov-boleto').classList.add('show');
    document.getElementById('boleto-body').innerHTML = '<div class="spinner"></div><h2>A processar boleto...</h2>';
    
    // Alarga o modal para caber o layout real do boleto
    document.querySelector('#ov-boleto .modal').style.maxWidth = '750px';
    
    const linhaDigitavel = '99991.00007 00000.123456 00000.000009 1 90000000000000';

    setTimeout(() => {
        registrarCompra('boleto', linhaDigitavel).then(function (resultado) {
            if (resultado && resultado.sucesso) {
                let hoje = new Date();
                hoje.setDate(hoje.getDate() + 3);
                let vencimento = hoje.toLocaleDateString('pt-BR');
                let valorBoleto = document.getElementById('preco-exibicao') ? document.getElementById('preco-exibicao').innerText : 'R$ 0,00';

                // Layout Padrão Febraban Real (Preto e Branco)
                document.getElementById('boleto-body').innerHTML = `
                    <h2 style="margin-bottom: 15px; color: #fff;">Boleto Gerado com Sucesso!</h2>
                    
                    <div class="boleto-scroll-wrapper">
                        <div class="boleto-visual-real">
                            <div class="boleto-header-real">
                                <div class="boleto-banco">
                                    <span class="logo-banco">Banco Quimera S.A.</span>
                                    <span class="codigo-banco">999-X</span>
                                </div>
                                <div class="boleto-linha-digitavel-real" id="codigo-linha-digitavel">
                                    ${linhaDigitavel}
                                </div>
                            </div>

                            <div class="boleto-body-real">
                                <div class="boleto-row">
                                    <div class="boleto-cell col-70 border-right"><label>Local de Pagamento</label>Pagável em qualquer banco ou aplicativo de banco até o vencimento.</div>
                                    <div class="boleto-cell col-30"><label>Vencimento</label><b style="font-size: 0.95rem;">${vencimento}</b></div>
                                </div>
                                <div class="boleto-row">
                                    <div class="boleto-cell col-70 border-right"><label>Beneficiário</label>QuimeraGames Interatividades Ltda. - CNPJ: 99.999.999/0001-99</div>
                                    <div class="boleto-cell col-30"><label>Agência / Código do Beneficiário</label>0001 / 123456-7</div>
                                </div>
                                <div class="boleto-row">
                                    <div class="boleto-cell col-20 border-right"><label>Data do Documento</label>${new Date().toLocaleDateString('pt-BR')}</div>
                                    <div class="boleto-cell col-25 border-right"><label>Nº do Documento</label>87654321</div>
                                    <div class="boleto-cell col-15 border-right"><label>Espécie doc.</label>DM</div>
                                    <div class="boleto-cell col-10 border-right"><label>Aceite</label>N</div>
                                    <div class="boleto-cell col-30"><label>Nosso Número</label>10987654321-0</div>
                                </div>
                                <div class="boleto-row">
                                    <div class="boleto-cell col-70 border-right instructions">
                                        <label>Instruções (Texto de responsabilidade do beneficiário)</label>
                                        <p>• Boleto válido apenas para simulação de compra no site QuimeraGames.</p>
                                        <p>• Não receber após a data de vencimento.</p>
                                        <p>• A liberação dos jogos na sua biblioteca ocorrerá automaticamente após a confirmação do pagamento.</p>
                                    </div>
                                    <div class="boleto-cell col-30 values">
                                        <div class="inner-row border-bottom"><label>(=) Valor do Documento</label><b style="font-size:1.1rem;">${valorBoleto}</b></div>
                                        <div class="inner-row border-bottom"><label>(-) Desconto / Abatimento</label></div>
                                        <div class="inner-row"><label>(+) Mora / Multa</label></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="boleto-footer-real">
                                <div class="boleto-codigo-barras">
                                    ${Array.from({length: 60}).map(() => `<div class="bar bar-${Math.floor(Math.random() * 4) + 1}"></div>`).join('')}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="boleto-actions">
                        <button id="btn-copiar-boleto" class="btn-modal-secondary btn-icon btn-sm" onclick="copiarCodigoBoleto('${linhaDigitavel}')">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            Copiar Código
                        </button>
                        <button class="btn-modal-primary btn-sm" onclick="window.location.href='../Usuario_Logado/meus_pedidos.php'">Confirmar</button>
                        <button class="btn-modal-ghost btn-sm" onclick="fecharTudo()">Fechar</button>
                    </div>
                `;
            } else {
                document.getElementById('boleto-body').innerHTML = `
                    <div class="x-circle">&#10005;</div>
                    <h2 style="color:#e62429">Erro</h2>
                    <p>${resultado?.msg || 'Erro'}</p>
                    <button class="btn-modal-ghost" onclick="fecharTudo()">Fechar</button>
                `;
            }
        });
    }, 1500);
}

// Nova função para copiar o código do boleto
function copiarCodigoBoleto(codigo) {
    // Remove os espaços do código para facilitar a cópia real
    const codigoLimpo = codigo.replace(/\s/g, ''); 
    
    navigator.clipboard.writeText(codigoLimpo).then(() => {
        const btn = document.getElementById('btn-copiar-boleto');
        const conteudoOriginal = btn.innerHTML;
        
        // Altera o visual do botão temporariamente
        btn.innerHTML = `&#10003; Código Copiado!`;
        btn.style.backgroundColor = "#22c55e"; // Verde sucesso
        btn.style.color = "#fff";
        btn.style.borderColor = "#22c55e";

        // Restaura após 2.5 segundos
        setTimeout(() => {
            btn.innerHTML = conteudoOriginal;
            btn.style.backgroundColor = "transparent";
            btn.style.color = "#e62429";
            btn.style.borderColor = "#e62429";
        }, 2500);
    }).catch(err => {
        alert("Erro ao copiar o código. Tente selecionar o texto manualmente.");
        console.error("Erro no clipboard: ", err);
    });
}

function fecharTudo() { ['ov-cartao', 'ov-pix', 'ov-boleto'].forEach(function (id) { var el = document.getElementById(id); if (el) el.classList.remove('show'); }); document.getElementById('steps-cartao').style.display = 'flex'; }
function showErr(id, show) { var el = document.getElementById(id); if (el) el.style.display = show ? 'block' : 'none'; }
function setStep(n) { for (var i = 1; i <= 3; i++) { var s = document.getElementById('s' + i); if (!s) continue; s.className = 'step' + (i < n ? ' done' : i === n ? ' active' : ''); } }

// ── CONTROLE DO MENU DO USUÁRIO (DROPDOWN) ────────────────
function toggleMenu() {
    const menu = document.getElementById("user-menu");
    if (menu) {
        menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
    }
}

document.addEventListener("click", function (e) {
    const userBox = document.querySelector(".user-box");
    const menu = document.getElementById("user-menu");
    if (userBox && menu && !userBox.contains(e.target)) {
        menu.style.display = "none";
    }
});