<?php
session_start();
require_once("../conexa.php");

if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

$email = $_SESSION['usuario_email'];

$stmt = $pdo->prepare("SELECT * FROM cadastro WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

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
  background: rgba(19,32,65,0.95);
}

.logo { width: 100px; }

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
  background: rgba(255,255,255,0.05);
  color: white;
  cursor: pointer;
}

.btn-login:hover { background: #e50914; }

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
  padding: 10px 0;
  width: 160px;
  display: none;
  flex-direction: column;
  box-shadow: 0 10px 25px rgba(0,0,0,0.5);
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
  align-items: left;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  padding: 60px;
}

/* ESQUERDA */
.left {
  display: flex;
  flex-direction: column;
  align-items: left;
  gap: 20px;
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
  font-size: 14px;
  color: #bbb;
}

/* DIREITA */
.right h1 {
  font-size: 32px;
  margin-bottom: 30px;
}

/* GRID FORM */
.form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
}

.field {
  display: flex;
  flex-direction: column;
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
  grid-column: span 2;
  width: 150px;
  padding: 12px;
  border-radius: 10px;
  border: none;
  background: #888;
  cursor: pointer;
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
  background: #7a5759;
  width: 300px;
  height: 1000px;
}

</style>
</head>

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
  <button class="btn-icon" >
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

<div class="colunadecorativa"></div>

<div class="main">

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

    <div class="form">

      <div class="field">
        <label>Apelido de usuário</label>
        <input value="<?php echo $usuario['nome_user']; ?>">
      </div>

      <div class="field">
        <label>Nome</label>
        <input value="<?php echo $usuario['nome']; ?>">
      </div>

      <div class="field">
        <label>Email</label>
        <input value="<?php echo $usuario['email']; ?>">
      </div>

      <button class="btn-update">Atualizar</button>

    </div>
  </div>

</div>

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

</body>
</html>