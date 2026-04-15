<?php
session_start();
require_once '../conexa.php';

// Recuperação segura do ID caso a sessão expire
if (!isset($_SESSION['id_user']) && isset($_SESSION['usuario_email'])) {
    $stmt = $pdo->prepare("SELECT id_user FROM cadastro WHERE email = ?");
    $stmt->execute([$_SESSION['usuario_email']]);
    $_SESSION['id_user'] = $stmt->fetchColumn();
}

if (empty($_SESSION['id_user'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_play = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$acao = $_GET['acao'] ?? '';
$pagina_anterior = $_SERVER['HTTP_REFERER'] ?? '../Usuario_Logado/usuariologado.php';

if ($id_play > 0) {
    // CARRINHO
    if ($acao == 'add_carrinho') {
        $sql = "INSERT IGNORE INTO carrinho (id_usuario, id_play) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$id_user, $id_play]);
        header("Location: " . $pagina_anterior);
        exit;
    }
    // WISHLIST (Lógica de ADICIONAR/REMOVER ao clicar)
    elseif ($acao == 'add_wishlist') {
        $check = $pdo->prepare("SELECT COUNT(*) FROM lista_desejos WHERE id_user = ? AND id_play = ?");
        $check->execute([$id_user, $id_play]);

        if ($check->fetchColumn() > 0) {
            $pdo->prepare("DELETE FROM lista_desejos WHERE id_user = ? AND id_play = ?")->execute([$id_user, $id_play]);
        } else {
            $pdo->prepare("INSERT INTO lista_desejos (id_user, id_play) VALUES (?, ?)")->execute([$id_user, $id_play]);
        }
        header("Location: " . $pagina_anterior);
        exit;
    }
}
exit;