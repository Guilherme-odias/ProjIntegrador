<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro Quimera</title>

<link rel="stylesheet" href="cStyles.css">
</head>

<body>
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
?>
<div class="container">

    <form class="card" method="POST" onsubmit="return validarForm()">

        <h1>Tela Cadastro</h1>

        <div class="input-group">
            <input type="email" id="email" name="email" required>
            <label>Email</label>
        </div>

        <div class="input-group">
            <input type="text" id="nome" name="nome" required>
            <label>Nome</label>
        </div>

        <div class="input-group">
            <input type="text" id="user" name="user" required>
            <label>User</label>
        </div>

        <div class="input-group">
            <input type="text" id="cpf" name="cpf" maxlength="14" required>
            <label>CPF</label>
        </div>

        <div class="input-group">
            <input type="password" id="senha" name="senha" required>
            <label>Senha</label>
        </div>

        <div class="input-group">
            <input type="password" id="confirme" name="confirme" required>
            <label>Confirmar senha</label>
        </div>

        <div class="check">
            <input type="checkbox" onclick="mostrarSenha()"> Mostrar senha
        </div>

        <button class="btn" id="btn" name="acao" value="cadastrar">Cadastrar</button>

        <div class="footer">
            <button type="button" class="voltar" onclick="voltarPagina()">←</button>
            <span>Voltar</span>
        </div>

    </form>

</div>
<?php 
require_once '../conexa.php';



if($_POST) {

// Validação Email
$stmt = $pdo->prepare("SELECT COUNT(*) FROM cadastro WHERE email = ?");
$stmt->execute([$email]);
if($stmt->fetchColumn() > 0){
    echo "Email já cadastrado!";
    exit;
}
// Validação User
$stmt = $pdo->prepare("SELECT COUNT(*) FROM cadastro WHERE nome_user = ?");
$stmt->execute([$user]);
if($stmt->fetchColumn() > 0){
    echo "Usuário já existe!";
    exit;
}
// Validação CPF
$stmt = $pdo->prepare("SELECT COUNT(*) FROM cadastro WHERE cpf = ?");
$stmt->execute([$cpf]);
if($stmt->fetchColumn() > 0){
    echo "CPF já cadastrado!";
    exit;
}
else {
    session_start();

// GERAR CÓDIGO
$codigo = rand(100000, 999999);

// SALVAR NA SESSION
$_SESSION['cadastro'] = [
    'email' => $email,
    'nome' => $nome,
    'user' => $user,
    'senha' => $senha, 
    'cpf' => $cpf
];

$_SESSION['codigo_verificacao'] = $codigo;

$mail = new PHPMailer(true);

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
    $mail->Subject = 'Código de verificação';
    $mail->Body = "
        <h2>Bem-vindo ao Quimera 🚀</h2>
        <p>Seu código de verificação é:</p>
        <h1 style='color:red;'>$codigo</h1>
    ";

    $mail->send();

} catch (Exception $e) {
    echo "Erro: {$mail->ErrorInfo}";
}
// REDIRECIONAR
header("Location: ../Verificar_email/index.php");
exit;
}
}
?>

<script src="script.js"></script>

</body>
</html>