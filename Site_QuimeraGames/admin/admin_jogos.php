<?php
session_start();
require_once '../conexa.php';

if (!isset($_SESSION['tipo_user']) || $_SESSION['tipo_user'] !== 'adm') {
    die("<div style='background:#0b1320; height:100vh; display:flex; align-items:center; justify-content:center;'><h1 style='color:#e62429; font-family:sans-serif;'>Acesso Restrito: Exclusivo para Administradores.</h1></div>");
}

$qtd_carrinho = $pdo->query("SELECT COUNT(*) FROM carrinho WHERE id_usuario = " . $_SESSION['id_user'])->fetchColumn();
$qtd_wishlist = $pdo->query("SELECT COUNT(*) FROM lista_desejos WHERE id_user = " . $_SESSION['id_user'])->fetchColumn();
$logado = true;
$link_home = '../usuario_logado/usuariologado.php';

$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    $id_play = $_POST['id_play'] ?? '';

    $id_cat = $_POST['categoria'] ?? 1;
    $titulo = $_POST['titulo'] ?? '';
    $desenv = $_POST['desenvolvedora'] ?? '';
    $distrib = $_POST['distribuidora'] ?? '';
    $info = $_POST['informacoes'] ?? '';
    $valor = $_POST['valor'] ?? 0;
    $data_lanc = $_POST['data_lancamento'] ?? date('Y-m-d');
    $req = $_POST['req_sistema'] ?? '';
    $capa = $_POST['img_capa'] ?? '';
    $cen1 = $_POST['img_cen1'] ?? '';
    $cen2 = $_POST['img_cen2'] ?? '';

    try {
        if ($acao === 'cadastrar') {
            $sql = "INSERT INTO jogos (titulo, desenvolvedora, distribuidora, informacoes, Valor, data_lancamento, req_sistema, Imagens_jogos, Imagens_cen1, Imagens_cen2, id_categoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([$titulo, $desenv, $distrib, $info, $valor, $data_lanc, $req, $capa, $cen1, $cen2, $id_cat]);
            $mensagem = "<div class='msg success'>Jogo cadastrado com sucesso!</div>";
        } elseif ($acao === 'atualizar' && !empty($id_play)) {
            $sql = "UPDATE jogos SET titulo=?, desenvolvedora=?, distribuidora=?, informacoes=?, Valor=?, data_lancamento=?, req_sistema=?, Imagens_jogos=?, Imagens_cen1=?, Imagens_cen2=?, id_categoria=? WHERE id_play=?";
            $pdo->prepare($sql)->execute([$titulo, $desenv, $distrib, $info, $valor, $data_lanc, $req, $capa, $cen1, $cen2, $id_cat, $id_play]);
            $mensagem = "<div class='msg success'>Jogo atualizado!</div>";
        } elseif ($acao === 'remover' && !empty($id_play)) {
            $pdo->prepare("DELETE FROM jogos WHERE id_play=?")->execute([$id_play]);
            $mensagem = "<div class='msg error'>Jogo excluído!</div>";
        }
    } catch (Exception $e) {
        $mensagem = "<div class='msg error'>Erro: " . $e->getMessage() . "</div>";
    }
}

$jogos = $pdo->query("SELECT j.*, c.tipo_categoria FROM jogos j LEFT JOIN categorias c ON j.id_categoria = c.id_categoria ORDER BY j.id_play DESC")->fetchAll(PDO::FETCH_ASSOC);
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel Admin - QuimeraGames</title>
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/stylles.css">
    <link rel="stylesheet" href="stylle.css?v=<?php echo time(); ?>">
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <?php include '../header_footer_global/header.php'; ?>

    <main style="flex: 1; display: flex; flex-direction: column;">
        <div class="bloqueio-mobile">
            <span style="font-size: 60px;">💻</span>
            <h2>Acesso Restrito ao Desktop</h2>
            <p>Por questões de segurança e usabilidade, o cadastro e edição de jogos só pode ser feito através de um
                Computador.</p>
        </div>

        <div class="admin-wrapper">
            <h2 style="margin-bottom: 20px; color: #e62429; border-bottom: 1px solid #1f2937; padding-bottom: 10px;">
                Painel de Gerenciamento de Jogos</h2>
            <?= $mensagem ?>

            <form method="POST" id="form-admin">
                <input type="hidden" name="acao" id="acao" value="cadastrar">
                <input type="hidden" name="id_play" id="id_play" value="">

                <div class="form-grid">
                    <div class="input-group col-1">
                        <label>Categoria</label>
                        <select name="categoria" id="categoria" required>
                            <?php foreach ($categorias as $c): ?>
                                <option value="<?= $c['id_categoria'] ?>"><?= $c['tipo_categoria'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group col-2">
                        <label>Título</label><input type="text" name="titulo" id="titulo" required>
                    </div>
                    <div class="input-group col-1">
                        <label>Desenvolvedora</label><input type="text" name="desenvolvedora" id="desenvolvedora"
                            required>
                    </div>
                    <div class="input-group col-1">
                        <label>Distribuidora</label><input type="text" name="distribuidora" id="distribuidora" required>
                    </div>
                    <div class="input-group col-1">
                        <label>Valor (R$)</label><input type="number" step="0.01" name="valor" id="valor" required>
                    </div>

                    <div class="input-group col-1">
                        <label>Data Lançamento</label><input type="date" name="data_lancamento" id="data_lancamento"
                            required>
                    </div>
                    <div class="input-group col-5">
                        <label>Requisitos do Sistema</label><input type="text" name="req_sistema" id="req_sistema"
                            required>
                    </div>

                    <div class="input-group col-6">
                        <label>Informações / Sinopse</label><input type="text" name="informacoes" id="informacoes"
                            required>
                    </div>

                    <div class="input-group col-2">
                        <label>URL Imagem Capa</label><input type="text" name="img_capa" id="img_capa" required>
                    </div>
                    <div class="input-group col-2">
                        <label>URL Imagem Cenário 1</label><input type="text" name="img_cen1" id="img_cen1">
                    </div>
                    <div class="input-group col-2">
                        <label>URL Imagem Cenário 2</label><input type="text" name="img_cen2" id="img_cen2">
                    </div>
                </div>

                <div class="botoes-acao">
                    <button type="button" class="btn-admin" onclick="enviarForm('cadastrar')">Cadastrar</button>
                    <button type="button" class="btn-admin" onclick="enviarForm('atualizar')">Atualizar</button>
                    <button type="button" class="btn-admin" onclick="enviarForm('remover')">Remover</button>
                    <button type="button" class="btn-admin btn-limpar" onclick="limparCampos()">Limpar Campos</button>
                </div>
            </form>

            <div class="tabela-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Categoria</th>
                            <th>Desenv.</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jogos as $j): ?>
                            <tr onclick='preencher(<?= json_encode($j) ?>)'>
                                <td><?= $j['id_play'] ?></td>
                                <td><?= htmlspecialchars($j['titulo']) ?></td>
                                <td><?= htmlspecialchars($j['tipo_categoria'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($j['desenvolvedora']) ?></td>
                                <td>R$ <?= number_format($j['Valor'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include '../header_footer_global/footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>