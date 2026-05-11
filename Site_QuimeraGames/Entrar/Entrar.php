<?php
session_start();
require_once("../conexa.php");

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

$erro = false;

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
        $_SESSION['usuario_nome'] = $dados['nome_user'];
        $_SESSION['usuario_email'] = $dados['email'];
        $_SESSION['id_user'] = $dados['id_user'];

        // 👇 NOVA LINHA: Salva o tipo de usuário (comum ou adm) na mochila do navegador
        $_SESSION['tipo_user'] = $dados['tipo_user'] ?? 'comum';

        header("Location: ../usuario_logado/usuariologado.php");
        exit;

    } else {
        header("Location: entrar.php?erro=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar - QuimeraGames</title>
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styless.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="/GitHub/ProjIntegrador/Site_QuimeraGames/favicon.ico">
</head>

<body>

    <?php include '../header_footer_global/header_simples.php'; ?>

    <?php if (isset($_GET['erro'])): ?>
        <div id="erro-msg" class="erro-msg">
            Usuário ou senha incorretos!
        </div>
        <script>
            // Remove o parâmetro ?erro=1 da URL
            if (window.location.search.includes("erro")) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        </script>
    <?php endif; ?>

    <main class="main-login">
        <div class="h1box">
            <h1>Entre na QuimeraGames</h1>

            <div class="conteudo">
                <form method="post" action="entrar.php">
                    <div class="div1">
                        <label>Nome de usuário ou email</label>
                        <input type="text" name="usuario" required autocomplete="off">
                    </div>

                    <div class="div2">
                        <label>Senha</label>
                        <div class="input-senha-container">
                            <input type="password" name="senha" id="senha" required>

                            <div class="lembrar">
                                <input type="checkbox" id="togglePassword">
                                <label for="togglePassword" title="Mostrar Senha" class="label-olho">
                                    <img src="../imagens/olho_fechado.png" id="iconFechado" class="icone-senha visivel"
                                        alt="Oculto">
                                    <span id="iconAberto" class="icone-senha oculto">👁️</span>
                                </label>
                            </div>
                        </div>
                    </div> <button type="submit" class="iniciar_sessao">Iniciar Sessão</button>
                </form>

                <a href="#" class="esqueceu_senha" onclick="verificarEmail(event)">Esqueci a senha</a>


                <a href="../sac/suporte.php" class="problemas_iniciar">Problemas para iniciar sessão?</a>
            </div>
        </div>
    </main>

    <footer class="tudoai">
        <div class="primeira_cadastre">
            <label class="primeira">Primeira vez na Quimera?</label>
            <button class="cad" onclick="window.location.href='../Cadastro/cadastro.php'">Cadastre-se</button>
        </div>

        <div class="texto">
            <p>É gratuito e fácil. Descubra milhares de jogos para jogar com milhões de novos amigos.</p>
        </div>
    </footer>

    <script>

        const toggle = document.getElementById("togglePassword");
        const iconFechado = document.getElementById("iconFechado");
        const iconAberto = document.getElementById("iconAberto");
        const senhaInput = document.getElementById("senha");

        toggle.addEventListener("change", function () {
            if (this.checked) {
                // MOSTRA A SENHA
                senhaInput.type = "text";
                iconFechado.classList.replace("visivel", "oculto"); // Esconde a imagem
                iconAberto.classList.replace("oculto", "visivel");  // Mostra o emoji
            } else {
                // ESCONDE A SENHA
                senhaInput.type = "password";
                iconAberto.classList.replace("visivel", "oculto");  // Esconde o emoji
                iconFechado.classList.replace("oculto", "visivel"); // Mostra sua imagem
            }
        });

        document.getElementById("lembrar").addEventListener("change", function () {
            const senha = document.getElementById("senha");
            senha.type = this.checked ? "text" : "password";
        });

        setTimeout(() => {
            const erro = document.getElementById("erro-msg");
            if (erro) {
                erro.style.opacity = "0";
                setTimeout(() => { erro.remove(); }, 500);
            }
        }, 5000);
    </script>

    <script>
        function mostrarErro(msg) {

            const antigo = document.getElementById("erro-msg");
            if (antigo) antigo.remove();

            const div = document.createElement("div");
            div.id = "erro-msg";
            div.className = "erro-msg";
            div.innerText = msg;

            document.body.appendChild(div);

            setTimeout(() => {
                div.style.opacity = "0";

                setTimeout(() => {
                    div.remove();
                }, 500);

            }, 5000);
        }


        function verificarEmail(event) {
            event.preventDefault();

            const usuario = document.querySelector('input[name="usuario"]').value.trim();

            if (usuario === "") {
                mostrarErro("Digite seu email primeiro.");
                return;
            }

            fetch("email_verificar.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "usuario=" + encodeURIComponent(usuario)
            })
                .then(res => res.text())
                .then(resposta => {

                    if (resposta === "ok") {
                        window.location.href = "../confirmar_email/confirmar.php";
                    } else {
                        mostrarErro("Esse email ainda não foi cadastrado.");
                    }

                });
        }</script>

</body>

</html>