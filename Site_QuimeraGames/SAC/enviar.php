<?php
header('Content-Type: application/json');

require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(['sucesso' => false, 'erro' => 'Acesso negado.']);
    exit;
}

$nome      = htmlspecialchars(trim($_POST['nome'] ?? ''));
$email     = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$cpf       = preg_replace('/[^\d]/', '', $_POST['cpf'] ?? '');
$mensagem  = htmlspecialchars(trim($_POST['reclamacao'] ?? ''));

if (strlen($nome) < 3) {
    echo json_encode(['sucesso' => false, 'erro' => 'Nome inválido.']); exit;
}
if (!$email) {
    echo json_encode(['sucesso' => false, 'erro' => 'E-mail inválido.']); exit;
}
if (strlen($cpf) !== 11) {
    echo json_encode(['sucesso' => false, 'erro' => 'CPF inválido.']); exit;
}
if (strlen($mensagem) < 20) {
    echo json_encode(['sucesso' => false, 'erro' => 'Mensagem muito curta.']); exit;
}

$protocolo = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'quimeraggames@gmail.com';
    $mail->Password   = 'okvj nqpq jgqk cexh';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->SMTPDebug  = 0;

    $mail->setFrom('quimeraggames@gmail.com', 'Equipe QuimeraGames');
    $mail->addAddress($email, $nome);

    $mail->isHTML(true);
    $mail->Subject = "Recebemos sua solicitação - Protocolo: $protocolo";

    $texto_reclamacao = nl2br(htmlspecialchars($mensagem));

    $mail->Body = "
        <div style='font-family: Arial, sans-serif; color: #333;'>
            <h2>Olá, $nome!</h2>
            <p>Confirmamos o recebimento da sua mensagem.</p>
            <hr>
            <p><strong>Protocolo:</strong> $protocolo</p>
            <p><strong>CPF informado:</strong> $cpf</p>
            <p><strong>Sua mensagem:</strong></p>
            <blockquote style='background:#f4f4f4; padding:10px; border-left:5px solid #ccc;'>
                $texto_reclamacao
            </blockquote>
            <hr>
            <p>Nossa equipe entrará em contato em breve.</p>
        </div>
    ";

    $mail->send();
    echo json_encode(['sucesso' => true, 'protocolo' => $protocolo]);

} catch (Exception $e) {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao enviar e-mail: ' . $mail->ErrorInfo]);
}
?>