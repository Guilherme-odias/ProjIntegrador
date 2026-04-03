<?php
require_once '../conexa.php';

$id_categoria = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id_categoria === 0) {
    die("<h2 style='color:white; text-align:center; margin-top:50px; font-family:sans-serif;'>Categoria não especificada.</h2>");
}

try {
    // Busca Categoria
    $stmtCat = $pdo->prepare("SELECT * FROM categorias WHERE id_categoria = :id");
    $stmtCat->bindValue(':id', $id_categoria, PDO::PARAM_INT);
    $stmtCat->execute();
    $categoria = $stmtCat->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        die("<h2 style='color:white; text-align:center; margin-top:50px;'>Categoria não encontrada.</h2>");
    }

    // Busca Jogos da Categoria
    $stmtJogos = $pdo->prepare("SELECT * FROM jogos WHERE id_categoria = :id");
    $stmtJogos->bindValue(':id', $id_categoria, PDO::PARAM_INT);
    $stmtJogos->execute();
    $jogos = $stmtJogos->fetchAll(PDO::FETCH_ASSOC);

    // MÁGICA DOS DESCONTOS: Puxa a mesma regra da Home (Baseada na semana)
    $semana_atual = (int) date('W');
    $stmt_desc = $pdo->prepare("SELECT id_play FROM jogos ORDER BY MOD(id_play, :semana_plus) LIMIT 6");
    $stmt_desc->bindValue(':semana_plus', ($semana_atual + 2), PDO::PARAM_INT);
    $stmt_desc->execute();
    $ids_com_desconto = $stmt_desc->fetchAll(PDO::FETCH_COLUMN); // Guarda só os IDs sorteados

} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categoria['tipo_categoria']) ?> - QuimeraGames</title>
    <link rel="stylesheet" href="../Css/stylles.css">
    <link rel="stylesheet" href="../Css/Stylle.css">
</head>

<body>

    <header class="topo">
        <div class="topo-esquerda">
            <a href="../Index/index.php">
                <img class="logo" src="../imagens/logo.png" alt="Logo">
            </a>
            <a href="../Index/index.php" style="text-decoration: none;">
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

    <div class="container">
        <div class="menu-wrapper" style="position: relative; z-index: 1000; padding-top: 20px;">
            <nav class="menu-busca">
                <div class="busca-input">
                    <span>🔍</span>
                    <input type="text" placeholder="Pesquisar loja" disabled style="opacity: 0.5; cursor: not-allowed;"
                        title="Use o filtro lateral nesta página">
                </div>
                <button class="btn-dropdown" id="btn-explorar"
                    onclick="window.location.href='../Index/index.php'">Explorar ▾</button>
                <button class="btn-dropdown" id="btn-categorias"
                    onclick="window.location.href='../Index/index.php'">Categorias ▾</button>
            </nav>
        </div>

        <div class="categoria-container">
            <div class="conteudo-jogos">
                <div class="categoria-cabecalho">
                    <h1><?= htmlspecialchars($categoria['tipo_categoria']) ?></h1>
                    <p>A Quimera Games oferece alguns dos melhores jogos de
                        <?= strtolower(htmlspecialchars($categoria['tipo_categoria'])) ?>. Baixe hoje e comece a jogar
                        jogos divertidos e empolgantes.
                    </p>
                </div>

                <div class="jogos-grid" id="lista-jogos">
                    <?php if (count($jogos) > 0): ?>
                        <?php foreach ($jogos as $jogo):
                            $valor_original = (float) $jogo['Valor'];

                            // Verifica se o ID do jogo está na lista dos sorteados da semana
                            $tem_desconto = in_array($jogo['id_play'], $ids_com_desconto);
                            $valor_venda = $tem_desconto ? ($valor_original * 0.90) : $valor_original;

                            // Variáveis para os filtros do JavaScript
                            $is_gratis = ($valor_venda == 0) ? 'true' : 'false';
                            $is_ate50 = ($valor_venda > 0 && $valor_venda <= 50) ? 'true' : 'false';
                            $has_desconto = $tem_desconto ? 'true' : 'false';
                            ?>

                            <a href="../Tela_Jogo/index_jogo.php?id=<?= $jogo['id_play'] ?><?= $tem_desconto ? '&desconto=1' : '' ?>"
                                class="jogo-card" data-titulo="<?= strtolower(htmlspecialchars($jogo['titulo'])) ?>"
                                data-gratis="<?= $is_gratis ?>" data-ate50="<?= $is_ate50 ?>"
                                data-desconto="<?= $has_desconto ?>">

                                <div class="thumb-wrapper">
                                    <img src="<?= htmlspecialchars($jogo['Imagens_jogos']) ?>" alt="Capa do Jogo">
                                    <?php if ($tem_desconto && $valor_original > 0): ?>
                                        <span class="badge-desconto">-10%</span>
                                    <?php endif; ?>
                                </div>

                                <div class="card-info-texto">
                                    <h4 class="jogo-titulo"><?= htmlspecialchars($jogo['titulo']) ?></h4>
                                    <div class="jogo-preco-area">
                                        <?php if ($valor_original > 0): ?>
                                            <?php if ($tem_desconto): ?>
                                                <span class="preco-antigo">R$ <?= number_format($valor_original, 2, ',', '.') ?></span>
                                                <span class="preco-novo">R$ <?= number_format($valor_venda, 2, ',', '.') ?></span>
                                            <?php else: ?>
                                                <span class="preco-novo">R$ <?= number_format($valor_original, 2, ',', '.') ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="preco-novo gratis">Gratuito</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #aaa; padding: 20px 0;">Nenhum jogo encontrado nesta categoria no momento.</p>
                    <?php endif; ?>
                </div>
            </div>

            <aside class="barra-filtros">
                <h3>Filtros</h3>
                <div class="filtro-busca">
                    <span>🔍</span>
                    <input type="text" id="input-filtro-nome" placeholder="Palavra-chave">
                </div>

                <div class="filtro-grupo">
                    <button class="btn-filtro-toggle">Preço <span class="seta">v</span></button>
                    <div class="filtro-conteudo ativo">
                        <label><input type="checkbox" id="chk-gratis" class="filtro-checkbox"> <span
                                class="checkbox-custom"></span> Gratuitos</label>
                        <label><input type="checkbox" id="chk-ate50" class="filtro-checkbox"> <span
                                class="checkbox-custom"></span> Até R$ 50,00</label>
                        <label><input type="checkbox" id="chk-desconto" class="filtro-checkbox"> <span
                                class="checkbox-custom"></span> Com Desconto</label>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <footer class="rodape" style="text-align:center; padding:20px; background:#11152b; color:white; margin-top:40px;">
        QuimeraGames &copy; 2026
    </footer>

    <script src="script_categorias.js"></script>
</body>

</html>