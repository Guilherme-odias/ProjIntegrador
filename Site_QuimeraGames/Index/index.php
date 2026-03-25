<?php
require_once '../conexa.php';

if (!isset($pdo)) {
  die("Erro: A variável de conexão \$pdo não foi encontrada no conexa.php.");
}

try {
  $semana_atual = (int) date('W');

  $stmt_carousel = $pdo->prepare("SELECT * FROM jogos ORDER BY MOD(id_play, :semana) LIMIT 7");
  $stmt_carousel->bindValue(':semana', $semana_atual, PDO::PARAM_INT);
  $stmt_carousel->execute();
  $jogos_carousel = $stmt_carousel->fetchAll(PDO::FETCH_ASSOC);

  $stmt_descontos = $pdo->prepare("SELECT * FROM jogos ORDER BY MOD(id_play, :semana_plus) LIMIT 6");
  $stmt_descontos->bindValue(':semana_plus', ($semana_atual + 2), PDO::PARAM_INT);
  $stmt_descontos->execute();
  $jogos_descontos = $stmt_descontos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  die("Erro na consulta ao banco de dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuimeraGames</title>
  <link rel="stylesheet" href="../Css/stylles.css">
</head>

<body>

  <header class="topo">
    <div class="topo-esquerda">
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Index/index.php">
        <img class="logo" src="../imagens/logo.png" alt="Logo">
      </a>
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Index/index.php"
        style="text-decoration: none;">
        <button class="btn-nav active">Loja</button>
      </a>
    </div>
    <div class="topo-direita">
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Entrar/Entrar.php"
        style="text-decoration: none;">
        <button class="btn-login">Entrar</button>
      </a>
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Sac/Suporte.php"
        style="text-decoration: none;">
        <button class="btn-login">Suporte</button>
      </a>
    </div>
  </header>

  <div class="container">
    <nav class="menu-busca">
      <div class="busca-input">
        <span>🔍</span>
        <input type="text" placeholder="Pesquisar loja">
      </div>
      <button class="btn-dropdown">Explorar ▾</button>
      <button class="btn-dropdown">Categorias ▾</button>
    </nav>

    <div class="carousel-container">
      <?php foreach ($jogos_carousel as $i => $radio): ?>
        <input type="radio" name="slide" id="s<?php echo $i + 1; ?>" <?php echo ($i == 0) ? 'checked' : ''; ?>>
      <?php endforeach; ?>

      <div class="slides">
        <?php foreach ($jogos_carousel as $i => $jogo): ?>
          <div class="slide" id="slide<?php echo $i + 1; ?>">
            <div class="content-box">
              <div class="poster-box">
                <img src="<?php echo htmlspecialchars($jogo['Imagens_jogos']); ?>" id="mainImg<?php echo $i + 1; ?>"
                  data-capa="<?php echo $jogo['Imagens_jogos']; ?>" class="capa-poster">
              </div>

              <div class="info-box" id="infoBox<?php echo $i + 1; ?>">
                <span class="label-disponivel">JÁ DISPONÍVEL</span>
                <h2 class="titulo-jogo"><?php echo htmlspecialchars($jogo['titulo']); ?></h2>
                <p class="descricao-jogo"><?php echo mb_strimwidth($jogo['informacoes'], 0, 180, "..."); ?></p>

                <div class="precos-container">
                  <?php if ($jogo['Valor'] > 0): ?>
                    <span class="badge-desconto">-10%</span>
                    <div class="col-precos">
                      <span class="v-antigo">R$ <?php echo number_format($jogo['Valor'], 2, ',', '.'); ?></span>
                      <span class="v-novo">R$ <?php echo number_format($jogo['Valor'] * 0.90, 2, ',', '.'); ?></span>
                    </div>
                  <?php else: ?>
                    <span class="v-gratis">Gratuito</span>
                  <?php endif; ?>
                </div>
                <button class="btn-comprar-carrossel">COMPRAR AGORA</button>
              </div>
            </div>

            <div class="side-box">
              <img src="<?php echo htmlspecialchars($jogo['Imagens_cen1']); ?>"
                onclick="gerenciarTroca('<?php echo $i + 1; ?>', this)">
              <img src="<?php echo htmlspecialchars($jogo['Imagens_cen2']); ?>"
                onclick="gerenciarTroca('<?php echo $i + 1; ?>', this)">
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="dots">
        <?php foreach ($jogos_carousel as $i => $dot): ?>
          <label for="s<?php echo $i + 1; ?>"></label>
        <?php endforeach; ?>
      </div>
    </div>

    <section class="secao">
      <h2>Descontos em destaque ></h2>
      <div class="jogos-grid">
        <?php foreach ($jogos_descontos as $jogo): ?>
          <div class="card-jogo-container">
            <div class="thumb-wrapper">
              <img src="<?php echo htmlspecialchars($jogo['Imagens_jogos']); ?>">
              <?php if ($jogo['Valor'] > 0): ?>
                <span class="badge-desconto">-10%</span>
              <?php endif; ?>
            </div>
            <div class="card-info-texto">
              <h4><?php echo htmlspecialchars($jogo['titulo']); ?></h4>
              <div class="card-plataforma">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" width="16">
                <span>Windows</span>
              </div>
              <div class="precos-card">
                <?php if ($jogo['Valor'] > 0): ?>
                  <span class="v-old">R$ <?php echo number_format($jogo['Valor'], 2, ',', '.'); ?></span>
                  <span class="v-new">R$ <?php echo number_format($jogo['Valor'] * 0.90, 2, ',', '.'); ?></span>
                <?php else: ?>
                  <span class="v-gratis">Gratuito</span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </div>

  <footer class="rodape">QuimeraGames &copy; 2026</footer>

  <script>
    function gerenciarTroca(index, elementoMin) {
      const slideContainer = document.getElementById('slide' + index);
      const imgPrincipal = document.getElementById('mainImg' + index);
      const infoBox = document.getElementById('infoBox' + index);
      const urlCapaOriginal = imgPrincipal.getAttribute('data-capa');

      const urlTemporaria = imgPrincipal.src;
      imgPrincipal.src = elementoMin.src;
      elementoMin.src = urlTemporaria;

      if (imgPrincipal.src === urlCapaOriginal) {
        slideContainer.classList.remove('cenario-ativo');
        infoBox.style.opacity = "1";
        infoBox.style.visibility = "visible";
      } else {
        slideContainer.classList.add('cenario-ativo');
        infoBox.style.opacity = "0";
        infoBox.style.visibility = "hidden";
      }
    }

    let currentSlide = 1;
    setInterval(() => {
      currentSlide++;
      if (currentSlide > 7) currentSlide = 1;
      const radio = document.getElementById('s' + currentSlide);
      if (radio) radio.checked = true;
    }, 7000);
  </script>
</body>

</html>