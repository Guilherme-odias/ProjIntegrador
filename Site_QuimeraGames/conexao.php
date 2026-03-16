<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$banco = "quimera";

$conn = new mysqli($host, $user, $pass, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

echo "Conectado com sucesso";

?>