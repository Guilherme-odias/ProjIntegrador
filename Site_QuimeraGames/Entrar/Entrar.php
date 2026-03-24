<?php
require_once("../conexa.php");

// evita cache (ajuda com F5)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $stmt = $pdo->prepare("
        SELECT * FROM cadastro 
        WHERE (email = :usuario OR nome_user = :usuario)
    ");

    $stmt->bindParam(":usuario", $usuario);
    $stmt->execute();

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados && $senha == $dados["senha"]) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?sucesso=1");
        exit;
    } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?erro=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Entrar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="tela">
<div class="h1box">
    <h1>Entre na Quimera Games</h1>

    <div class="conteudo">

    <!-- MENSAGENS -->
    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;">Usuário ou senha incorretos!</p>
    <?php endif; ?>

    <?php if (isset($_GET['sucesso'])): ?>
        <p style="color:green;">Login realizado com sucesso!</p>
    <?php endif; ?>

<form method="post">

<div class="div1">
<label>Nome de usuário ou email:</label>
<input name="usuario" required>
</div>

<div class="div2">
<label>Senha:</label>
<<<<<<< HEAD
<input type="password" name="senha" required>
=======
<input id="senha_usuario" name="senha">
>>>>>>> b61a2dacc0a8ad4c460e2c8adf2594850333be13

<div class="lembrar">
  <input type="checkbox" id="lembrar">
  <label for="lembrar">Lembre-me</label>
</div>
    </div>

<<<<<<< HEAD

<button type="submit" class="iniciar_sessao">Iniciar Sessão</button>

</form>
=======
<button class="iniciar_sessao" name="acao" value="login">Iniciar Sessão</button>
>>>>>>> b61a2dacc0a8ad4c460e2c8adf2594850333be13

<a href="#" class="problemas_iniciar">Problemas para iniciar sessão</a>

    </div>
</div>
</div>

<script>
if (window.location.search.includes("sucesso") || window.location.search.includes("erro")) {
    window.history.replaceState({}, document.title, window.location.pathname);
}
</script>

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

<?php 
require_once '../conexa.php';

if(isset($_POST['acao']) && $_POST['acao'] == 'login') {

    $login = $_POST['login'];
    $senha = $_POST['senha'];

        $sql = "SELECT * FROM cadastro WHERE email = ? OR nome_user = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login, $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

         if($user){

        
        if($senha == $user['senha'] && $login == $user['login']){
            header("Location: ../Tela_Usuario_Logado/UserLog.html"); exit;
        } else {
            echo "<script>alert('Senha incorreta!')</script>";
        }
            
}
}
?>

</body>
</html>