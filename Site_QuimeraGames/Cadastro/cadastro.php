<?php
// O SESSION START DEVE SER A PRIMEIRA LINHA
session_start();
require_once '../conexa.php';

$tipo_comum = "comum";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'] ?? '';
    $comum = $_POST['comum'] ?? $tipo_comum;
    $nome = $_POST['nome'] ?? '';
    $user = $_POST['user'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Validação Email
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cadastro WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        echo "<script>alert('Email já cadastrado!');</script>";
    } else {
        // Validação User
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM cadastro WHERE nome_user = ?");
        $stmt->execute([$user]);
        if ($stmt->fetchColumn() > 0) {
            echo "<script>alert('Usuário já existe!');</script>";
        } else {
            // Validação CPF
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM cadastro WHERE cpf = ?");
            $stmt->execute([$cpf]);
            if ($stmt->fetchColumn() > 0) {
                echo "<script>alert('CPF já cadastrado!');</script>";
            } else {

                // Gerar o codigo
                $codigo = rand(100000, 999999);

                // Salvar os dados em uma sessão
                $_SESSION['cadastro'] = [
                    'email' => $email,
                    'comum' => $comum,
                    'nome' => $nome,
                    'user' => $user,
                    'senha' => $senha,
                    'cpf' => $cpf
                ];

                $_SESSION['codigo_verificacao'] = $codigo;
                $_SESSION['email_verificacao'] = $email;

                require_once '../PHPMailer/src/PHPMailer.php';
                require_once '../PHPMailer/src/SMTP.php';
                require_once '../PHPMailer/src/Exception.php';

                $mail = new PHPMailer\PHPMailer\PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'quimeraggames@gmail.com';
                    $mail->Password = 'okvj nqpq jgqk cexh';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('quimeraggames@gmail.com', 'Quimera');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Verification code';
                    $mail->Body = "
                        <h2>Bem-vindo a Quimera 🚀</h2>
                        <p>Seu código de verificação é:</p>
                        <h1 style='color:red;'>$codigo</h1>
                    ";

                    $mail->send();

                    header("Location: ../Verificar_email/index.php");
                    exit;

                } catch (Exception $e) {
                    echo "<script>alert('Erro ao enviar email: {$mail->ErrorInfo}');</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - QuimeraGames</title>
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="cStyles.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php include '../header_footer_global/header_simples.php'; ?>

    <main class="main-cadastro">
        <div class="container-animado">
            <form class="card-cadastro" method="POST" onsubmit="return validarForm()">

                <input type="hidden" id="comum" name="comum" value="comum">

                <h1>Crie sua Conta</h1>

                <div class="input-group">
                    <input type="email" placeholder=" " id="email" name="email" required autocomplete="off">
                    <label>Email</label>
                </div>

                <div class="row-inputs">
                    <div class="input-group">
                        <input type="text" placeholder=" " id="nome" name="nome" required autocomplete="off">
                        <label>Nome</label>
                    </div>

                    <div class="input-group">
                        <input type="text" placeholder=" " id="user" name="user" required autocomplete="off">
                        <label>Usuário</label>
                    </div>
                </div>

                <div class="input-group">
                    <input type="text" placeholder=" " id="cpf" name="cpf" maxlength="14" required autocomplete="off">
                    <label>CPF</label>
                </div>

                <div class="input-group">
                    <input type="password" placeholder=" " id="senha" name="senha" required>
                    <label>Senha</label>

                    <div class="lembrar-cadastro">
                        <input type="checkbox" id="togglePassword">
                        <label for="togglePassword" title="Mostrar Senha" class="label-olho">
                            <img src="../imagens/olho_fechado.png" id="iconFechado" class="icone-senha visivel"
                                alt="Oculto">
                            <span id="iconAberto" class="icone-senha oculto">👁️</span>
                        </label>
                    </div>
                </div>

                <div class="input-group">
                    <input type="password" placeholder=" " id="confirme" name="confirme" required>
                    <label>Confirmar senha</label>
                </div>

                <button class="btn" id="btn" type="submit"
                    onclick="setTimeout(() => this.disabled=true, 10);">Cadastrar</button>

                <div class="footer-voltar">
                    <button type="button" class="btnVoltar" onclick="window.history.back()">❮</button>
                    <span class="labelVoltar">Voltar</span>
                </div>
            </form>
        </div>
    </main>

    <footer class="rodape">
        <div class="primeira_cadastre">
            <label class="primeira">Já tem uma conta? Faça login para continuar.</label>
            <button class="cad" onclick="window.location.href='../Entrar/Entrar.php'">Entrar</button>
        </div>

        <div class="texto">
            <p>É gratuito e fácil. Descubra milhares de jogos para jogar com milhões de novos amigos.</p>
        </div>
    </footer>

    <script src="script.js"></script>

    <script>
        const toggle = document.getElementById("togglePassword");
        const iconFechado = document.getElementById("iconFechado");
        const iconAberto = document.getElementById("iconAberto");
        const senhaInput = document.getElementById("senha");
        const confirmeInput = document.getElementById("confirme");

        toggle.addEventListener("change", function () {
            if (this.checked) {
                senhaInput.type = "text";
                confirmeInput.type = "text";
                iconFechado.classList.replace("visivel", "oculto");
                iconAberto.classList.replace("oculto", "visivel");
            } else {
                senhaInput.type = "password";
                confirmeInput.type = "password";
                iconAberto.classList.replace("visivel", "oculto");
                iconFechado.classList.replace("oculto", "visivel");
            }
        });
    </script>
</body>

</html>