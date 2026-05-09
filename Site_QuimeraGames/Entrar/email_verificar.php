<?php
session_start();
require_once("../conexa.php");

$usuario = strtolower(trim($_POST['usuario'] ?? ''));

$stmt = $pdo->prepare("SELECT email, nome FROM cadastro WHERE LOWER(email) = ?");
$stmt->execute([$usuario]);

$dados = $stmt->fetch(PDO::FETCH_ASSOC);

if ($dados) {

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

        $mail->Body = "
        <h2>Recuperação de senha</h2>
        <p>Olá {$dados['nome']},</p>
        <p>Seu código para recuperar senha é:</p>
        <h1>$codigo</h1>
        <p>Se não foi você, ignore este email.</p>
        ";

        $mail->send();

        echo "ok";

    } catch (Exception $e) {
        echo "erro";
    }

} else {
    echo "naoexiste";
}
?>