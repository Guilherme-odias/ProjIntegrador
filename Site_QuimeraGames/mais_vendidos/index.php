<?php
require_once("../conexa.php");

// BUSCAR TOP 20 MAIS VENDIDOS
$stmt = $pdo->prepare("
    SELECT j.id_play, j.titulo, j.Imagens_jogos, j.Valor, COUNT(c.id_play) as total_vendas
    FROM jogos j
    LEFT JOIN compra c ON j.id_play = c.id_play
    GROUP BY j.id_play
    ORDER BY total_vendas DESC
    LIMIT 20
");

$stmt->execute();
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mais Vendidos</title>
    <link rel="stylesheet" href="stylee.css">
</head>

<body>

<header class="topo">
    <img class="img" src="../imagens/logo.png" alt="🍹">

    <button class="button" id="home">Home</button>

    <section class="button2">
        <button class="entrar" id="entrarr">Entrar</button>
        <button class="suporte" id="suportee">Suporte</button>
    </section>
</header>

<section class="textao">
  <div class="linha-topo">
    <div class="textos">
      <h3 class="texto1">Mais vendidos ></h3>
      <p class="texto2">Os 20 jogos mais vendidos do momento</p>
    </div>

    <p class="precoo">Preço</p>
  </div>
</section>

<!-- 🔥 AQUI É ONDE TUDO MUDA -->
<?php
$posicao = 1;
foreach ($jogos as $jogo):
?>

<section class="jogos">
    <h2 class="num"><?php echo $posicao++; ?></h2>
    <img class="img" src="<?php echo $jogo['Imagens_jogos']; ?>">
    <p><?php echo $jogo['titulo']; ?></p>
    <p class="preco">R$ <?php echo number_format($jogo['Valor'], 2, ',', '.'); ?></p>
</section>

<?php endforeach; ?>

<footer>
<div class="tudoai">
<div class="primeira_cadastre">
    <label class="primeira">Primeira vez na Quimera?</label>
    <button class="cad">Cadastre-se</button>
</div>

<div class="texto">
<p>É gratuito e fácil. Descubra milhares de jogos
 para jogar com milhões de novos amigos.</p>
</div>
</div>
</footer>

</body>
</html>