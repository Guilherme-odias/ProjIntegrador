<?php
// 1. O PHP recebe as variáveis que o JavaScript enviou por POST
$nome = $_POST['nome'];
$email = $_POST['email']; // E-mail preenchido no formulário
$cpf = $_POST['cpf'];
$reclamacao = $_POST['reclamacao'];
$protocolo = $_POST['protocolo'];

// 2. Destinatário: agora o e-mail vai para o cliente que preencheu o formulário
$para = $email; 
$assunto = "Confirmação de Suporte - Protocolo: " . $protocolo;

// 3. Montamos o texto que vai no corpo do e-mail para o cliente
$mensagem = "Olá, " . $nome . "!\n\n";
$mensagem .= "Recebemos a sua solicitação. Guarde o seu número de protocolo: " . $protocolo . "\n\n";
$mensagem .= "Abaixo está a cópia das informações enviadas:\n";
$mensagem .= "CPF: " . $cpf . "\n";
$mensagem .= "Sua Reclamação/Sugestão:\n";
$mensagem .= $reclamacao . "\n\n";
$mensagem .= "Em breve nossa equipe entrará em contato.";

// 4. Cabeçalhos básicos (Mude o "From" para o e-mail oficial do seu site)
$cabecalhos = "From: suporte@seusite.com\r\n";
$cabecalhos .= "Reply-To: suporte@seusite.com\r\n";

// 5. O comando mail() tenta enviar. Se der certo, ele avisa o JavaScript com a palavra "sucesso"
if (mail($para, $assunto, $mensagem, $cabecalhos)) {
    echo "sucesso";
} else {
    echo "erro";
}
?>