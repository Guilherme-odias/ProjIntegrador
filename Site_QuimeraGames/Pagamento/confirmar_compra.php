<?php
session_start();
require_once '../conexa.php';

header('Content-Type: application/json');

// Segurança: só aceita POST e usuário logado
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id_user'])) {
    echo json_encode(['sucesso' => false, 'msg' => 'Não autorizado']);
    exit;
}

$id_user  = (int) $_SESSION['id_user'];
$id_jogo  = isset($_SESSION['id_jogo_compra'])  ? (int) $_SESSION['id_jogo_compra']  : 0;
$preco    = isset($_SESSION['preco_compra'])     ? (float) $_SESSION['preco_compra']  : 0;

$metodo   = $_POST['metodo']  ?? 'desconhecido';
$cod_transacao = $_POST['codigo'] ?? '';

if ($id_jogo === 0 || $id_user === 0) {
    echo json_encode(['sucesso' => false, 'msg' => 'Dados inválidos']);
    exit;
}

try {
    // Evita duplicata: checa se o jogo já está na biblioteca
    $check = $pdo->prepare("SELECT COUNT(*) FROM minha_biblioteca WHERE id_user = ? AND id_play = ?");
    $check->execute([$id_user, $id_jogo]);
    if ($check->fetchColumn() > 0) {
        echo json_encode(['sucesso' => true, 'msg' => 'Jogo já na biblioteca']);
        exit;
    }

    // Insere na biblioteca
    $stmt = $pdo->prepare("INSERT INTO minha_biblioteca (id_play, id_compra, id_user) VALUES (?, ?, ?)");
    // id_compra: você pode usar uma tabela de pedidos ou gerar um número sequencial.
    // Por simplicidade, usamos o timestamp como id_compra temporário.
    $id_compra_temp = time(); 
    $stmt->execute([$id_jogo, $id_compra_temp, $id_user]);

    // Limpa a sessão da compra
    unset($_SESSION['id_jogo_compra'], $_SESSION['preco_compra']);

    echo json_encode(['sucesso' => true, 'msg' => 'Compra registrada com sucesso']);
} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'msg' => 'Erro no banco: ' . $e->getMessage()]);
}
?>