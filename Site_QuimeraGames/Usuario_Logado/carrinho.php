<?php
session_start();
require_once '../conexa.php';

// 1. Definições básicas
$logado = isset($_SESSION['usuario_nome']);
$id_user = $_SESSION['id_user'] ?? 0;
$email_user = $_SESSION['usuario_email'] ?? '';

<<<<<<< HEAD
$usuario = [];

if ($id_user > 0) {
    $stmt_user = $pdo->prepare("SELECT url_foto FROM cadastro WHERE id_user = ?");
    $stmt_user->execute([$id_user]);
    $usuario = $stmt_user->fetch(PDO::FETCH_ASSOC) ?? [];
}

// CONTAGEM PARA OS BADGES
=======
// 2. Inicializa variáveis
>>>>>>> 535cc67a270ac6aeb994a59032734eea96fabf79
$qtd_carrinho = 0;
$qtd_wishlist = 0;
$usuario = ['url_foto' => '']; // Valor inicial vazio

if ($logado && $id_user > 0) {
    // BUSCA FOTO DO USUÁRIO (Corrigindo o erro de troca de imagem)
    $stmt_u = $pdo->prepare("SELECT url_foto FROM cadastro WHERE email = ?");
    $stmt_u->execute([$email_user]);
    $usuario = $stmt_u->fetch(PDO::FETCH_ASSOC);

    // CONTAGEM PARA BADGES
    $stmt_c = $pdo->prepare("SELECT COUNT(*) FROM carrinho WHERE id_usuario = ?");
    $stmt_c->execute([$id_user]);
    $qtd_carrinho = $stmt_c->fetchColumn();

    $stmt_w = $pdo->prepare("SELECT COUNT(*) FROM lista_desejos WHERE id_user = ?");
    $stmt_w->execute([$id_user]);
    $qtd_wishlist = $stmt_w->fetchColumn();
}

// 3. Lógica específica da página (Lista itens do carrinho)
$query = "SELECT j.* FROM jogos j INNER JOIN carrinho c ON j.id_play = c.id_play WHERE c.id_usuario = :u";
$stmt = $pdo->prepare($query);
$stmt->execute(['u' => $id_user]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
$link_home = $logado ? 'usuariologado.php' : '../Index/index.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho - QuimeraGames</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="wishlist_carrinho.css">
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
</head>

<body>

    <header>
        <?php include '../header_footer_global/header.php'; ?>

<<<<<<< HEAD
        <div class="topo-direita">
            <?php if ($logado): ?>
                <div style="position: relative; display: inline-block;">
                    <button type="button" class="btn-icon" onclick="window.location.href='carrinho.php'">🛒</button>
                    <?php if (isset($qtd_carrinho) && $qtd_carrinho > 0): ?>
                        <span class="badge-bolinha"
                            style="position: absolute; top: -8px; right: -12px; pointer-events: none;"><?php echo $qtd_carrinho; ?></span>
                    <?php endif; ?>
                </div>

                <div class="user-box" onclick="toggleMenu()">
                    <img src="<?php echo !empty($usuario['url_foto']) 
                        ? '../uploads/' . $usuario['url_foto'] . '?v=' . time()
                         : '../imagens/aidento.jpg'; ?>" 
                    class="user-img" alt="Avatar">

                    <span class="user-nome"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>

                    <div id="user-menu" class="user-menu">
                        <a href="../Conta/conta.php">Conta</a>
                        <a href="../Pagamento/pagamento.php">Pagamento</a>
                        <a href="../Usuario_Logado/wishlist.php">
                            Lista de desejo
                            <?php if (isset($qtd_wishlist) && $qtd_wishlist > 0): ?>
                                <span class="badge-bolinha"><?php echo $qtd_wishlist; ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="../Usuario_Logado/meus_pedidos.php">Meus Pedidos</a>
                        <a href="../Usuario_Logado/logout.php">Sair</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="../Entrar/Entrar.php" style="text-decoration: none;"><button class="btn-login">Entrar</button></a>
            <?php endif; ?>
            <a href="../Sac/Suporte.php" style="text-decoration: none;"><button class="btn-login">Suporte</button></a>
        </div>
=======
>>>>>>> 535cc67a270ac6aeb994a59032734eea96fabf79
    </header>

    <div class="cart-layout">
        <div class="cart-list">
            <h2>Meu Carrinho</h2>
            <?php if (empty($itens)): ?>
                <div class="empty-state">
                    <span class="sad-icon">☹️</span>
                    <h3>Seu carrinho ainda não possui nenhum jogo</h3>
                    <a href="usuariologado.php" class="btn-red">Comprar jogos</a>
                </div>
            <?php else: ?>
                <?php foreach ($itens as $j):
                    $total += $j['Valor']; ?>
                    <div class="cart-item">
                        <img class="capa" src="<?= htmlspecialchars($j['Imagens_jogos']) ?>">
                        <div class="cart-info">
                            <h3><?= htmlspecialchars($j['titulo']) ?></h3>
                            <small>R$ <?= number_format($j['Valor'], 2, ',', '.') ?></small>
                        </div>
                        <a href="acoes_cliente.php?id=<?= $j['id_play'] ?>&acao=del_carrinho" class="remover-link">Remover</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($itens)):
            $id_checkout = $itens[0]['id_play']; ?>
            <div class="cart-summary">
                <h3>Resumo de jogos</h3>
                <div class="summary-row"><span>Preço</span> <span>R$ <?= number_format($total, 2, ',', '.') ?></span></div>
                <hr style="opacity: 0.1; margin: 20px 0;">
                <div class="summary-row" style="font-weight: bold; font-size: 19px;"><span>Subtotal</span> <span>R$
                        <?= number_format($total, 2, ',', '.') ?></span></div>
                <button class="btn-checkout"
                    onclick="window.location.href='../Pagamento/pagamento.php?id_jogo=<?= $id_checkout ?>&preco=<?= $total ?>'">Finalizar
                    compra</button>
            </div>
        <?php endif; ?>
    </div>

    <?php include '../header_footer_global/footer.php'; ?>
    <script src="../Usuario_Logado/script.js" defer></script>
</body>

</html>