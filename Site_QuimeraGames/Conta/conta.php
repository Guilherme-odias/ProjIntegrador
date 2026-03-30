<?php
session_start();
require_once("../conexa.php");

// proteção
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

// busca dados do usuário
$email = $_SESSION['usuario_email'];

$stmt = $pdo->prepare("SELECT * FROM cadastro WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Conta</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- 🔥 HEADER -->
<header class="topo">
  <div class="topo-esquerda">
    <a href="../Index/index.php">
      <img class="logo" src="../imagens/logo.png">
    </a>

    <a href="../Index/index.php">
      <button class="btn-nav active">Loja</button>
    </a>
  </div>

  <div class="topo-direita">

    <!-- carrinho -->
    <button class="btn-icon">🛒</button>

    <!-- usuario -->
    <div class="user-box" onclick="toggleMenu()">
      <img src="../imagens/aidento.jpg" class="user-img">

      <span class="user-nome">
        <?php echo $_SESSION['usuario_nome']; ?>
      </span>

      <div id="user-menu" class="user-menu">
        <a href="../Conta/conta.php">Conta</a>
        <a href="#">Pagamento</a>
        <a href="#">Lista de desejo</a>
        <a href="../Usuario_logado/logout.php">Sair</a>
      </div>
    </div>

    <!-- suporte -->
    <a href="../Sac/Suporte.php">
      <button class="btn-login">Suporte</button>
    </a>

  </div>
</header>

<!-- CONTEUDO -->
<div class="container">

  <div class="card">
    <h2>Configurações</h2>

    <label>Usuário</label>
    <input value="<?php echo htmlspecialchars($usuario['nome_user']); ?>">

    <label>Email</label>
    <input value="<?php echo htmlspecialchars($usuario['email']); ?>">
  </div>

  <div class="card">
    <h2>Dados pessoais</h2>

    <label>Nome</label>
    <input value="<?php echo htmlspecialchars($usuario['nome']); ?>">

    <label>CPF</label>
    <input value="<?php echo htmlspecialchars($usuario['cpf']); ?>">

    <button class="salvar">Atualizar</button>
  </div>

</div>

<!-- JS MENU -->
<script>
function toggleMenu() {
  const menu = document.getElementById("user-menu");
  menu.style.display = menu.style.display === "flex" ? "none" : "flex";
}

document.addEventListener("click", function(e) {
  const userBox = document.querySelector(".user-box");
  const menu = document.getElementById("user-menu");

  if (!userBox.contains(e.target)) {
    menu.style.display = "none";
  }
});
</script>

</body>
</html>