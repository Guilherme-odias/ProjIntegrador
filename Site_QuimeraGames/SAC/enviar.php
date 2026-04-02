<?php
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'] ?? '';
    $email_cliente = $_POST['email'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $reclamacao = $_POST['reclamacao'] ?? '';
    $protocolo = $_POST['protocolo'] ?? '';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {

        $mail->SMTPDebug = 0; 

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'quimeraggames@gmail.com';

        $mail->Password = 'okvj nqpq jgqk cexh'; 

        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8'; 
  
        $mail->setFrom('quimeraggames@gmail.com', 'Equipe QuimeraGames');
        
        $mail->addAddress($email_cliente, $nome);

        $mail->isHTML(true);
        $mail->Subject = "Recebemos sua reclamação - Protocolo: $protocolo";
        
        $texto_reclamacao = nl2br(htmlspecialchars($reclamacao));

        $mail->Body = "
            <div style='font-family: Arial, sans-serif; color: #333;'>
                <h2>Olá, $nome!</h2>
                <p>Confirmamos o recebimento da sua mensagem em nosso sistema.</p>
                <hr>
                <p><strong>Número do Protocolo:</strong> $protocolo</p>
                <p><strong>CPF informado:</strong> $cpf</p>
                <p><strong>Sua mensagem:</strong></p>
                <blockquote style='background: #f4f4f4; padding: 10px; border-left: 5px solid #ccc;'>
                    $texto_reclamacao
                </blockquote>
                <hr>
                <p>Nossa equipe analisará sua solicitação e entrará em contato em breve.</p>
            </div>
        ";

        $mail->send();
        
        echo "sucesso";

    } catch (Exception $e) {
        echo "erro: " . $mail->ErrorInfo;
    }

} else {
    echo "acesso_negado";
}
?>