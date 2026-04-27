<?php
// O SESSION START DEVE SER OBRIGATORIAMENTE A PRIMEIRA LINHA!
session_start();

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

        header("Location: ../Usuario_Logado/usuariologado.php");
        exit;
    } else {
        echo "<script>alert('Código inválido!');</script>";
    }
}

if (isset($_POST['reenviar'])) {
    $email = $_SESSION['email_verificacao'] ?? '';
    $codigo = rand(100000, 999999);
    $_SESSION['codigo_verificacao'] = $codigo;

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
        $mail->Subject = 'Código de Verificação';
        $mail->Body = "
            <h2>Bem-vindo à QuimeraGames 🚀</h2>
            <p>Seu código de verificação é:</p>
            <h1 style='color:#e62429; font-size: 32px; letter-spacing: 5px;'>$codigo</h1>
        ";
        $mail->send();
    } catch (Exception $e) {
        echo "<script>alert('Erro ao enviar email: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifique seu email - QuimeraGames</title>
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php include '../header_footer_global/header_simples.php'; ?>

    <main class="main-centralizado">
        <form method="POST" class="form-verificacao">
            <div class="card-moderno">

                <div class="card-header">
                    <div class="icon-email">✉️</div>
                    <h2>Verifique seu Email</h2>
                    <p>Enviamos um código de verificação de 6 dígitos para o seu email.</p>
                </div>

                <div class="card-body">
                    <input type="text" name="codigo" id="codigo" class="input-codigo" placeholder="000000" maxlength="6"
                        required autocomplete="off">

                    <button type="submit" name="verificar" class="btn-verificar">Verificar Conta</button>
                    <button type="submit" name="reenviar" class="btn-reenviar">Não recebeu? <span>Reenviar
                            código</span></button>
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

</body>

</html>