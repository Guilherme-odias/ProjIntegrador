<?php
require_once '../conexa.php';

$token = $_GET['token'] ?? '';
$status = '';
$mensagem = '';
$icone = '';

// Lógica de verificação do Token
if (!$token) {
    $status = 'erro';
    $mensagem = 'Token inválido ou não fornecido.';
    $icone = 'fa-solid fa-circle-xmark';
} else {
    $stmt = $pdo->prepare("SELECT * FROM suporte WHERE token = ?");
    $stmt->execute([$token]);

    if ($stmt->rowCount() == 0) {
        $status = 'erro';
        $mensagem = 'Token inválido ou expirado.';
        $icone = 'fa-solid fa-circle-xmark';
    } else {
        // Atualiza para confirmado
        $pdo->prepare("UPDATE suporte SET confirmado = 1 WHERE token = ?")->execute([$token]);
        $status = 'sucesso';
        $mensagem = 'E-mail confirmado com sucesso!<br>Sua solicitação foi validada e será analisada.';
        $icone = 'fa-solid fa-circle-check';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de E-mail</title>

    <link rel="stylesheet" href="../css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="/Site_QuimeraGames/favicon.ico">

    <?php if ($status === 'sucesso'): ?>
        <meta http-equiv="refresh" content="5;url=../index/index.php">
    <?php endif; ?>

    <style>
        /* Estilos específicos para esta tela, mantendo o padrão Premium Dark */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #0b0f1a;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-confirmacao {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card-mensagem {
            background: linear-gradient(to top, #132041, #1b3c91);
            padding: 40px 30px;
            border-radius: 16px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            animation: fadeUp 0.6s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-mensagem i {
            font-size: 65px;
            margin-bottom: 20px;
        }

        .sucesso i {
            color: #4caf50;
        }

        /* Verde para sucesso */
        .erro i {
            color: #e62429;
        }

        /* Vermelho para erro */

        .card-mensagem h2 {
            margin-bottom: 15px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .card-mensagem p {
            color: #a0aec0;
            line-height: 1.5;
            margin-bottom: 25px;
            font-size: 16px;
        }

        .btn-inicio {
            display: inline-block;
            background: #e62429;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(230, 36, 41, 0.3);
        }

        .btn-inicio:hover {
            background: #c0181d;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(230, 36, 41, 0.5);
        }

        .texto-redirecionamento {
            font-size: 13px;
            margin-top: 20px;
            color: #7b8ba4;
        }
    </style>
</head>

<body>

    <header>
        <?php include '../header_footer_global/header_simples.php'; ?>
    </header>

    <main class="main-confirmacao">
        <div class="card-mensagem <?php echo $status; ?>">
            <i class="<?php echo $icone; ?>"></i>

            <h2><?php echo $status == 'sucesso' ? 'E-mail Confirmado!' : 'Ops! Algo deu errado.'; ?></h2>

            <p><?php echo $mensagem; ?></p>

            <a href="../index/index.php" class="btn-inicio">Ir para a Tela Inicial</a>

            <?php if ($status === 'sucesso'): ?>
                <div class="texto-redirecionamento">
                    Você será redirecionado automaticamente em 5 segundos...
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>