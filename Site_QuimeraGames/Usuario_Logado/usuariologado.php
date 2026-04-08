<?php
session_start();

// se não estiver logado, volta pro login
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

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

  $stmt_categorias = $pdo->prepare("SELECT id_categoria, MIN(Imagens_jogos) as capa FROM jogos GROUP BY id_categoria");
  $stmt_categorias->execute();
  $categorias_bd = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

  $nomes_categorias = [
    1 => 'Ação',
    2 => 'Aventura',
    3 => 'Corrida',
    4 => 'Estratégia',
    5 => 'Esporte',
    6 => 'FPS',
    7 => 'Luta',
    8 => 'Terror',
    9 => 'Sobrevivência',
    10 => 'RPG'
  ];
} catch (PDOException $e) {
  die("Erro na consulta ao banco de dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuimeraGames - logado</title>
  <link rel="stylesheet" href="../Usuario_Logado/style.css">
</head>

<script>
function toggleMenu() {
  const menu = document.getElementById("user-menu");
  menu.style.display = menu.style.display === "flex" ? "none" : "flex";
}

// fecha se clicar fora
document.addEventListener("click", function(e) {
  const userBox = document.querySelector(".user-box");
  const menu = document.getElementById("user-menu");

  if (!userBox.contains(e.target)) {
    menu.style.display = "none";
  }
});

</script>

<body>

  <header class="topo">
    <div class="topo-esquerda">
      <a href="http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Usuario_Logado/usuariologado.php">
        <img class="logo" src="../imagens/logo.png" alt="Logo">
      </a>
      <a href="http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Usuario_Logado/usuariologado.php"
        style="text-decoration: none;">
        <button class="btn-nav active">Loja</button>
      </a>
    </div>
    <div class="topo-direita">
  <!-- carrinho -->
  <button class="btn-icon">
    🛒
  </button>

  <!-- usuario -->
  <div class="user-box" onclick="toggleMenu()">
  <img src="../imagens/aidento.jpg" class="user-img">
<span class="user-nome">
  <?php echo $_SESSION['usuario_nome']; ?>
</span>
  <!-- dropdown -->
  <div id="user-menu" class="user-menu">
    <a href="../Conta/conta.php">Conta</a>
    <a href="#">Pagamento</a>
    <a href="#">Lista de desejo</a>
    <a href="logout.php">Sair</a>
  </div>
</div>

  <!-- suporte -->
  <a href="http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Sac/Suporte.php"
    style="text-decoration: none;">
    <button class="btn-login">Suporte</button>
  </a>

</div>
  </header>

  <div class="container">

    <div class="menu-wrapper" style="position: relative; z-index: 1000;">
      <nav class="menu-busca">
        <form action="../Busca/search.php" method="GET" class="busca-input">
  <span>🔍</span>
  <input type="text" name="query" placeholder="Pesquisar loja" required>
        </form>
        <button class="btn-dropdown" id="btn-explorar">Explorar ▾</button>
        <button class="btn-dropdown" id="btn-categorias">Categorias ▾</button>
      </nav>

      <div id="painel-explorar" class="painel-dropdown">
        <div class="banner-explorar-container">
          <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2070" alt="Banner Explorar"
            class="img-banner-explorar">
          <div class="overlay-banner"></div>
          <a href="../mais_vendidos/Index.php" class="btn-mais-vendidos-banner">Mais vendidos</a>
        </div>
      </div>

      <div id="painel-categorias" class="painel-dropdown">
        <h3 class="titulo-painel">Gêneros Populares</h3>
        <div class="carousel-categorias-wrapper">
          <button class="seta-cat esquerda" id="seta-esquerda">&#10094;</button>
          <div class="categorias-painel-grid" id="grid-categorias">
            <?php foreach ($categorias_bd as $cat): ?>
              <?php $nome_cat = isset($nomes_categorias[$cat['id_categoria']]) ? $nomes_categorias[$cat['id_categoria']] : 'Outros'; ?>

              <a href="../Categorias/categoria.php?id=<?php echo $cat['id_categoria']; ?>" class="card-cat-item"
                style="text-decoration: none; color: inherit;">
                <div class="img-cat-wrapper">
                  <img src="<?php echo htmlspecialchars($cat['capa']); ?>" alt="<?php echo $nome_cat; ?>">
                </div>
                <span><?php echo $nome_cat; ?></span>
              </a>

            <?php endforeach; ?>
          </div>
          <button class="seta-cat direita" id="seta-direita">&#10095;</button>
        </div>
      </div>
    </div>

    <div class="carousel-container">
      <?php foreach ($jogos_carousel as $i => $radio): ?>
        <input type="radio" name="slide" id="s<?php echo $i + 1; ?>" <?php echo ($i == 0) ? 'checked' : ''; ?>>
      <?php endforeach; ?>

      <div class="slides">
        <?php foreach ($jogos_carousel as $i => $jogo): ?>
          <div class="slide" id="slide<?php echo $i + 1; ?>">
            <div class="content-box">
              <div class="poster-box">
                <a href="../Tela_Jogo/index_jogo.php?id=<?php echo $jogo['id_play']; ?>">
                  <img src="<?php echo htmlspecialchars($jogo['Imagens_jogos']); ?>" id="mainImg<?php echo $i + 1; ?>"
                    data-capa="<?php echo $jogo['Imagens_jogos']; ?>" class="capa-poster">
                </a>
              </div>

              <div class="info-box" id="infoBox<?php echo $i + 1; ?>">
                <span class="label-disponivel">JÁ DISPONÍVEL</span>
                <h2 class="titulo-jogo"><?php echo htmlspecialchars($jogo['titulo']); ?></h2>
                <p class="descricao-jogo"><?php echo mb_strimwidth($jogo['informacoes'], 0, 180, "..."); ?></p>

                <div class="card-plataforma" style="margin-bottom: 20px;">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" width="16">
                  <span>Windows</span>
                </div>

                <div class="precos-container">
                  <?php if ($jogo['Valor'] > 0): ?>
                    <div class="col-precos">
                      <span class="v-novo">R$ <?php echo number_format($jogo['Valor'], 2, ',', '.'); ?></span>
                    </div>
                  <?php else: ?>
                    <span class="v-gratis">Gratuito</span>
                  <?php endif; ?>
                </div>
                <a href="../Tela_Jogo/index_jogo.php?id=<?php echo $jogo['id_play']; ?>" style="text-decoration: none;">
                  <button class="btn-comprar-carrossel">COMPRAR AGORA</button>
                </a>
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
          <a href="../Tela_Jogo/index_jogo.php?id=<?php echo $jogo['id_play']; ?>&desconto=1"
            style="text-decoration: none; color: inherit; display: block;">
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
          </a>
        <?php endforeach; ?>
      </div>
    </section>

  </div>

  <footer class="rodape">QuimeraGames &copy; 2026</footer>

  <script src="script.js" defer></script>

  <?php
require_once '../conexa.php';

// Pega o que o usuário digitou na barra de pesquisa
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query === '') {
    echo "<p style='color: white;'>Digite algo para pesquisar.</p>";
    exit;
}

try {
    // Busca no banco de dados os jogos que contenham o texto digitado no título
    $stmt = $pdo->prepare("SELECT * FROM jogos WHERE titulo LIKE :busca LIMIT 18");
    $stmt->bindValue(':busca', '%' . $query . '%', PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Se encontrou algum jogo, monta a grade de cartões
    if (count($resultados) > 0) {
        echo '<div class="jogos-grid">';

        foreach ($resultados as $jogo) {
            $id = $jogo['id_play'];
            $titulo = htmlspecialchars($jogo['titulo']);
            $imagem = htmlspecialchars($jogo['Imagens_jogos']);
            $valor = $jogo['Valor'];

            // Lógica de exibição de preço (Gratuito ou Pago)
            if ($valor > 0) {
                $preco_html = '<span class="v-new">R$ ' . number_format($valor, 2, ',', '.') . '</span>';
            } else {
                $preco_html = '<span class="v-gratis" style="color:#4CAF50; font-weight:bold;">Gratuito</span>';
            }

            // O Cartão do jogo (Igual aos descontos em destaque) apontando para a Tela do Jogo
            echo '
            <a href="../Tela_Jogo/index_jogo.php?id=' . $id . '" style="text-decoration: none; color: inherit; display: block;">
                <div class="card-jogo-container">
                    <div class="thumb-wrapper">
                        <img src="' . $imagem . '" alt="' . $titulo . '">
                    </div>
                    <div class="card-info-texto">
                        <h4>' . $titulo . '</h4>
                        <div class="card-plataforma">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/Steam_icon_logo.svg" width="16">
                            <span>Windows</span>
                        </div>
                        <div class="precos-card">
                            ' . $preco_html . '
                        </div>
                    </div>
                </div>
            </a>';
        }
        echo '</div>';
    } else {
        // Se não encontrar nada, mostra uma mensagem amigável
        echo "<h3 style='color: #aaa; text-align: center; margin-top: 60px; font-weight: normal;'>
                Nenhum jogo encontrado para \"<strong style='color:white;'>" . htmlspecialchars($query) . "</strong>\".
              </h3>";
    }

} catch (PDOException $e) {
    echo "<p style='color: red;'>Erro na busca: " . $e->getMessage() . "</p>";
}
?>

</body>

</html>