<?php
header('Content-Type: application/json');

require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../conexa.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(['sucesso' => false, 'erro' => 'Acesso negado']);
    exit;
}

// ===== FUNÇÃO DE VALIDAÇÃO DE EMAIL =====
function validarEmailCompleto($email) {

    // 1. Formato
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Formato de e-mail inválido.";
    }

    // 2. Domínio
    $dominio = substr(strrchr($email, "@"), 1);

    if (!$dominio) {
        return "Domínio inválido.";
    }

    // 3. Verificar DNS real
    if (!checkdnsrr($dominio, "MX") && !checkdnsrr($dominio, "A")) {
        return "Domínio de e-mail não existe.";
    }

    // 4. Bloqueio básico de domínios fake
    $bloqueados = ['test.com', 'fake.com', 'email.com', 'abc.com'];
    if (in_array(strtolower($dominio), $bloqueados)) {
        return "Domínio de e-mail não permitido.";
    }

    return true;
}

// ===== PEGAR DADOS =====
$nome  = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$cpf   = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
$msg   = trim($_POST['reclamacao'] ?? '');

// ===== VALIDAÇÕES =====
if (strlen($nome) < 3) {
    echo json_encode(['sucesso' => false, 'erro' => 'Nome inválido']); exit;
}

// 🔥 NOVA VALIDAÇÃO DE EMAIL
$validacaoEmail = validarEmailCompleto($email);

if ($validacaoEmail !== true) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $validacaoEmail
    ]);
    exit;
}

if (strlen($cpf) != 11) {
    echo json_encode(['sucesso' => false, 'erro' => 'CPF inválido']); exit;
}

if (strlen($msg) < 20) {
    echo json_encode(['sucesso' => false, 'erro' => 'Mensagem muito curta']); exit;
}

// ===== GERAR TOKEN E PROTOCOLO =====
$token = bin2hex(random_bytes(32));
$protocolo = strtoupper(substr(bin2hex(random_bytes(8)), 0, 8));

// ===== SALVAR NO BANCO =====
try {
    $stmt = $pdo->prepare("
        INSERT INTO suporte 
        (nome, email, cpf, mensagem, protocolo, token, confirmado, data_envio)
        VALUES (:nome, :email, :cpf, :msg, :protocolo, :token, 0, NOW())
    ");

    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':cpf' => $cpf,
        ':msg' => $msg,
        ':protocolo' => $protocolo,
        ':token' => $token
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => 'Erro banco: ' . $e->getMessage()
    ]);
    exit;
}

// ===== ENVIO DE EMAIL =====
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'quimeraggames@gmail.com';
    $mail->Password = 'okvj nqpq jgqk cexh'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // Ative se quiser ver erro detalhado
    // $mail->SMTPDebug = 2;

    $mail->setFrom('SEU_EMAIL@gmail.com', 'QuimeraGames');

    // envia para o usuário (como já estava)
    $mail->addAddress($email, $nome);

    // envia cópia para você (receber reclamação)
    $mail->addCC('SEU_EMAIL@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = "Recebemos sua solicitação - Protocolo: $protocolo";

    $texto_reclamacao = nl2br(htmlspecialchars($msg));

    $link = "http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/Suporte/confirmar.php?token=$token";

$mail->Body = "
    <div style='font-family: Arial; max-width:600px;'>
        <h2>Confirmação de E-mail</h2>

        <p>Olá <strong>$nome</strong>,</p>

        <p>Recebemos sua solicitação. Para confirmar que este e-mail é válido, clique no botão abaixo:</p>

        <a href='$link' style='display:inline-block;padding:12px 20px;background:#1b3c91;color:#fff;border-radius:6px;text-decoration:none;'>
            Confirmar meu e-mail
        </a>

        <hr>

        <p><strong>Protocolo:</strong> $protocolo</p>

        <p style='font-size:12px;color:#777;'>
            Se você não fez essa solicitação, ignore este e-mail.
        </p>
    </div>
";

    $mail->send();

    echo json_encode([
        'sucesso' => true,
        'protocolo' => $protocolo
    ]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => 'Erro SMTP: ' . $mail->ErrorInfo
    ]);
}