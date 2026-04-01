<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte ao Cliente</title>
    <link rel="stylesheet" href="Suporte.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <h1>Suporte ao cliente</h1>


        <form class="item" id="formSuporte" action="enviar_suporte.php" method="POST">
            <div>
                <label class="label">Nome</label>
                <input type="text" name="nome" id="name" class="inputNome" required><br>
            </div>

            <div>
                <label class="label">Email</label>
                <input type="email" name="email" id="email" class="inputEmail" required><br>
            </div>

            <div>
                <label class="label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="inputCpf" maxlength="14" required><br>
            </div>

            <label for="reclamacao" class="label"> Escreva a reclamação/sugestão no campo abaixo: </label><br>
            <div class="inputContainer">
                <textarea name="reclamacao" id="reclamacao" class="inputReclamacao" required></textarea>
                <button type="submit" id="bntContinuar" class="btnEnviar">➤</button>
            </div>

        </form>

        <footer class="rodape">
            
            <a class="btnVoltar" href="../Index/index.php">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </a>
                
            <label id="voltar" class="labelVoltar"> Voltar </label>
            
        </footer>

    </div>

    <script src="Suporte.js" defer></script>
</body>

</html>