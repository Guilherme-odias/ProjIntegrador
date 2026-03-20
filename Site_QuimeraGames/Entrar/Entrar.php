<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
         <link rel="stylesheet" href="Estyles.css">
</head>
<body>

<div class="tela">
<div class="h1box">
    <h1> Entre na Quimera Games </h1>

    <div class="conteudo">

<label>Nome de usuário ou email:</label>
<input id="nome_usuario">

<label>Senha:</label>
<input id="senha_usuario" name="senha">

    <div class="lembrar">
  <input type="checkbox" id="lembrar">
  <label for="lembrar">Lembre-me</label>
    </div>

<button class="iniciar_sessao" name="acao" value="login">Iniciar Sessão</button>

<a href="#" class="problemas_iniciar">Problemas para iniciar sessão</a>
    </div>
</div>
</div>

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

        
        if($senha == $user['senha']){
            header("Location: ../Tela_Usuario_Logado/UserLog.html"); exit;
        } else {
            echo "Senha incorreta!";
        }
            
}
}
?>

</body>
</html>