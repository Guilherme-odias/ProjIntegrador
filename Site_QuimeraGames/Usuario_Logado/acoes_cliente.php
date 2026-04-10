<?php
session_start();
require_once '../conexa.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../Entrar/Entrar.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_play = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$acao = $_GET['acao'] ?? '';

if ($id_play > 0) {
    if ($acao == 'add_carrinho') {
        $sql = "INSERT IGNORE INTO carrinho (id_usuario, id_play) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$id_user, $id_play]);
        header("Location: carrinho.php");
    } elseif ($acao == 'add_wishlist') {
        $sql = "INSERT IGNORE INTO lista_desejos (id_user, id_play) VALUES (?, ?)";
        $pdo->prepare($sql)->execute([$id_user, $id_play]);
        header("Location: wishlist.php");
    }
}
exit;