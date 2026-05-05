<header class="topo-universal">

  <!-- ESQUERDA: Logo + Nav -->
  <div class="topo-esquerda">
    <a href="<?php echo $link_home; ?>">
      <img class="logo" src="../imagens/logo.png" alt="Logo">
    </a>
    <a href="<?php echo $link_home; ?>" style="text-decoration: none;">
      <button class="btn-nav active">Loja</button>
    </a>
  </div>

  <!-- DIREITA: Ações do usuário -->
  <div class="topo-direita">

    <?php if ($logado): ?>

      <!-- Carrinho -->
      <div style="position: relative; display: inline-block;">
        <button type="button" class="btn-icon" onclick="window.location.href='../Usuario_Logado/carrinho.php'">🛒</button>
        <?php if (isset($qtd_carrinho) && $qtd_carrinho > 0): ?>
          <span class="badge-bolinha"
            style="position: absolute; top: -8px; right: -12px; pointer-events: none;">
            <?php echo $qtd_carrinho; ?>
          </span>
        <?php endif; ?>
      </div>

      <!-- Coins -->
      <?php
        $saldo_header = 0;
        if (isset($_SESSION['id_user'])) {
          $stmt_h = $pdo->prepare("SELECT coins FROM cadastro WHERE id_user = ?");
          $stmt_h->execute([$_SESSION['id_user']]);
          $saldo_header = (int) $stmt_h->fetchColumn();
        }
      ?>
      <?php if (isset($_SESSION['id_user'])): ?>
        <div class="coin-tooltip-container">
          <div class="coin-container" id="box-coins">
            <span class="coin-icon">🪙</span>
            <span id="coin-counter"><?php echo $saldo_header; ?></span>
          </div>
          <div class="coin-tooltip">
            <strong>Como funcionam as Moedas?</strong><br><br>
            🪙 A cada <strong>R$ 1,00</strong> gasto, você ganha <strong>1 Coin</strong>.<br>
            💰 Cada <strong>1 Coin</strong> equivale a <strong>R$ 0,01</strong> de desconto na sua próxima compra!<br>
            <em>(Fique de olho nos mascotes pela loja para ganhar moedas grátis!)</em>
          </div>
        </div>
      <?php endif; ?>

      <!-- User Box -->
      <div class="user-box" onclick="toggleMenu()">
        <img src="<?php echo !empty($usuario['url_foto'])
          ? '../uploads/' . $usuario['url_foto'] . '?v=' . time()
          : '../imagens/aidento.jpg'; ?>" class="user-img" alt="Avatar">
        <span class="user-nome"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>
        <div id="user-menu" class="user-menu">
          <a href="../Conta/conta.php">Conta</a>
          <a href="../Pagamento/pagamento.php">Pagamento</a>
          <a href="../Usuario_Logado/wishlist.php">
            Lista de desejo
            <?php if ($qtd_wishlist > 0): ?>
              <span class="badge-bolinha"><?php echo $qtd_wishlist; ?></span>
            <?php endif; ?>
          </a>
          <a href="../Usuario_Logado/meus_pedidos.php">Meus Pedidos</a>
          <a href="../Usuario_Logado/logout.php">Sair</a>
        </div>
      </div>

    <?php else: ?>
      <a href="../Entrar/Entrar.php" style="text-decoration: none;">
        <button class="btn-login">Entrar</button>
      </a>
    <?php endif; ?>

    <a href="../Sac/Suporte.php" style="text-decoration: none;">
      <button class="btn-login btn-suporte">Suporte</button>
    </a>

    <!-- Hamburguer (só aparece quando não cabe) -->
    <button class="btn-hamburger" id="btn-hamburger" aria-label="Menu">
      <span></span>
      <span></span>
      <span></span>
    </button>

  </div><!-- fim topo-direita -->

  <!-- Menu Mobile (drawer) -->
  <nav class="nav-mobile" id="nav-mobile">
    <a href="<?php echo $link_home; ?>" class="btn-nav active">Loja</a>
    <?php if ($logado): ?>
      <a href="../Usuario_Logado/carrinho.php" class="btn-nav">🛒 Carrinho
        <?php if (isset($qtd_carrinho) && $qtd_carrinho > 0): ?>
          (<?php echo $qtd_carrinho; ?>)
        <?php endif; ?>
      </a>
      <a href="../Conta/conta.php" class="btn-nav">Conta</a>
      <a href="../Pagamento/pagamento.php" class="btn-nav">Pagamento</a>
      <a href="../Usuario_Logado/wishlist.php" class="btn-nav">Lista de desejo</a>
      <a href="../Usuario_Logado/meus_pedidos.php" class="btn-nav">Meus Pedidos</a>
      <a href="../Sac/Suporte.php" class="btn-nav">Suporte</a>
      <a href="../Usuario_Logado/logout.php" class="btn-nav" style="color: #e62429;">Sair</a>
    <?php else: ?>
      <a href="../Entrar/Entrar.php" class="btn-login">Entrar</a>
      <a href="../Sac/Suporte.php" class="btn-nav">Suporte</a>
    <?php endif; ?>
  </nav>

</header>

<script>
// Hamburguer — abre/fecha menu mobile
(function () {
  var btn = document.getElementById('btn-hamburger');
  var nav = document.getElementById('nav-mobile');
  if (!btn || !nav) return;

  btn.addEventListener('click', function () {
    btn.classList.toggle('aberto');
    nav.classList.toggle('aberto');
  });

  // Fecha ao clicar em qualquer link do menu mobile
  nav.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      btn.classList.remove('aberto');
      nav.classList.remove('aberto');
    });
  });

  // ResizeObserver: mostra/esconde hamburguer conforme espaço disponível
  var topo      = document.querySelector('.topo-universal');
  var esquerda  = document.querySelector('.topo-esquerda');
  var direita   = document.querySelector('.topo-direita');

  function checarEspaco() {
    if (!topo || !esquerda) return;

    // Largura total disponível
    var topoW     = topo.offsetWidth;
    // Soma do conteúdo visível (exceto o hamburguer para não contar ele mesmo)
    var ocupado   = esquerda.offsetWidth + direita.offsetWidth;
    var apertado  = ocupado >= topoW - 24; // 24px de folga mínima

    // Esconde nav links do desktop e mostra hamburguer
    esquerda.style.display = apertado ? 'none' : '';
    btn.style.display      = apertado ? 'flex' : 'none';

    // Esconde btn-suporte (duplicado no mobile) quando está estreito
    var suporte = document.querySelector('.btn-suporte');
    if (suporte) suporte.style.display = apertado ? 'none' : '';

    // Se voltou ao desktop, fecha o menu mobile
    if (!apertado) {
      btn.classList.remove('aberto');
      nav.classList.remove('aberto');
    }
  }

  var ro = new ResizeObserver(checarEspaco);
  ro.observe(topo);
  checarEspaco();
})();
</script>