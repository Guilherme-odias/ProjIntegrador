<?php
session_start();
require_once '../conexa.php';

// 1. Recupera o ID do usuário de forma segura caso o navegador esqueça
if (!isset($_SESSION['id_user']) && isset($_SESSION['usuario_email'])) {
    $stmt = $pdo->prepare("SELECT * FROM cadastro WHERE email = ?");
    $stmt->execute([$_SESSION['usuario_email']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['id_user'] = $usuario['id']; // Puxa a coluna 'id' que vimos na sua imagem!
    }
}

// 2. Se mesmo assim não tiver logado, manda pro login
if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

// Variáveis
$id_user = $_SESSION['id_user'];
$id_play = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$acao = $_GET['acao'] ?? '';

if ($id_play > 0) {
    // === CARRINHO ===
    if ($acao == 'add_carrinho') {
        // Na sua tabela carrinho, a coluna chama 'id_usuario'
        $sql = "INSERT INTO carrinho (id_usuario, id_play) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$id_user, $id_play]);
        header("Location: carrinho.php");
        exit;
    } 
    elseif ($acao == 'del_carrinho') {
        $sql = "DELETE FROM carrinho WHERE id_usuario = ? AND id_play = ?";
        $pdo->prepare($sql)->execute([$id_user, $id_play]);
        header("Location: carrinho.php");
        exit;
    }
    
    // === LISTA DE DESEJOS ===
    elseif ($acao == 'add_wishlist') {
        // Na sua tabela lista_desejos, a coluna chama 'id_user'
        $sql = "INSERT INTO lista_desejos (id_user, id_play) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$id_user, $id_play]);
        header("Location: wishlist.php");
        exit;
    } 
    elseif ($acao == 'del_wishlist') {
        $sql = "DELETE FROM lista_desejos WHERE id_user = ? AND id_play = ?";
        $pdo->prepare($sql)->execute([$id_user, $id_play]);
        header("Location: wishlist.php");
        exit;
    }
}
exit;