<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Quimera</title>
    <link rel="stylesheet" href="cStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  
</head>

<body class="bg-dark">

 <main>
    <form method="POST">
     
        <div class="tudo">
            <h1 class="text-light">Tela de Cadastro</h1>

            <article class="cards">
                <label for="femail">Email</label><br>
                <input type="text" name="email" id="email"><br>

                <label for="fname">Nome de usuario</label><br>
                <input type="text" name="nome" id="nome"><br>
            </article>

            <article class="cards">
                <label for="fcpf">CPF</label><br>
                <input type="number" name="cpf" id="cpf"><br>
            </article>

            <article class="cards">
                <label for="fsenha">Senha</label><br>
                <input type="password" name="senha" id="senha"><br>
                <div class="check">
                    <input type="checkbox" id="verifica">
                    <label for="verifica">Mostrar senha</label>
                </div>
                
                <label for="verifica">Confirme a senha</label><br>
                <input type="password" name="confirme" id="confirme"><br>
            </article>
            <div class="botao">
            <button id="btnVoltas" class="btn btn-secondary">Voltar</button>
            <button id="bntContinuar" class="btn btn-danger">Continuar</button>
            </div>
        </div>
    </form>
</main>
    <?php 

    if($_POST) {
         $sql = $pdo->prepare('
 INSERT INTO usuario (email, name, cpf, senha)
 VALUES (:email, :nome, :cpf, :senha)
 ');

 $sql->execute(array(
    ':email'=>$_POST['email'],
    ':nome'=>$_POST['nome'],
    ':cpf'=>$_POST['cpf'],
    ':senha'=>$_POST['senha']
 ));
        echo 'Cadastro Realizado';
        }

    ?>
    
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>


</body>

</html>