<?php
require_once '../conexa.php';

// Pega o ID da URL
$id_jogo = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id_jogo === 0) {
    die("<h2 style='color:white; text-align:center; margin-top:50px;'>Jogo não encontrado. Volte para a loja.</h2>");
}

try {
    // Busca as informações do jogo E cruza com a tabela de categorias para pegar o nome
    $query = "SELECT j.*, c.tipo_categoria 
              FROM jogos j 
              LEFT JOIN categorias c ON j.id_categoria = c.id_categoria 
              WHERE j.id_play = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id_jogo, PDO::PARAM_INT);
    $stmt->execute();
    $jogo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$jogo) {
        die("<h2 style='color:white; text-align:center; margin-top:50px;'>Jogo não encontrado no banco de dados.</h2>");
    }

    // Tratamento para transformar o link do Drive em link de Embed (Iframe)
    $trailer_url = $jogo['Trailers'];
    if (strpos($trailer_url, 'drive.google.com/file/d/') !== false) {
        // Troca o /view por /preview para funcionar no iframe
        $trailer_url = preg_replace('/\/view.*$/', '/preview', $trailer_url);
    }

    // Lógica simples de desconto (Ajuste se precisar integrar com a lógica semanal)
    $valor_original = $jogo['Valor'];
    $tem_desconto = false;
    $valor_venda = $valor_original;

    // Se quiser aplicar 10% de desconto fictício para testar o visual, descomente as linhas abaixo:
    // $tem_desconto = true;
    // $valor_venda = $valor_original * 0.90;

} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($jogo['titulo']); ?> - QuimeraGames</title>
    <link rel="stylesheet" href="../Css/stylles.css">

    <link rel="stylesheet" href="../Css/styles.css">
</head>

<body>

    <header class="topo">
        <div class="topo-esquerda">
            <a href="index.php">
                <img class="logo" src="../imagens/logo.png" alt="Logo">
            </a>
            <a href="index.php" style="text-decoration: none;">
                <button class="btn-nav active">Loja</button>
            </a>
        </div>
        <div class="topo-direita">
            <a href="../Entrar/Entrar.php" style="text-decoration: none;">
                <button class="btn-login">Entrar</button>
            </a>
            <a href="../Sac/Suporte.php" style="text-decoration: none;">
                <button class="btn-login">Suporte</button>
            </a>
        </div>
    </header>

    <div class="container game-page-container">

        <div class="game-layout">
            <div class="game-left-col">

                <div class="main-media">
                    <?php if (!empty($trailer_url)): ?>
                        <iframe src="<?php echo htmlspecialchars($trailer_url); ?>" width="100%" height="100%"
                            frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                    <?php else: ?>
                        <img src="<?php echo htmlspecialchars($jogo['Imagens_jogos']); ?>"
                            style="width:100%; height:100%; object-fit:cover;">
                    <?php endif; ?>
                </div>

                <div class="media-thumbnails">
                    <img src="<?php echo htmlspecialchars($jogo['Imagens_jogos']); ?>" alt="Capa">
                    <img src="<?php echo htmlspecialchars($jogo['Imagens_cen1']); ?>" alt="Cenário 1">
                    <img src="<?php echo htmlspecialchars($jogo['Imagens_cen2']); ?>" alt="Cenário 2">
                </div>

                <div class="game-description">
                    <h1 class="game-page-title"><?php echo htmlspecialchars($jogo['titulo']); ?></h1>
                    <p><?php echo nl2br(htmlspecialchars($jogo['informacoes'])); ?></p>
                </div>

                <div class="game-rating">
                    <h3>Nota dos compradores da QuimeraGames</h3>
                    <p class="rating-sub">Fornecidas por compradores no ecossistema Quimera</p>
                    <div class="stars-container">
                        <span class="nota-numero">4.0</span>
                        <div class="happy-stars">
                            <span class="star-icon active">★</span>
                            <span class="star-icon active">★</span>
                            <span class="star-icon active">★</span>
                            <span class="star-icon active">★</span>
                            <span class="star-icon inactive">★</span>
                        </div>
                    </div>
                </div>

                <div class="system-requirements">
                    <h3>Requisitos de sistema</h3>
                    <div class="req-box">
                        <div class="req-icon"><img
                                src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg"
                                width="24"> Windows</div>
                        <div class="req-text-block">
                            <p><?php echo nl2br(htmlspecialchars($jogo['req_sistema'])); ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="game-right-col">

                <img src="<?php echo htmlspecialchars($jogo['Imagens_jogos']); ?>" class="side-cover" alt="Capa">

                <div class="buy-panel">
                    <div class="price-box">
                        <?php if ($valor_original > 0): ?>
                            <?php if ($tem_desconto): ?>
                                <span class="badge-desconto-side">-10%</span>
                                <div class="price-values">
                                    <span class="v-old-side">R$
                                        <?php echo number_format($valor_original, 2, ',', '.'); ?></span>
                                    <span class="v-new-side">R$ <?php echo number_format($valor_venda, 2, ',', '.'); ?></span>
                                </div>
                            <?php else: ?>
                                <span class="v-new-side">R$ <?php echo number_format($valor_original, 2, ',', '.'); ?></span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="v-new-side">Gratuito</span>
                        <?php endif; ?>
                    </div>

                    <button class="btn-action btn-buy">Comprar</button>
                    <button class="btn-action btn-cart">Carrinho</button>
                    <button class="btn-action btn-wishlist">Lista de desejo</button>
                    <button class="btn-action btn-steam">Ativar na Steam</button>
                    <p class="steam-aviso">Este produto é ativado via <strong>chave de ativação</strong></p>
                </div>

                <div class="info-table">
                    <div class="info-row"><span>Distribuidora:</span>
                        <span><?php echo htmlspecialchars($jogo['distribuidora']); ?></span></div>
                    <div class="info-row"><span>Desenvolvedora:</span>
                        <span><?php echo htmlspecialchars($jogo['desenvolvedora']); ?></span></div>
                    <div class="info-row"><span>Lançamento:</span>
                        <span><?php echo date('d/m/Y', strtotime($jogo['data_lancamento'])); ?></span></div>
                    <div class="info-row"><span>Categoria:</span>
                        <span><?php echo htmlspecialchars($jogo['tipo_categoria']); ?></span></div>
                </div>

            </div>
        </div>
    </div>

    <footer class="rodape">QuimeraGames &copy; 2026</footer>
</body>

</html>