<?php
// 1. O PHP recebe as variáveis que o JavaScript enviou por POST
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$reclamacao = $_POST['reclamacao'];
$protocolo = $_POST['protocolo'];

// 2. Configurações do seu e-mail (quem vai receber)
$para = "SEU_EMAIL_AQUI@dominio.com"; 
$assunto = "Novo Suporte - Protocolo: " . $protocolo;

// 3. Montamos o texto que vai no corpo do e-mail
$mensagem = "Novo contato recebido do sistema de suporte:\n\n";
$mensagem .= "Nome: " . $nome . "\n";
$mensagem .= "E-mail: " . $email . "\n";
$mensagem .= "CPF: " . $cpf . "\n\n";
$mensagem .= "Mensagem da Reclamação/Sugestão:\n";
$mensagem .= $reclamacao . "\n";

// 4. Cabeçalhos básicos para o e-mail não ir pro spam direto
$cabecalhos = "From: suporte@seusite.com\r\n";
$cabecalhos .= "Reply-To: " . $email . "\r\n";

// 5. O comando mail() tenta enviar. Se der certo, ele avisa o JavaScript com a palavra "sucesso"
if (mail($para, $assunto, $mensagem, $cabecalhos)) {
    echo "sucesso";
} else {
    echo "erro";
}
?>