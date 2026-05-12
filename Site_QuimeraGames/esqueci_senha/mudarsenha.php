<?php
session_start();
require_once("../conexa.php");

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $senha1 = trim($_POST["senha1"] ?? "");
    $senha2 = trim($_POST["senha2"] ?? "");
    $email  = $_SESSION['email_recuperacao'] ?? "";

    if ($senha1 == "" || $senha2 == "") {
        $erro = "Preencha os dois campos.";
    }
    elseif ($senha1 !== $senha2) {
        $erro = "As senhas devem ser iguais.";
    }
    else {

        $stmt = $pdo->prepare("UPDATE cadastro SET senha = ? WHERE email = ?");
        $stmt->execute([$senha1, $email]);

        header("Location: ../Entrar/entrar.php");
        exit;
    }
}
?>
<!DOCTYPE html> 
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudar senha - QuimeraGames</title>
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="/GitHub/ProjIntegrador/Site_QuimeraGames/favicon.ico">
</head>

<body>

    <?php include '../header_footer_global/header_simples.php'; ?>

<?php if (!empty($erro)): ?>
<div id="erro-msg" class="erro-msg">
    <?php echo $erro; ?>
</div>
<?php endif; ?>

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
            <h1>Troque sua senha</h1>

            <div class="conteudo">
                <form method="post" action="">
                    <div class="div2">

                    <input type="text"class="email_user" value="<?php echo $_SESSION['email_recuperacao'] ?? ''; ?>"readonly>

                        <label>Nova Senha</label>
                        <div class="input-senha-container">
                            <input type="password" name="senha1" id="senha1" required>

                            <div class="lembrar">
                                <input type="checkbox" id="togglePassword1">
                                <label for="togglePassword1" title="Mostrar Senha" class="label-olho">
                                    <img src="../imagens/olho_fechado.png" id="iconFechado" class="icone-senha visivel"
                                        alt="Oculto">
                                    <span id="iconAberto" class="icone-senha oculto">👁️</span>
                                </label>
                            </div>
                        </div>

                    <div class="div2">
                        <label>Senha</label>
                        <div class="input-senha-container">
                            <input type="password" name="senha2" id="senha2" required>

                            <div class="lembrar">
                                <input type="checkbox" id="togglePassword2">
                                <label for="togglePassword2" title="Mostrar Senha" class="label-olho">
                                    <img src="../imagens/olho_fechado.png" id="iconFechado" class="icone-senha visivel"
                                        alt="Oculto">
                                    <span id="iconAberto" class="icone-senha oculto">👁️</span>
                                </label>
                            </div>
                        </div>
                    </div> 
                    <button type="submit" class="iniciar_sessao">Atualizar Senha</button>
                </form>

            </div>
        </div>
    </main>

<script>
document.querySelectorAll(".input-senha-container").forEach(container => {

    const checkbox = container.querySelector("input[type='checkbox']");
    const senha = container.querySelector("input[type='password']");
    const olhoFechado = container.querySelector("img");
    const olhoAberto = container.querySelector("span");

    checkbox.addEventListener("change", function () {

        if (this.checked) {

            senha.type = "text";

            olhoFechado.classList.remove("visivel");
            olhoFechado.classList.add("oculto");

            olhoAberto.classList.remove("oculto");
            olhoAberto.classList.add("visivel");

        } else {

            senha.type = "password";

            olhoAberto.classList.remove("visivel");
            olhoAberto.classList.add("oculto");

            olhoFechado.classList.remove("oculto");
            olhoFechado.classList.add("visivel");

        }

    });

});
</script>

<?php include '../header_footer_global/footer.php'; ?>

<script>
setTimeout(() => {
    const erro = document.getElementById("erro-msg");

    if (erro) {
        erro.style.opacity = "0";

        setTimeout(() => {
            erro.remove();
        }, 500);
    }
}, 5000);
</script>

</body>

</html>