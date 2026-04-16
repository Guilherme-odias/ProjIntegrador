<?php
session_start();
require_once '../conexa.php';

$id_user = $_SESSION['id_user'] ?? 0;

// CONTAGEM PARA OS BADGES
$stmt_conta_cart = $pdo->prepare("SELECT COUNT(*) FROM carrinho WHERE id_usuario = ?");
$stmt_conta_cart->execute([$id_user]);
$qtd_carrinho = $stmt_conta_cart->fetchColumn();

$stmt_conta_wish = $pdo->prepare("SELECT COUNT(*) FROM lista_desejos WHERE id_user = ?");
$stmt_conta_wish->execute([$id_user]);
$qtd_wishlist = $stmt_conta_wish->fetchColumn();

// Busca os jogos que estão na lista de desejos desse usuário
$query = "SELECT j.* FROM jogos j 
          INNER JOIN lista_desejos ld ON j.id_play = ld.id_play 
          WHERE ld.id_user = :u";
$stmt = $pdo->prepare($query);
$stmt->execute(['u' => $id_user]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Minha Lista de Desejos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .main-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .empty-state {
            text-align: center;
            margin-top: 100px;
        }

        .sad-icon {
            font-size: 80px;
            display: block;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .btn-red {
            background: #c1121f;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }

        .wish-item {
            background: #13192b;
            display: flex;
            align-items: center;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            position: relative;
        }

        .wish-item img {
            width: 100px;
            height: 140px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 20px;
        }

        .wish-info h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .wish-price {
            margin-left: auto;
            font-size: 22px;
            font-weight: bold;
            margin-right: 40px;
        }

        .wish-actions {
            position: absolute;
            bottom: 15px;
            right: 20px;
            display: flex;
            gap: 20px;
        }

        .wish-actions a {
            color: #aaa;
            text-decoration: underline;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <header class="topo">
        <?php
        // Verifica se está logado e define o link da logo/loja
        $logado = isset($_SESSION['usuario_nome']);
        $link_home = $logado ? '../Usuario_Logado/usuariologado.php' : '../Index/index.php';
        ?>

        <div class="topo-esquerda">
            <a href="<?php echo $link_home; ?>">
                <img class="logo" src="../imagens/logo.png" alt="Logo">
            </a>
            <a href="<?php echo $link_home; ?>" style="text-decoration: none;">
                <button class="btn-nav active">Loja</button>
            </a>
        </div>

        <div class="topo-direita">
            <?php if ($logado): ?>
                <div style="position: relative; display: inline-block;">
                    <button type="button" class="btn-icon"
                        onclick="window.location.href='../Usuario_Logado/carrinho.php'">🛒</button>
                    <?php if (isset($qtd_carrinho) && $qtd_carrinho > 0): ?>
                        <span
                            style="position: absolute; top: -5px; right: -8px; background: #e62429; color: white; border-radius: 50%; padding: 2px 7px; font-size: 11px; font-weight: bold; pointer-events: none;">
                            <?php echo $qtd_carrinho; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="user-box" onclick="toggleMenu()">
                    <img src="../imagens/aidento.jpg" class="user-img" alt="Avatar">
                    <span class="user-nome">
                        <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
                    </span>

                    <div id="user-menu" class="user-menu">
                        <a href="../Conta/conta.php">Conta</a>
                        <a href="../Pagamento/pagamento.php">Pagamento</a>
                        <a href="../Usuario_Logado/wishlist.php"
                            style="display:flex; justify-content: space-between; align-items: center; padding:10px;">
                            Lista de desejo
                            <?php if (isset($qtd_wishlist) && $qtd_wishlist > 0): ?>
                                <span
                                    style="background: #e62429; color: white; border-radius: 50%; padding: 2px 7px; font-size: 11px; font-weight: bold; margin-left: 10px;">
                                    <?php echo $qtd_wishlist; ?>
                                </span>
                            <?php endif; ?>
                        </a>
                        <a href="../Usuario_Logado/logout.php">Sair</a>
                    </div>
                </div>

            <?php else: ?>
                <a href="../Entrar/Entrar.php" style="text-decoration: none;">
                    <button class="btn-login">Entrar</button>
                </a>
            <?php endif; ?>

            <a href="../Sac/Suporte.php" style="text-decoration: none;">
                <button class="btn-login">Suporte</button>
            </a>
        </div>
    </header>

    <div class="main-container">
        <h2>Minha lista de desejo</h2><br>

        <?php if (empty($itens)): ?>
            <div class="empty-state">
                <span class="sad-icon">☹️</span>
                <h3>Você ainda não adicionou nada na sua lista de desejo</h3>
                <a href="usuariologado.php" class="btn-red">Comprar jogos</a>
            </div>
        <?php else: ?>
            <?php foreach ($itens as $j): ?>
                <div class="wish-item">
                    <img src="<?= $j['Imagens_jogos'] ?>">
                    <div class="wish-info">
                        <small style="color: #888;">Chave de ativação</small>
                        <h3><?= $j['titulo'] ?></h3>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" width="18">
                    </div>
                    <div class="wish-price">R$ <?= number_format($j['Valor'], 2, ',', '.') ?></div>
                    <div class="wish-actions">
                        <a href="acoes_cliente.php?id=<?= $j['id_play'] ?>&acao=del_wishlist">Remover</a>
                        <a href="acoes_cliente.php?id=<?= $j['id_play'] ?>&acao=add_carrinho">Visualizar no carrinho</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>