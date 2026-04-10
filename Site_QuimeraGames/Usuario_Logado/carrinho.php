<?php
session_start();
require_once '../conexa.php';

$id_user = $_SESSION['id_user'] ?? 0;

$query = "SELECT j.* FROM jogos j 
          INNER JOIN carrinho c ON j.id_play = c.id_play 
          WHERE c.id_usuario = :u";
$stmt = $pdo->prepare($query);
$stmt->execute(['u' => $id_user]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cart-layout { display: flex; gap: 30px; max-width: 1200px; margin: 50px auto; padding: 0 20px; }
        .cart-list { flex: 2; }
        .cart-summary { flex: 1; background: #13192b; padding: 25px; border-radius: 10px; height: fit-content; }
        .cart-item { background: #13192b; display: flex; padding: 15px; border-radius: 10px; margin-bottom: 15px; align-items: center; position: relative; }
        .cart-item img { width: 80px; margin-right: 15px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .btn-checkout { width: 100%; background: #c1121f; border: none; color: white; padding: 15px; border-radius: 5px; font-weight: bold; cursor: pointer; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="cart-layout">
        <div class="cart-list">
            <h2>Meu Carrinho</h2><br>
            <?php if (empty($itens)): ?>
                <div style="text-align: center; margin-top: 50px;">
                    <span style="font-size: 80px; opacity: 0.5;">☹️</span>
                    <h3>Seu carrinho ainda não possui nenhum jogo</h3>
                    <a href="usuariologado.php" class="btn-red">Comprar jogos</a>
                </div>
            <?php else: ?>
                <?php foreach ($itens as $j): $total += $j['Valor']; ?>
                    <div class="cart-item">
                        <img src="<?= $j['Imagens_jogos'] ?>">
                        <div>
                            <h3><?= $j['titulo'] ?></h3>
                            <small>R$ <?= number_format($j['Valor'], 2, ',', '.') ?></small>
                        </div>
                        <div style="margin-left: auto;">
                            <a href="acoes_cliente.php?id=<?= $j['id_play'] ?>&acao=del_carrinho" style="color: #888;">Remover</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($itens)): ?>
        <div class="cart-summary">
            <h3>Resumo de jogos</h3><br>
            <div class="summary-row"><span>Preço</span> <span>R$ <?= number_format($total, 2, ',', '.') ?></span></div>
            <hr style="opacity: 0.1; margin-bottom: 15px;">
            <div class="summary-row" style="font-weight: bold;"><span>Subtotal</span> <span>R$ <?= number_format($total, 2, ',', '.') ?></span></div>
            <button class="btn-checkout">Finalizar compra</button>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>