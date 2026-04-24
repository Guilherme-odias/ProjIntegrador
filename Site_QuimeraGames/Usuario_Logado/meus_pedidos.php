<?php
session_start();
require_once '../conexa.php';

// Proteção: Redireciona se não estiver logado
if (!isset($_SESSION['id_user'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$logado = true; // Necessário para o header funcionar

// Consulta exata na sua tabela
$query = "SELECT j.* FROM jogos j 
          INNER JOIN minha_biblioteca mb ON j.id_play = mb.id_play 
          WHERE mb.id_user = :u";
$stmt = $pdo->prepare($query);
$stmt->execute(['u' => $id_user]);
$biblioteca = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="wishlist_carrinho.css"> 
    <link rel="stylesheet" href="wishlist_carrinho.css">
</head>

<body>
    <?php include '../includes/header_index.php'; ?>

    <main class="container" style="margin-top: 100px;">
        <h2>Minha Biblioteca</h2>
        <div class="lista-pedidos">
            <?php foreach ($biblioteca as $p): ?>
                <div class="pedido-card">
                    <img src="<?= htmlspecialchars($p['Imagens_jogos']) ?>" class="capa-jogo">
                    <div class="info-jogo">
                        <h3><?= htmlspecialchars($p['titulo']) ?></h3>
                        <a href="https://store.steampowered.com/" target="_blank" class="btn-resgatar">Resgatar Código</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>

</html>