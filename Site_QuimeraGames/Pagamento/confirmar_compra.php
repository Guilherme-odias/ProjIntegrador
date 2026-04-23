<?php
session_start();
require_once '../conexa.php';
header('Content-Type: application/json');

// DIAGNÓSTICO COMPLETO
echo json_encode([
    'metodo_request' => $_SERVER['REQUEST_METHOD'],
    'session_completa' => $_SESSION,
    'post_recebido' => $_POST,
    'id_user_existe' => isset($_SESSION['id_user']),
    'id_jogo_existe' => isset($_SESSION['id_jogo_compra']),
]);
exit;
?>