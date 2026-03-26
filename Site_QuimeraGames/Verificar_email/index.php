<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifique seu email</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="topo">
    <div class="topo-esquerda">
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Index/index.php"><img class="logo"
          src="../imagens/logo.png"></a>
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Index/index.php"><button
          class="btn-nav active">Loja</button></a>
    </div>
    <div class="topo-direita">
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Entrar/Entrar.php"><button
          class="btn-login">Entrar</button></a>
      <a href="http://localhost/GitHub/Project_Quimera/Site_QuimeraGames/Sac/Suporte.php"><button
          class="btn-login">Suporte</button></a>
    </div>
  </header>

<?php
session_start();
?>

<form method="POST">
    <div class="container">
        


    <div class="item">

    <div class="parte_cima">
        <h2 class="verif_email">Verifique seu Email</h2>
        <p class="verif_email_texto">Enviamos um código de verificação no email “xxx@gmail.com”</p>
    </div>

            <div class="butaodumeio">
                <input type="text" name="codigo" id="codigo" class="codigo"><br>

                <button type="submit" class="verificarr">Verificar</but ton>
            
                <button class="reenviar">Reenviar o código</button>
            </div>
            
        </div>

        <footer class="rodape">
            <button class="btnVoltar" href="">❮</button>
            <label class="labelVoltar"> Voltar</label>
        </footer>

    </div>
</form>
<?php

if($_POST){

    $codigoDigitado = $_POST['codigo'];

    if($codigoDigitado == $_SESSION['codigo_verificacao']){

        require_once '../conexa.php';

        $dados = $_SESSION['cadastro'];

        $sql = "INSERT INTO cadastro (email, nome, nome_user, senha, cpf) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $dados['email'],
            $dados['nome'],
            $dados['user'],
            $dados['senha'],
            $dados['cpf']
        ]);

        // Limpa a seção
        session_destroy();

        echo "Cadastro realizado com sucesso!";
        
    } else {
        echo "Código inválido!";
    }
}
?>
</body>

</html>