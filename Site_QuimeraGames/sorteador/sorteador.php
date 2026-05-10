<?php
session_start();
require_once '../conexa.php';

// --- PREPARAÇÃO PARA O HEADER GLOBAL ---
$logado = isset($_SESSION['usuario_nome']);
$id_user_logado = $_SESSION['id_user'] ?? 0;
$qtd_carrinho = 0;
$qtd_wishlist = 0;
$saldo_header = 0;
$usuario = [];

if ($logado && $id_user_logado > 0) {
    $stmt_h = $pdo->prepare("SELECT coins FROM cadastro WHERE id_user = ?");
    $stmt_h->execute([$id_user_logado]);
    $saldo_header = (int) $stmt_h->fetchColumn();

    $qtd_carrinho = $pdo->query("SELECT COUNT(*) FROM carrinho WHERE id_usuario = " . $id_user_logado)->fetchColumn();
    $qtd_wishlist = $pdo->query("SELECT COUNT(*) FROM lista_desejos WHERE id_user = " . $id_user_logado)->fetchColumn();

    $stmt_u = $pdo->prepare("SELECT url_foto FROM cadastro WHERE id_user = ?");
    $stmt_u->execute([$id_user_logado]);
    $usuario = $stmt_u->fetch(PDO::FETCH_ASSOC);
}
$link_home = $logado ? '../usuario_logado/usuariologado.php' : '../index/index.php';

$categorias = $pdo->query("SELECT id_categoria, tipo_categoria FROM categorias")->fetchAll(PDO::FETCH_ASSOC);

// CORREÇÃO DE PERFORMANCE: Limite reduzido para 12 (carrega muito mais rápido)
$imgs_roleta = $pdo->query("SELECT Imagens_jogos FROM jogos ORDER BY RAND() LIMIT 12")->fetchAll(PDO::FETCH_ASSOC);

$jogo_sorteado = null;
$erro_sorteio = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sortear'])) {
    $modo = $_POST['modo'] ?? 'todos';
    $cat_id = $_POST['categoria'] ?? '';
    $user_digitado = trim($_POST['usuario_digitado'] ?? '');

    $sql = "SELECT j.* FROM jogos j ";
    $params = [];

    if (($modo === 'desejos' || $modo === 'biblioteca') && !empty($user_digitado)) {
        $stmt_find = $pdo->prepare("SELECT id_user FROM cadastro WHERE nome_user = ?");
        $stmt_find->execute([$user_digitado]);
        $uid = $stmt_find->fetchColumn();

        if ($uid) {
            if ($modo === 'desejos') {
                $sql .= " INNER JOIN lista_desejos ld ON j.id_play = ld.id_play WHERE ld.id_user = ? ";
            } else {
                $sql .= " INNER JOIN minha_biblioteca b ON j.id_play = b.id_play WHERE b.id_user = ? ";
            }
            $params[] = $uid;
        } else {
            $erro_sorteio = "Usuário não encontrado!";
            $sql .= " WHERE 1=0 ";
        }
    } else {
        $sql .= " WHERE 1=1 ";
    }

    if (!empty($cat_id) && empty($erro_sorteio)) {
        $sql .= " AND j.id_categoria = ? ";
        $params[] = $cat_id;
    }

    if (empty($erro_sorteio)) {
        $sql .= " ORDER BY RAND() LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $jogo_sorteado = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$jogo_sorteado)
            $erro_sorteio = "Nenhum jogo encontrado com estes filtros!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteador - QuimeraGames</title>
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/stylles.css">
    <link rel="stylesheet" href="stylle.css?v=<?php echo time(); ?>">
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <?php include '../header_footer_global/header.php'; ?>

    <div class="container" style="flex: 1;">
        <div class="sorteador-main-card">

            <div class="sorteador-header">
                <h1>🎰 O que vamos jogar hoje?</h1>
                <p>Configure os filtros e deixe a sorte decidir por você!</p>
            </div>

            <form method="POST" id="form-sorteio">
                <div class="opcoes-grid">
                    <label class="btn-radio">
                        <input type="radio" name="modo" value="todos" checked onchange="toggleInputs()">
                        <span class="radio-custom">Todos os Jogos</span>
                    </label>
                    <label class="btn-radio">
                        <input type="radio" name="modo" value="desejos" onchange="toggleInputs()">
                        <span class="radio-custom">Meus Desejos</span>
                    </label>
                    <label class="btn-radio">
                        <input type="radio" name="modo" value="biblioteca" onchange="toggleInputs()">
                        <span class="radio-custom">Minha Biblioteca</span>
                    </label>
                </div>

                <div class="inputs-row">
                    <input type="text" name="usuario_digitado" id="user_input" class="input-dark"
                        placeholder="Nome de usuário..." style="display:none;">

                    <select name="categoria" class="input-dark" id="cat_input">
                        <option value="">-- Qualquer Categoria --</option>
                        <?php foreach ($categorias as $c): ?>
                            <option value="<?= $c['id_categoria'] ?>"><?= htmlspecialchars($c['tipo_categoria']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="sortear" class="btn-sortear-principal">
                    SORTEAR AGORA
                </button>

                <?php if ($erro_sorteio): ?>
                    <div class="alert-erro"><?= $erro_sorteio ?></div>
                <?php endif; ?>
            </form>

            <div class="roleta-box" id="roleta-container" style="display:none;">
                <div class="roleta-track">
                    <?php foreach ($imgs_roleta as $im): ?>
                        <img src="<?= $im['Imagens_jogos'] ?>">
                    <?php endforeach; ?>
                    <?php if ($jogo_sorteado): ?>
                        <img src="<?= htmlspecialchars($jogo_sorteado['Imagens_jogos']) ?>">
                    <?php endif; ?>
                </div>
            </div>

            <div class="resultado-vencedor" id="resultado-final"
                style="display: <?php echo ($jogo_sorteado) ? 'block' : 'none'; ?>;">
                <?php if ($jogo_sorteado): ?>
                    <h2 class="txt-sorteado">🎉 Jogo Sorteado!</h2>
                    <div class="vencedor-card">
                        <img src="<?= htmlspecialchars($jogo_sorteado['Imagens_jogos']) ?>" class="vencedor-capa">
                        <h2 class="vencedor-titulo"><?= htmlspecialchars($jogo_sorteado['titulo']) ?></h2>

                        <a href="../tela_jogo/index_jogo.php?id=<?= $jogo_sorteado['id_play'] ?>" class="btn-go-game">
                            Ir para tela do Jogo
                        </a>

                        <?php if (stripos($jogo_sorteado['titulo'], 'doom') !== false): ?>
                            <div class="desktop-only">
                                <button class="btn-doom" onclick="document.getElementById('doom-frame').style.display='block';">
                                    🕹️ Jogar Clássico Web?
                                </button>
                                <div id="doom-frame" class="doom-container">
                                    <iframe src="https://archive.org/embed/DoomsharewareEpisode" width="100%" height="400"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("user-menu");
            if (menu) menu.style.display = menu.style.display === "flex" ? "none" : "flex";
        }
        document.addEventListener("click", function (e) {
            const userBox = document.querySelector(".user-box");
            const menu = document.getElementById("user-menu");
            if (userBox && menu && !userBox.contains(e.target)) {
                menu.style.display = "none";
            }
        });
    </script>

    <?php include '../header_footer_global/footer.php'; ?>

    <script src="script.js"></script>
    <script>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $jogo_sorteado): ?>
            document.getElementById('form-sorteio').style.display = 'none';
            document.getElementById('resultado-final').style.display = 'none';
            document.getElementById('roleta-container').style.display = 'block';

            setTimeout(() => {
                document.getElementById('roleta-container').style.display = 'none';
                document.getElementById('resultado-final').style.display = 'block';
            }, 2200);
        <?php endif; ?>
    </script>
</body>

</html>