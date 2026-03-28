<?php
require_once '../conexa.php';

$termo = isset($_GET['query']) ? $_GET['query'] : '';

if (!empty($termo)) {
    $stmt = $pdo->prepare("SELECT * FROM jogos WHERE titulo LIKE :termo LIMIT 12");
    $stmt->bindValue(':termo', '%' . $termo . '%', PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultados) > 0) {
        echo '<div class="jogos-grid">'; // Reaproveitando sua classe de grid
        foreach ($resultados as $jogo) {
            ?>
            <div class="card-jogo-container">
                <div class="thumb-wrapper">
                    <img src="<?php echo htmlspecialchars($jogo['Imagens_jogos']); ?>">
                </div>
                <div class="card-info-texto">
                    <h4><?php echo htmlspecialchars($jogo['titulo']); ?></h4>
                    <div class="card-plataforma">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" width="16">
                        <span>Windows</span>
                    </div>
                    <div class="precos-card">
                        <?php if ($jogo['Valor'] > 0): ?>
                            <span class="v-new">R$ <?php echo number_format($jogo['Valor'], 2, ',', '.'); ?></span>
                        <?php else: ?>
                            <span class="v-gratis">Gratuito</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<div class="erro-busca"><h2>Jogo não encontrado 😢</h2></div>';
    }
}
?>