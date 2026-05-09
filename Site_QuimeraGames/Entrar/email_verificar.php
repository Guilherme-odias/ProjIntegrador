<?php
session_start();
require_once("../conexa.php");

$usuario = $_POST['usuario'] ?? '';

$stmt = $pdo->prepare("SELECT email FROM cadastro WHERE email = ?");
$stmt->execute([$usuario]);

if ($stmt->rowCount() > 0) {

    $_SESSION['email_recuperacao'] = $usuario;

    echo "ok";

} else {
    echo "erro";
}
?>