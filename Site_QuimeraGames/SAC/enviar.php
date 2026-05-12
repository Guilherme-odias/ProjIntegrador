<?php
ob_start();

// Transforma erros em exceções
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

header('Content-Type: application/json');

try {
    require_once '../phpmailer/src/phpmailer.php';
    require_once '../phpmailer/src/smtp.php';
    require_once '../phpmailer/src/exception.php';
    require_once '../conexa.php';
} catch (Throwable $e) {
    ob_end_clean();
    echo json_encode(['sucesso' => false, 'erro' => 'Erro interno de dependências.']);
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ===== CONFIGURAÇÕES =====
$SMTP_USUARIO   = 'quimeraggames@gmail.com';
$SMTP_SENHA     = 'cyrsiodgwwzvwuqx'; 
$EMAIL_COPIA    = 'quimeraggames@gmail.com';
$BASE_URL       = 'http://localhost/GitHub/ProjIntegrador/Site_QuimeraGames/sac';
$MAILBOX_KEY    = 'dc52e8e940dbe14092adde24ea552f61'; 
// =========================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    ob_end_clean();
    echo json_encode(['sucesso' => false, 'erro' => 'Acesso negado']);
    exit;
}

/**
 * Função de Validação Sênior (MailboxLayer + Regras de Negócio)
 */
function validarEmailSenior($email, $apiKey) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Formato de e-mail inválido.";

    // 1. Blacklist de domínios inúteis
    $fake_domains = ['teste.com', 'test.com', 'exemplo.com', 'example.com', 'asdf.com'];
    $domain = strtolower(substr(strrchr($email, "@"), 1));
    if (in_array($domain, $fake_domains)) return "E-mails de teste não são permitidos.";

    // 2. Chamada API
    $url = "http://apilayer.net/api/check?access_key=$apiKey&email=$email&smtp=1&format=1";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8);
    $res = curl_exec($ch);
    curl_close($ch);

    if (!$res) return "Erro temporário na validação. Tente mais tarde.";

    $data = json_decode($res, true);
    if (isset($data['success']) && $data['success'] === false) return "Erro técnico na validação.";

    // 3. Regras de Bloqueio Rigorosas
    if ($data['disposable']) return "E-mails temporários não são aceitos.";
    if (!$data['mx_found'])  return "O domínio informado não recebe e-mails.";
    
    // Bloqueia Catch-all (domínios que aceitam qualquer coisa inventada)
    if (isset($data['catch_all']) && $data['catch_all'] == true) {
        return "Este provedor de e-mail não é confiável para suporte. Use Gmail ou Outlook.";
    }

    if ($data['smtp_check'] && $data['score'] >= 0.6) return true;

    return "Este e-mail parece não existir. Verifique a digitação.";
}

// Captura e Limpeza
$nome  = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$cpf   = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
$msg   = trim($_POST['reclamacao'] ?? '');

// 🚨 DETECTOR DE GIBBERISH (Bater no teclado)
// Bloqueia se houver 6 consoantes seguidas na mensagem ou no nome do e-mail
if (preg_match('/[bcdfghjklmnpqrstvwxz]{6,}/i', $msg) || preg_match('/[bcdfghjklmnpqrstvwxz]{6,}/i', $email)) {
    ob_end_clean();
    echo json_encode(['sucesso' => false, 'erro' => 'Conteúdo detectado como spam ou digitação aleatória.']);
    exit;
}

// Validação de E-mail via API e Regras
$validacao = validarEmailSenior($email, $MAILBOX_KEY);
if ($validacao !== true) {
    ob_end_clean();
    echo json_encode(['sucesso' => false, 'erro' => $validacao]);
    exit;
}

// Outras Validações
if (strlen($nome) < 3) { ob_end_clean(); echo json_encode(['sucesso' => false, 'erro' => 'Nome muito curto.']); exit; }
if (strlen($cpf) != 11) { ob_end_clean(); echo json_encode(['sucesso' => false, 'erro' => 'CPF inválido.']); exit; }
if (strlen($msg) < 20) { ob_end_clean(); echo json_encode(['sucesso' => false, 'erro' => 'Mensagem muito curta.']); exit; }

// Protocolo e Token
$token = bin2hex(random_bytes(32));
$protocolo = strtoupper(substr(bin2hex(random_bytes(8)), 0, 8));

try {
    $stmt = $pdo->prepare("INSERT INTO suporte (nome, email, cpf, mensagem, protocolo, token, confirmado, data_envio) VALUES (?, ?, ?, ?, ?, ?, 0, NOW())");
    $stmt->execute([$nome, $email, $cpf, $msg, $protocolo, $token]);

    // Envio PHPMailer
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $SMTP_USUARIO;
    $mail->Password   = $SMTP_SENHA;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom($SMTP_USUARIO, 'QuimeraGames');
    $mail->addAddress($email);
    
    $mail->isHTML(true);
    $mail->Subject = "Confirme seu suporte: $protocolo";
    $link = $BASE_URL . "/confirmar.php?token=$token";
    $mail->Body = "Olá $nome, confirme seu e-mail no link: <a href='$link'>$link</a>";

    $mail->send();

    ob_end_clean();
    echo json_encode(['sucesso' => true, 'protocolo' => $protocolo]);

} catch (Exception $e) {
    ob_end_clean();
    echo json_encode(['sucesso' => false, 'erro' => 'Erro no envio do e-mail de confirmação.']);
}