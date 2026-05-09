<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte ao Cliente</title>
    <link rel="stylesheet" href="suporte.css">
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <?php include '../header_footer_global/header_simples.php'; ?>
    </header>

    <main class="main-suporte">
        <div class="card-suporte">
            <h1>Suporte ao Cliente</h1>

            <div id="blocoErro" class="bloco-erro" style="display:none;">
                <ul id="listaErros"></ul>
            </div>

            <form id="formSuporte" action="enviar.php" method="POST">

                <div class="input-group">
                    <input type="text" name="nome" id="name" placeholder=" " required>
                    <label for="name">Nome</label>
                </div>

                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder=" " required>
                    <label for="email">Email</label>
                </div>

                <div class="input-group">
                    <input type="text" name="cpf" id="cpf" maxlength="14" placeholder=" " required>
                    <label for="cpf">CPF</label>
                </div>

                <div class="input-group">
                    <textarea name="reclamacao" id="reclamacao" placeholder=" " required></textarea>
                    <label for="reclamacao">Escreva sua reclamação/sugestão aqui...</label>
                    <button type="submit" id="bntContinuar" class="btnEnviar">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>

                <div class="footer-voltar">
                    <a class="btnVoltar" href="../usuario_logado/usuariologado.php" style="text-decoration: none;">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="labelVoltar">Voltar</span>
                    </a>
                </div>
            </form>
        </div>
    </main>

    <div id="modalSucesso" class="modal-overlay">
        <div class="modal-content">
            <div class="icon-check">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2>Solicitação Enviada</h2>
            <p>Seu protocolo é: <br> <strong id="numeroProtocolo"></strong></p>
            <button id="btnFecharModal">OK</button>
        </div>
    </div>

    <?php include '../header_footer_global/footer.php'; ?>


    <script src="suporte.js" defer></script>
</body>

</html>