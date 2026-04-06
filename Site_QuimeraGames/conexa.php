<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "127.0.0.1"; 
$db = "projeto_quimera";
$usuario = "root";
$senha = "";

try {

    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=$db;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Conectado com sucesso!"; // só pra teste

} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
    
}
?>