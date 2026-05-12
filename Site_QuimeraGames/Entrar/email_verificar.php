<?php
session_start();
require_once("../conexa.php");

$usuario = strtolower(trim($_POST['usuario'] ?? ''));

$stmt = $pdo->prepare("
SELECT email, nome 
FROM cadastro 
WHERE LOWER(email) = ? 
   OR LOWER(nome_user) = ?
");

$stmt->execute([$usuario, $usuario]);

$dados = $stmt->fetch(PDO::FETCH_ASSOC);


if ($dados) {

    $nome = $dados['nome'];

    $_SESSION['email_recuperacao'] = $dados['email'];

    $codigo = rand(100000, 999999);
    $_SESSION['codigo_verificacao'] = $codigo;

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

        $mail->setFrom('quimeraggames@gmail.com', 'Quimera Games');
        $mail->addAddress($dados['email']);

        $mail->isHTML(true);
        $mail->Subject = 'Código de recuperação - QuimeraGames';
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

Olá, <b>$nome</b>,<br><br>

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

        echo "ok";

    } catch (Exception $e) {
        echo "erro";
    }

} else {
    echo "naoexiste";
}
?>