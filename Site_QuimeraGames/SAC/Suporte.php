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


        <div class="item">
            <div>
                <label class="label">Nome</label>
                <input type="text" name="name" id="name" class="inputNome"><br>
            </div>

            <div>
                <label class="label">Email</label>
                <input type="text" name="email" id="email" class="inputEmail"><br>
            </div>

            <div>
                <label class="label">CPF</label>
                <input type="text" name="cpf" id="cpf" class="inputCpf" maxlength="14"><br>
            </div>

            
            <label for="freclamacao" class="label"> Escreva a reclamação/sugestão no campo abaixo: </label><br>
            <div class="inputContainer">
                <textarea name="reclamacao" id="reclamacao" class="inputReclamacao"></textarea>
                <button id="bntContinuar" class="btnEnviar">➤</button>
            </div>

        </div>

        <footer class="rodape">
            
            <a class="btnVoltar" href="../Index/index.php">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </a>
                
            <label class="labelVoltar"> Voltar </label>
        </footer>

    </div>

    <script src="Suporte.js"></script>
</body>

</html>