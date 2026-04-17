<?php
session_start();
require_once("../conexa.php");


// CONTAGEM PARA OS BADGES (Cole isso no topo dos seus arquivos PHP)
$qtd_carrinho = 0;
$qtd_wishlist = 0;
if (isset($_SESSION['id_user'])) {
  $stmt_cart = $pdo->prepare("SELECT COUNT(*) FROM carrinho WHERE id_usuario = ?");
  $stmt_cart->execute([$_SESSION['id_user']]);
  $qtd_carrinho = $stmt_cart->fetchColumn();

  $stmt_wish = $pdo->prepare("SELECT COUNT(*) FROM lista_desejos WHERE id_user = ?");
  $stmt_wish->execute([$_SESSION['id_user']]);
  $qtd_wishlist = $stmt_wish->fetchColumn();
}
$logado = isset($_SESSION['usuario_nome']);
$link_home = $logado ? '../Usuario_Logado/usuariologado.php' : '../Index/index.php';


if (!isset($_SESSION['usuario_nome'])) {
  header("Location: ../Entrar/Entrar.php");
  exit;
}

$email = $_SESSION['usuario_email'];

$stmt = $pdo->prepare("SELECT * FROM cadastro WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $novo_user = $_POST['nome_user'];

  // 🧠 NOVO: se for igual ao atual
  if ($novo_user === $usuario['nome_user']) {
    $msg = "⚠️ Nenhuma alteração feita.";
  } else {

    // verifica se já existe OUTRO usuário com esse nome
    $check = $pdo->prepare("SELECT * FROM cadastro WHERE nome_user = :nome_user AND email != :email");
    $check->bindParam(":nome_user", $novo_user);
    $check->bindParam(":email", $email);
    $check->execute();

    if ($check->rowCount() > 0) {
      $msg = "❌ Esse nome de usuário já existe!";
    } else {

      // atualiza no banco
      $update = $pdo->prepare("UPDATE cadastro SET nome_user = :nome_user WHERE email = :email");
      $update->bindParam(":nome_user", $novo_user);
      $update->bindParam(":email", $email);
      $update->execute();

      // atualiza sessão
      $_SESSION['usuario_nome'] = $novo_user;

      $msg = "✅ Nome de usuário atualizado com sucesso!";

      // atualiza na tela
      $usuario['nome_user'] = $novo_user;
    }
  }
}

function mascararCPF($cpf)
{
  return substr($cpf, 0, 3) . '.***.***-' . substr($cpf, -2);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Conta</title>

  <style>
    /* RESET */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #0b1320;
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }

    /* HEADER */
    .topo {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 5%;
      background: rgba(19, 32, 65, 0.95);
      z-index: 10;
      position: relative;
    }

    .logo {
      width: 100px;
    }

    .topo-esquerda,
    .topo-direita {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .btn-login {
      padding: 10px 20px;
      border-radius: 20px;
      border: none;
      background: rgba(255, 255, 255, 0.05);
      color: white;
      cursor: pointer;
    }

    .btn-login:hover {
      background: #e50914;
    }

    /* USER */
    .user-box {
      display: flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, 0.05);
      padding: 6px 12px;
      border-radius: 20px;
      cursor: pointer;
      position: relative;
    }

    .user-img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
    }

    .user-menu {
      position: absolute;
      top: 45px;
      right: 0;
      background: #13192b;
      border-radius: 10px;
      padding: 10px 0;
      width: 160px;
      display: none;
      flex-direction: column;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
      z-index: 9999;
    }

    .user-menu a {
      padding: 10px 15px;
      color: white;
      text-decoration: none;
      font-size: 14px;
      transition: 0.2s;
      text-align: center;
    }

    .user-menu a:hover {
      background: #1f2a44;
    }

    /* LAYOUT PRINCIPAL */
    .main {
      display: grid;
      grid-auto-flow: column;
      align-items: left;
      grid-template-columns: 1fr 1fr;
      padding: 60px;
      transform: scale(1.3);
      margin-right: 380px;
      transform-origin: top left;
      margin-top: -121px;
      margin-left: -210px;
    }

    /* ESQUERDA */
    .left {
      display: flex;
      flex-direction: column;
      align-items: left;
      gap: 10px;
      margin-bottom: 40px;
    }

    .avatar-wrapper {
      position: relative;
    }

    .avatar {
      width: 200px;
      height: 200px;
      border-radius: 15px;
      object-fit: cover;
    }

    .btn-edit {
      position: left;
      bottom: 10px;
      right: 10px;
      margin-left: 20px;
      background: #ccc;
      border: none;
      border-radius: 8px;
      padding: 6px;
      cursor: pointer;
      size:
    }

    .cpf {
      margin-top: -10px;
      font-size: 16px;
      color: #bbb;
      margin-left: 55px;
    }

    /* DIREITA */
    .right h1 {
      font-size: 32px;
      margin-bottom: 30px;
    }

    /* GRID FORM */
    .form {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-template-rows: repeat(2, 1fr);
      gap: 30px;
    }

    .field {
      display: flex;
      flex-direction: column;
      width: 600px;
    }

    label {
      margin-bottom: 6px;
      font-size: 14px;
    }

    input {
      padding: 12px 15px;
      border-radius: 20px;
      border: none;
      background: #2a2a2a;
      color: white;
    }

    /* botão */
    .btn-update {
      width: 140px;
      padding: 8px;
      border-radius: 14px;
      border: none;
      background: #888;
      cursor: pointer;
      margin-top: 20px;
    }

    .btn-update:hover {
      background: #aaa;
    }

    .btn-nav {
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
      background: rgba(255, 255, 255, 0.05);
    }

    .btn-nav.active {
      background: #e50914;
    }

    .btn-icon {
      background: transparent;
      border: none;
      font-size: 30px;
      cursor: pointer;
      color: white;
      transition: 0.3s;
    }

    .btn-icon:hover {
      transform: scale(1.2);
    }

    .user-nome {
      font-size: 14px;
      font-weight: 600;
    }

    .colunadecorativa {
      background: #415485;
      width: 210px;
      height: 601px;
      margin-left: 100px;
      margin-top: 33px;
      z-index: -999;
    }

    .leftright {
      flex-direction: column;
      margin-right: 900px;
      margin-left: -50px;
      margin-top: 70px;
    }

    .rodape {
      background: rgba(19, 32, 65, 0.95);
      padding: 30px;
      text-align: center;
      margin-top: 146px;
    }

    .cruzdemalta1 {
      background: #67718b;
      width: 1260px;
      height: 100px;
      margin-left: 370px;
      margin-top: 250px;
      position: absolute;
      z-index: -1;
      pointer-events: none;
    }

    .cruzdemalta2 {
      background: #67718b;
      width: 100px;
      height: 601px;
      margin-left: 700px;
      margin-top: 93px;
      position: absolute;
      z-index: -1;
      pointer-events: none;
    }

    /* CSS BLINDADO - Impede que o pagamento.css ou outros quebrem o topo */
    html,
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      margin: 0;
    }

    .container,
    .main-pagamento,
    .categoria-container {
      flex: 1;
    }

    /* Empurra o rodapé pro fundo no Pesquisar */

    .topo-universal {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      padding: 15px 5% !important;
      background: rgba(19, 32, 65, 0.95) !important;
      width: 100% !important;
      box-sizing: border-box !important;
      position: relative !important;
      z-index: 1000 !important;
    }

    .topo-universal .logo {
      width: 100px !important;
      height: auto !important;
      border-radius: 12px !important;
    }

    .topo-universal .topo-esquerda,
    .topo-universal .topo-direita {
      display: flex !important;
      align-items: center !important;
      gap: 20px !important;
    }

    .topo-universal .btn-nav,
    .topo-universal .btn-login {
      border: none !important;
      color: white !important;
      padding: 12px 24px !important;
      border-radius: 25px !important;
      cursor: pointer !important;
      font-weight: 600 !important;
      background: rgba(255, 255, 255, 0.05) !important;
      font-size: 15px !important;
      text-decoration: none !important;
    }

    .topo-universal .btn-nav.active,
    .topo-universal .btn-login:hover {
      background: #e62429 !important;
    }

    /* ÍCONES E USUÁRIO (Para ficar igualzinho à imagem 3) */
    .topo-universal .btn-icon {
      background: transparent !important;
      border: none !important;
      font-size: 26px !important;
      cursor: pointer !important;
      color: white !important;
      padding: 0 !important;
    }

    .topo-universal .user-box {
      display: flex !important;
      align-items: center !important;
      gap: 10px !important;
      background: rgba(255, 255, 255, 0.05) !important;
      padding: 6px 15px !important;
      border-radius: 20px !important;
      cursor: pointer !important;
      position: relative !important;
      transition: 0.3s !important;
    }

    .topo-universal .user-box:hover {
      background: rgba(255, 255, 255, 0.1) !important;
    }

    .topo-universal .user-img {
      width: 32px !important;
      height: 32px !important;
      border-radius: 50% !important;
      object-fit: cover !important;
      margin: 0 !important;
    }

    .topo-universal .user-nome {
      font-size: 15px !important;
      font-weight: 600 !important;
      color: white !important;
      margin: 0 !important;
      font-family: sans-serif !important;
    }

    /* DROPDOWN MENU */
    .topo-universal .user-menu {
      position: absolute !important;
      top: 50px !important;
      right: 0 !important;
      background: #13192b !important;
      border-radius: 10px !important;
      padding: 10px 0 !important;
      width: 180px !important;
      display: none;
      flex-direction: column !important;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5) !important;
      z-index: 9999 !important;
    }

    .topo-universal .user-menu a {
      padding: 12px 20px !important;
      color: white !important;
      text-decoration: none !important;
      font-size: 14px !important;
      text-align: left !important;
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      font-family: sans-serif !important;
    }

    .topo-universal .user-menu a:hover {
      background: #1f2a44 !important;
    }

    /* BADGES (Bolinhas Vermelhas) */
    .badge-bolinha {
      background: #e62429 !important;
      color: white !important;
      border-radius: 50% !important;
      padding: 2px 6px !important;
      font-size: 11px !important;
      font-weight: bold !important;
    }

    /* RODAPÉ BLINDADO */
    .rodape-universal {
      background: #111823 !important;
      color: #cdd5e0 !important;
      text-align: center !important;
      padding: 30px !important;
      border-top: 1px solid #30363d !important;
      width: 100% !important;
      box-sizing: border-box !important;
      margin-top: auto !important;
      font-family: sans-serif !important;
    }
  </style>
</head>

<body>

  <header class="topo-universal">
    <div class="topo-esquerda">
      <a href="<?php echo $link_home; ?>"><img class="logo" src="../imagens/logo.png" alt="Logo"></a>
      <a href="<?php echo $link_home; ?>" style="text-decoration: none;"><button
          class="btn-nav active">Loja</button></a>
    </div>

    <div class="topo-direita">
      <?php if ($logado): ?>
        <div style="position: relative; display: inline-block;">
          <button type="button" class="btn-icon"
            onclick="window.location.href='../Usuario_Logado/carrinho.php'">🛒</button>
          <?php if (isset($qtd_carrinho) && $qtd_carrinho > 0): ?>
            <span class="badge-bolinha"
              style="position: absolute; top: -8px; right: -12px; pointer-events: none;"><?php echo $qtd_carrinho; ?></span>
          <?php endif; ?>
        </div>

        <div class="user-box" onclick="toggleMenu()">
          <img src="../imagens/aidento.jpg" class="user-img" alt="Avatar">
          <span class="user-nome"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>

          <div id="user-menu" class="user-menu">
            <a href="../Conta/conta.php">Conta</a>
            <a href="../Pagamento/pagamento.php">Pagamento</a>
            <a href="../Usuario_Logado/wishlist.php">
              Lista de desejo
              <?php if (isset($qtd_wishlist) && $qtd_wishlist > 0): ?>
                <span class="badge-bolinha"><?php echo $qtd_wishlist; ?></span>
              <?php endif; ?>
            </a>
            <a href="../Usuario_Logado/logout.php">Sair</a>
          </div>
        </div>
      <?php else: ?>
        <a href="../Entrar/Entrar.php" style="text-decoration: none;"><button class="btn-login">Entrar</button></a>
      <?php endif; ?>

      <a href="../Sac/Suporte.php" style="text-decoration: none;"><button class="btn-login">Suporte</button></a>
    </div>
  </header>


  <div class="main">

    <div class="colunadecorativa"></div>

    <div class="cruzdemalta1"></div>
    <div class="cruzdemalta2"></div>

    <div class="leftright">
      <!-- ESQUERDA -->
      <div class="left">
        <div class="avatar-wrapper">
          <img src="../imagens/aidento.jpg" class="avatar">
          <button class="btn-edit">✏️</button>

        </div>

        <div class="cpf">
          CPF: <?php echo mascararCPF($usuario['cpf']); ?>
        </div>
      </div>

      <!-- DIREITA -->
      <div class="right">
        <h1>Configurações</h1>

        <form method="POST" class="form">

          <div class="field">
            <label>Apelido de usuário</label>
            <input name="nome_user" value="<?php echo $usuario['nome_user']; ?>">
          </div>

          <div class="field">
            <label>Nome</label>
            <input value="<?php echo $usuario['nome']; ?>" readonly>
          </div>

          <div class="field">
            <label>Email</label>
            <input value="<?php echo $usuario['email']; ?>" readonly>
          </div>

          <button type="submit" class="btn-update">Atualizar</button>

          <?php if ($msg): ?>
            <p style="margin-bottom: 15px; font-weight: bold;">
              <?php echo $msg; ?>
            </p>
          <?php endif; ?>

        </form>


      </div>
    </div>
  </div>

  </div>

  <script>
    function toggleMenu() {
      const menu = document.getElementById("user-menu");
      menu.style.display = menu.style.display === "flex" ? "none" : "flex";
    }

    // fecha se clicar fora
    document.addEventListener("click", function (e) {
      const userBox = document.querySelector(".user-box");
      const menu = document.getElementById("user-menu");

      if (!userBox.contains(e.target)) {
        menu.style.display = "none";
      }
    });

    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

  </script>

  <footer class="rodape"
    style="text-align: center; padding: 30px; background: #111823; color: #cdd5e0; border-top: 1px solid #30363d; margin-top: 60px;">
    QuimeraGames &copy; 2026
  </footer>

</body>

</html>