<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = htmlspecialchars(trim($_POST['nome']));
    $email_cliente = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $cpf = htmlspecialchars(trim($_POST['cpf']));
    $reclamacao = nl2br(htmlspecialchars(trim($_POST['reclamacao'])));
    $protocolo = htmlspecialchars(trim($_POST['protocolo']));

    $mail = new PHPMailer(true);

    try {
        // 🔴 DEBUG (deixe 2 só pra teste)
        $mail->SMTPDebug = 2;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'quimeraggames@gmail.com';
        $mail->Password = 'SUA_SENHA_DE_APP_AQUI';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('quimeraggames@gmail.com', 'Equipe QuimeraGames');
        $mail->addAddress($email_cliente, $nome);

        $mail->isHTML(true);
        $mail->Subject = "Protocolo: $protocolo";

        $mail->Body = "
        <h2>Olá, $nome!</h2>
        <p>Recebemos sua solicitação.</p>
        <p><strong>Protocolo:</strong> $protocolo</p>
        <p><strong>CPF:</strong> $cpf</p>
        <p><strong>Mensagem:</strong><br>$reclamacao</p>
        ";

        $mail->send();

        // ✔️ RETORNO LIMPO PRO JS
        echo "sucesso";

    } catch (Exception $e) {
        // 🔴 MOSTRA ERRO REAL NO CONSOLE (IMPORTANTE)
        echo "erro: " . $mail->ErrorInfo;
    }

} else {
    echo "acesso_negado";
}