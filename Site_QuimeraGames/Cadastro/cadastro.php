<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro Quimera</title>

<link rel="stylesheet" href="cStyles.css">
</head>

<body>

<div class="container">

    <form class="card" method="POST" onsubmit="return validarForm()">

        <h1>Tela Cadastro</h1>

        <div class="input-group">
            <input type="email" id="email" name="email" required>
            <label>Email</label>
        </div>

        <div class="input-group">
            <input type="text" id="nome" name="nome" required>
            <label>Nome</label>
        </div>

        <div class="input-group">
            <input type="text" id="user" name="user" required>
            <label>User</label>
        </div>

        <div class="input-group">
            <input type="text" id="cpf" name="cpf" maxlength="14" required>
            <label>CPF</label>
        </div>

        <div class="input-group">
            <input type="password" id="senha" name="senha" required>
            <label>Senha</label>
        </div>

        <div class="input-group">
            <input type="password" id="confirme" name="confirme" required>
            <label>Confirmar senha</label>
        </div>

        <div class="check">
            <input type="checkbox" onclick="mostrarSenha()"> Mostrar senha
        </div>

        <button class="btn" id="btn" name="cadastro">Cadastrar</button>

        <div class="footer">
            <div class="voltar">←</div>
            <span>Voltar</span>
        </div>

    </form>

</div>
<?php 
require_once '../conexa.php';



if($_POST) {

        $sql = 'INSERT INTO cadastro (email, nome, nome_user, senha, cpf) 
                VALUES (?, ?, ?, ?, ?)';  

        $declara = $pdo->prepare($sql);

        $resultado = $declara->execute([
            $_POST['email'], 
            $_POST['nome'], 
            $_POST['user'], 
            $_POST['senha'], 
            $_POST['cpf']
        ]);
}

?>

<script src="script.js"></script>

</body>
</html>