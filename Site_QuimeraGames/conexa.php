<?php
$host = "localhost";
$db = "projeto_quimera";
$usuario = "root";
$senha = "admin";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$db;charset=utf8",
        $usuario,
        $senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>