<?php
require_once("../conexa.php");

$categoria = isset($_GET['categoria']) ? (int) $_GET['categoria'] : 0;

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

try {

    if ($categoria > 0) {
        $stmt = $pdo->prepare("
            SELECT j.*, COUNT(c.id_play) as total_vendas
            FROM jogos j
            LEFT JOIN compra c ON j.id_play = c.id_play
            WHERE j.id_categoria = :categoria
            GROUP BY j.id_play
            ORDER BY total_vendas DESC
            LIMIT 20
        ");
        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_INT);

    } else {
        $stmt = $pdo->prepare("
            SELECT j.*, COUNT(c.id_play) as total_vendas
            FROM jogos j
            LEFT JOIN compra c ON j.id_play = c.id_play
            GROUP BY j.id_play
            ORDER BY total_vendas DESC
            LIMIT 20
        ");
    }

    $stmt->execute();
    $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Mais Vendidos</title>
  <link rel="stylesheet" href="stylee.css">

<style>


/* 🔥 DROPDOWN */
.dropdown {
  margin: 30px 200px;
  position: relative;
}

.btn-categorias {
  background: transparent;
  border: 2px solid red;
  color: white;
  padding: 10px 18px;
  border-radius: 30px;
  cursor: pointer;
}

.menu-categorias {
  position: absolute;
  top: 50px;
  background: #13192b;
  border-radius: 10px;
  display: none;
  flex-direction: column;
  width: 180px;
  z-index: 999;
}

.menu-categorias a {
  padding: 10px;
  text-align: center;
  color: white;
  text-decoration: none;
}

.menu-categorias a:hover {
  background: #1f2a44;
}

/* GRID */
.grid-jogos {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 25px;
  padding: 40px 200px;
}

/* CARD */
.card-jogo {
  background: #0f1b35;
  border-radius: 15px;
  overflow: hidden;
  position: relative;
  transition: 0.3s;
}

.card-jogo:hover {
  transform: scale(1.05);
}

/* IMG */
.card-jogo img {
  width: 100%;
  height: 160px;
  object-fit: cover;
}

/* VIDEO */
.card-jogo video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 160px;
  object-fit: cover;
  display: none;
}

.card-jogo:hover video {
  display: block;
}

.card-jogo:hover img {
  display: none;
}

/* INFO */
.card-info {
  padding: 15px;
}

.preco {
  margin-top: 10px;
  font-weight: bold;
  color: #00ff88;
}

/* BADGE */
.badge {
  position: absolute;
  top: 10px;
  left: 10px;
  background: #e50914;
  padding: 5px 10px;
  border-radius: 8px;
  font-size: 12px;
}

.topo2 {
  gap: 20px;
}

</style>
</head>

<body>

<!-- 🔥 HEADER ORIGINAL -->
<header class="topo">
    <div>
        <img class="logo" src="../imagens/logo.png">
    </div>

    <div class="topo2">
        <button class="btn-login">Entrar</button>
        <button class="btn-login">Suporte</button>
    </div>
</header>

<!-- 🔥 FILTRO -->
<div class="dropdown">
  <button class="btn-categorias" onclick="toggleCategorias()">
    Categorias ▾
  </button>

  <div id="menu-categorias" class="menu-categorias">
    <a href="Index.php">Todos</a>
    <?php foreach ($nomes_categorias as $id => $nome): ?>
      <a href="?categoria=<?php echo $id; ?>"><?php echo $nome; ?></a>
    <?php endforeach; ?>
  </div>
</div>

<!-- 🔥 TITULO -->
<div class="textao">
  <h2 class="texto1">
    <?php 
    if ($categoria > 0 && isset($nomes_categorias[$categoria])) {
        echo $nomes_categorias[$categoria] . " selecionada";
    } else {
        echo "Mais vendidos >";
    }
    ?>
  </h2>

  <p class="texto2">Top jogos mais vendidos da loja</p>
</div>

<!-- 🔥 GRID -->
<div class="grid-jogos">

<?php foreach ($jogos as $jogo): ?>

<a href="../Tela_Jogo/index_jogo.php?id=<?php echo $jogo['id_play']; ?>" style="text-decoration:none; color:white;">

<div class="card-jogo">

    <div class="badge">
        <?php echo $nomes_categorias[$jogo['id_categoria']] ?? 'Jogo'; ?>
    </div>

    <img src="<?php echo $jogo['Imagens_jogos']; ?>">

    <?php if (!empty($jogo['Trailers'])): ?>
        <video muted loop onmouseover="this.play()" onmouseout="this.pause(); this.currentTime=0;">
            <source src="<?php echo $jogo['Trailers']; ?>" type="video/mp4">
        </video>
    <?php endif; ?>

    <div class="card-info">
        <h4><?php echo $jogo['titulo']; ?></h4>

        <div class="preco">
            <?php 
            if ($jogo['Valor'] > 0) {
                echo "R$ " . number_format($jogo['Valor'], 2, ',', '.');
            } else {
                echo "Gratuito";
            }
            ?>
        </div>
    </div>

</div>
</a>

<?php endforeach; ?>

</div>

<script>
function toggleCategorias() {
  const menu = document.getElementById("menu-categorias");
  menu.style.display = menu.style.display === "flex" ? "none" : "flex";
}

document.addEventListener("click", function(e) {
  const dropdown = document.querySelector(".dropdown");
  const menu = document.getElementById("menu-categorias");

  if (!dropdown.contains(e.target)) {
    menu.style.display = "none";
  }
});
</script>

</body>
</html>