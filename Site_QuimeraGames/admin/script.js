function preencher(jogo) {
    document.getElementById('id_play').value = jogo.id_play;
    document.getElementById('categoria').value = jogo.id_categoria;
    document.getElementById('titulo').value = jogo.titulo;
    document.getElementById('desenvolvedora').value = jogo.desenvolvedora;
    document.getElementById('distribuidora').value = jogo.distribuidora;
    document.getElementById('informacoes').value = jogo.informacoes;
    document.getElementById('valor').value = jogo.Valor;
    document.getElementById('data_lancamento').value = jogo.data_lancamento;
    document.getElementById('req_sistema').value = jogo.req_sistema;
    document.getElementById('img_capa').value = jogo.Imagens_jogos;
    document.getElementById('img_cen1').value = jogo.Imagens_cen1;
    document.getElementById('img_cen2').value = jogo.Imagens_cen2;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function limparCampos() {
    document.getElementById('id_play').value = "";
    document.getElementById('form-admin').reset();
}

function enviarForm(acao) {
    let m = acao === 'cadastrar' ? "Cadastrar este jogo?" : (acao === 'atualizar' ? "Atualizar dados do jogo?" : "EXCLUIR permanentemente?");
    if (confirm(m)) {
        document.getElementById('acao').value = acao;
        document.getElementById('form-admin').submit();
    }
}