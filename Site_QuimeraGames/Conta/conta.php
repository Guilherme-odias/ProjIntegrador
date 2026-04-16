<?php
session_start();
require_once("../conexa.php");

if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

$email = $_SESSION['usuario_email'];

/* BUSCA USUARIO */
$stmt = $pdo->prepare("SELECT * FROM cadastro WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

$msg = "";

/* 📸 UPLOAD FOTO */
if (isset($_POST['upload_foto'])) {

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . "." . $ext;

        $caminho = "../uploads/" . $nomeArquivo;

        move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);

        $updateFoto = $pdo->prepare("UPDATE cadastro SET url_foto = :foto WHERE email = :email");
        $updateFoto->bindParam(":foto", $caminho);
        $updateFoto->bindParam(":email", $email);
        $updateFoto->execute();

        $usuario['url_foto'] = $caminho;
        $msg = "✅ Foto atualizada!";
    }
}

/* ✏️ ATUALIZAR NOME */
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['upload_foto'])) {

    $novo_user = $_POST['nome_user'];

    if ($novo_user === $usuario['nome_user']) {
        $msg = "⚠️ Nenhuma alteração feita.";
    } else {

        $check = $pdo->prepare("SELECT * FROM cadastro WHERE nome_user = :nome_user AND email != :email");
        $check->bindParam(":nome_user", $novo_user);
        $check->bindParam(":email", $email);
        $check->execute();

        if ($check->rowCount() > 0) {
            $msg = "❌ Esse nome já existe!";
        } else {

            $update = $pdo->prepare("UPDATE cadastro SET nome_user = :nome_user WHERE email = :email");
            $update->bindParam(":nome_user", $novo_user);
            $update->bindParam(":email", $email);
            $update->execute();

            $_SESSION['usuario_nome'] = $novo_user;
            $usuario['nome_user'] = $novo_user;

            $msg = "✅ Nome atualizado!";
        }
    }
}

/* CPF */
function mascararCPF($cpf) {
    return substr($cpf,0,3) . '.***.***-' . substr($cpf,-2);
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

/* BASE */
body {
  height: 100vh;
  overflow: hidden;
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
  backdrop-filter: blur(10px);
}

.logo {
  width: 100px;
  border-radius: 12px;
}

.topo-esquerda,
.topo-direita {
  display: flex;
  align-items: center;
  gap: 20px;
}

.btn-nav,
.btn-login {
  border: none;
  color: white;
  padding: 12px 24px;
  border-radius: 25px;
  cursor: pointer;
  font-weight: 600;
  background: rgba(255,255,255,0.05);
  transition: 0.3s;
}

.btn-nav.active,
.btn-login:hover {
  background: #e50914;
}

.btn-icon {
  background: transparent;
  border: none;
  font-size: 28px;
  cursor: pointer;
  color: white;
}

.btn-icon:hover {
  transform: scale(1.3);
}

/* USER */
.user-box {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.05);
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
  width: 160px;
  display: none;
  flex-direction: column;
}

.user-menu a {
  padding: 10px;
  color: white;
  text-decoration: none;
  text-align: center;
}

.user-menu a:hover {
  background: #1f2a44;
}

/* CONTEUDO */
.container {
  height: calc(100vh - 80px);
  display: flex;
  justify-content: center;
  align-items: center;
}

/* CARD */
.card-conta {
  display: flex;
  gap: 60px;
  background: linear-gradient(145deg, #132041, #0f1a35);
  padding: 50px;
  border-radius: 25px;
  box-shadow: 0 25px 60px rgba(0,0,0,0.6);
}

/* PERFIL */
.perfil {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.avatar {
  width: 160px;
  height: 160px;
  border-radius: 20px;
  object-fit: cover;
}

.btn-foto {
  background: rgba(255,255,255,0.1);
  border: none;
  padding: 8px 15px;
  border-radius: 10px;
  color: white;
  cursor: pointer;
}

/* INFO */
.info {
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 300px;
}

input {
  padding: 10px;
  border-radius: 10px;
  border: none;
  background: #1f2a44;
  color: white;
}

button[type="submit"] {
  margin-top: 10px;
  padding: 10px;
  border-radius: 10px;
  border: none;
  background: #e50914;
  color: white;
  cursor: pointer;
}

.msg {
  margin-top: 10px;
  font-weight: bold;
}

</style>
</head>

<body>

<header class="topo">
    <?php
    // Verifica se está logado e define o link da logo/loja
    $logado = isset($_SESSION['usuario_nome']);
    $link_home = $logado ? '../Usuario_Logado/usuariologado.php' : '../Index/index.php';
    ?>

    <div class="topo-esquerda">
      <a href="<?php echo $link_home; ?>">
        <img class="logo" src="../imagens/logo.png" alt="Logo">
      </a>
      <a href="<?php echo $link_home; ?>" style="text-decoration: none;">
        <button class="btn-nav active">Loja</button>
      </a>
    </div>

    <div class="topo-direita">
      <?php if ($logado): ?>
        <div style="position: relative; display: inline-block;">
          <button type="button" class="btn-icon"
            onclick="window.location.href='../Usuario_Logado/carrinho.php'">🛒</button>
          <?php if (isset($qtd_carrinho) && $qtd_carrinho > 0): ?>
            <span
              style="position: absolute; top: -5px; right: -8px; background: #e62429; color: white; border-radius: 50%; padding: 2px 7px; font-size: 11px; font-weight: bold; pointer-events: none;">
              <?php echo $qtd_carrinho; ?>
            </span>
          <?php endif; ?>
        </div>

        <div class="user-box" onclick="toggleMenu()">
          <img src="<?php echo $usuario['url_foto']; ?>" class="user-img">
          <span class="user-nome">
            <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
          </span>

          <div id="user-menu" class="user-menu">
            <a href="../Conta/conta.php">Conta</a>
            <a href="../Pagamento/pagamento.php">Pagamento</a>
            <a href="../Usuario_Logado/wishlist.php"
              style="display:flex; justify-content: space-between; align-items: center; padding:10px;">
              Lista de desejo
              <?php if (isset($qtd_wishlist) && $qtd_wishlist > 0): ?>
                <span
                  style="background: #e62429; color: white; border-radius: 50%; padding: 2px 7px; font-size: 11px; font-weight: bold; margin-left: 10px;">
                  <?php echo $qtd_wishlist; ?>
                </span>
              <?php endif; ?>
            </a>
            <a href="../Usuario_Logado/logout.php">Sair</a>
          </div>
        </div>

      <?php else: ?>
        <a href="../Entrar/Entrar.php" style="text-decoration: none;">
          <button class="btn-login">Entrar</button>
        </a>
      <?php endif; ?>

      <a href="../Sac/Suporte.php" style="text-decoration: none;">
        <button class="btn-login">Suporte</button>
      </a>
    </div>
  </header>

<div class="container">
  <div class="card-conta">

    <!-- FOTO -->
    <div class="perfil">
      <form method="POST" enctype="multipart/form-data">
        <img src="<?php echo $usuario['url_foto']; ?>" class="avatar">

        <input type="file" name="foto" id="foto" hidden>

        <label for="foto" class="btn-foto">Trocar foto</label>
        <button type="submit" name="upload_foto" class="btn-foto">Salvar</button>
      </form>

      <div class="cpf">
        CPF: <?php echo mascararCPF($usuario['cpf']); ?>
      </div>
    </div>

    <!-- INFO -->
    <div class="info">
      <h2>Configurações</h2>

      <form method="POST">
        <input name="nome_user" value="<?php echo $usuario['nome_user']; ?>">
        <input value="<?php echo $usuario['nome']; ?>" readonly>
        <input value="<?php echo $usuario['email']; ?>" readonly>

        <button type="submit">Atualizar</button>
      </form>

      <?php if ($msg): ?>
        <p class="msg"><?php echo $msg; ?></p>
      <?php endif; ?>
    </div>

  </div>
</div>

<script>
function toggleMenu() {
  const menu = document.getElementById("user-menu");
  menu.style.display = menu.style.display === "flex" ? "none" : "flex";
}
</script>

</body>
</html>
```
