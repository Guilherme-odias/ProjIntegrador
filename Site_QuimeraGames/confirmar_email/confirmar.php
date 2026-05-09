<?php
// O SESSION START DEVE SER OBRIGATORIAMENTE A PRIMEIRA LINHA!
session_start();

$emailMostrado = $_GET['email'] ?? '';

if (isset($_POST['verificar'])) {
    $codigoDigitado = $_POST['codigo'];

    if ($codigoDigitado == $_SESSION['codigo_verificacao']) {
        require_once '../conexa.php';

        $dados = $_SESSION['cadastro'];

        $sql = "INSERT INTO cadastro (email, tipo_user, nome, nome_user, senha, cpf) 
                VALUES (?, 'comum', ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $dados['email'],
            $dados['nome'],
            $dados['user'],
            $dados['senha'],
            $dados['cpf']
        ]);

        // Limpa a sessão
        session_destroy();

        header("Location: ../usuario_logado/usuariologado.php");
        exit;
    } else {
    $erro = "Código inválido!";
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reenviar'])) {
    $email = $_SESSION['email_recuperacao'] ?? '';
    $codigo = rand(100000, 999999);
    $_SESSION['codigo_verificacao'] = $codigo;
    $nome = $_SESSION['cadastro']['nome'] ?? '';

    require_once '../phpmailer/src/phpmailer.php';
    require_once '../phpmailer/src/smtp.php';
    require_once '../phpmailer/src/exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->CharSet = 'UTF-8';
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
        $mail->Subject = 'Código de recuperação de senha - QuimeraGames';
        $mail->addEmbeddedImage(__DIR__ . '/../imagens/logo.png', 'logo_cid', 'logo.png');
        $mail->Body = "
<!DOCTYPE html>
<html lang='pt-BR'>
<head><meta charset='UTF-8'></head>

<body style='margin:0; padding:0; background:#f2f2f2; font-family:Arial, sans-serif;'>

<table width='100%' bgcolor='#f2f2f2' cellpadding='0' cellspacing='0'>
<tr>
<td align='center'>

<table width='500' cellpadding='0' cellspacing='0'
style='background:#ffffff; margin-top:40px; border-radius:8px; padding:30px;'>

<tr>
<td align='center' style='padding-bottom:20px;'>
<img src='cid:logo_cid' width='120'>
</td>
</tr>

<tr>
<td style='font-size:22px; font-weight:bold; text-align:left; padding-bottom:20px;'>
Recuperação de senha
</td>
</tr>

<tr>
<td align='center' style='padding:20px 0;'>
<div style='background:#f4f4f4; padding:20px; border-radius:8px; font-size:28px; font-weight:bold; letter-spacing:3px;'>
$codigo
</div>
</td>
</tr>

<tr>
<td style='font-size:14px; color:#555; padding-top:10px; line-height:1.6;'>

Olá, <br><br>

Recebemos uma solicitação para redefinir sua senha da <b>Quimera Games</b>.<br>

Use o código acima para continuar a recuperação da conta.<br><br>

⚠️ Se não foi você, ignore este email.

</td>
</tr>

<tr>
<td style='font-size:12px; color:#999; padding-top:30px; text-align:center;'>
© 2026 Quimera Games<br>
Todos os direitos reservados.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>";
        $mail->send();
    } catch (Exception $e) {

    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirme seu email - QuimeraGames</title>
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="/GitHub/ProjIntegrador/Site_QuimeraGames/favicon.ico">
</head>

<body>

<?php if (isset($sucesso)): ?>
<div id="sucesso-msg" class="sucesso-msg">
    <?php echo $sucesso; ?>
</div>
<?php endif; ?>

<?php if (isset($erro)): ?>
    <div id="erro-msg" class="erro-msg">
        <?php echo $erro; ?>
    </div>
<?php endif; ?>

    <a href="../index/index.php" class="logo-link">
        <img class="logo-auth" src="../imagens/logo.png" alt="QuimeraGames Logo">
    </a>

    <main class="main-centralizado">
        <form method="POST" class="form-verificacao">
            <div class="card-moderno">

                <div class="card-header">
                    <div class="icon-email">✉️</div>
                    <h2>Confirme seu Email</h2>
                    <p>Enviamos um código de verificação de 6 dígitos para o seu email.</p>
                </div>

                <div class="card-body">
                    <input type="text"class="email_user" value="<?php echo $_SESSION['email_recuperacao'] ?? ''; ?>"readonly>

                    <input type="text" name="codigo" id="codigo" class="input-codigo" placeholder="000000" maxlength="6"
                        required autocomplete="off">

                    <button type="submit" name="verificar" class="btn-verificar">Confirmar Conta</button>
                    <button type="submit" name="reenviar" value="1" class="btn-reenviar" formnovalidate> Não recebeu? <span>Reenviar código</span></button>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn-voltar" onclick="window.history.back();">
                        <span class="seta">❮</span> Voltar
                    </button>
                </div>

            </div>
        </form>
    </main>

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