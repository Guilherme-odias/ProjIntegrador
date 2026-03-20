<?php
function conectar() {
    try {
        return new PDO("mysql:host=localhost;dbname=projeto_quimera", "root", "");
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
}
?>