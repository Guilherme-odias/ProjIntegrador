<?php
session_start();
require_once '../conexa.php';
header('Content-Type: application/json');

// Só aceita POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['sucesso' => false, 'msg' => 'Método inválido']);
    exit;
}

// Usuário precisa estar logado
if (!isset($_SESSION['id_user'])) {
    echo json_encode(['sucesso' => false, 'msg' => 'Usuário não autenticado']);
    exit;
}

// Jogo precisa estar na sessão (definido em pagamento.php via GET)
if (!isset($_SESSION['id_jogo_compra'])) {
    echo json_encode(['sucesso' => false, 'msg' => 'Jogo não encontrado na sessão']);
    exit;
}

$id_user   = (int) $_SESSION['id_user'];
$id_play   = (int) $_SESSION['id_jogo_compra'];
$metodo    = trim($_POST['metodo'] ?? '');
$codigo    = trim($_POST['codigo'] ?? '');   // código da transação (opcional, para log)

// Mapeia o valor recebido do JS para o formato salvo no banco
$forma_pgto_map = [
    'cartao' => 'Crédito',
    'pix'    => 'Pix',
    'boleto' => 'Débito'
];
$forma_pgto = $forma_pgto_map[$metodo] ?? '';

if (empty($forma_pgto)) {
    echo json_encode(['sucesso' => false, 'msg' => 'Método de pagamento inválido']);
    exit;
}

// Verifica se o jogo realmente existe
try {
    $stmt_check = $pdo->prepare("SELECT id_play FROM jogos WHERE id_play = :id LIMIT 1");
    $stmt_check->execute([':id' => $id_play]);
    if (!$stmt_check->fetch()) {
        echo json_encode(['sucesso' => false, 'msg' => 'Jogo não encontrado no banco de dados']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao verificar jogo: ' . $e->getMessage()]);
    exit;
}

// Verifica se o usuário já possui esse jogo na biblioteca
try {
    $stmt_dup = $pdo->prepare("SELECT id_play FROM minha_biblioteca WHERE id_play = :id_play AND id_user = :id_user LIMIT 1");
    $stmt_dup->execute([':id_play' => $id_play, ':id_user' => $id_user]);
    if ($stmt_dup->fetch()) {
        // Já possui — limpa sessão e responde como sucesso sem duplicar
        unset($_SESSION['id_jogo_compra'], $_SESSION['preco_compra']);
        echo json_encode(['sucesso' => true, 'msg' => 'Você já possui este jogo na biblioteca']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao verificar biblioteca: ' . $e->getMessage()]);
    exit;
}

// Insere na tabela compra e na minha_biblioteca dentro de uma transação
try {
    $pdo->beginTransaction();

    // 1) Registra a compra
    $stmt_compra = $pdo->prepare("
        INSERT INTO compra (id_play, id_user, forma_pgto, data_compra)
        VALUES (:id_play, :id_user, :forma_pgto, NOW())
    ");
    $stmt_compra->execute([
        ':id_play'    => $id_play,
        ':id_user'    => $id_user,
        ':forma_pgto' => $forma_pgto,
    ]);

    // Captura o ID gerado pelo AUTO_INCREMENT da tabela compra
    $id_compra = (int) $pdo->lastInsertId();

    // 2) Adiciona o jogo à biblioteca do usuário, linkando ao id_compra
    $stmt_bib = $pdo->prepare("
        INSERT IGNORE INTO minha_biblioteca (id_play, id_user, id_compra)
        VALUES (:id_play, :id_user, :id_compra)
    ");
    $stmt_bib->execute([
        ':id_play'   => $id_play,
        ':id_user'   => $id_user,
        ':id_compra' => $id_compra,
    ]);

    $pdo->commit();

    // Limpa dados temporários da sessão
    unset($_SESSION['id_jogo_compra'], $_SESSION['preco_compra']);

    echo json_encode([
        'sucesso' => true,
        'msg'     => 'Compra registrada com sucesso',
        'codigo'  => $codigo   // devolve o código para o JS poder exibir se quiser
    ]);

} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao registrar compra: ' . $e->getMessage()]);
}
?>