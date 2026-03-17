<?php
    $host = "10.37.44.28";
    $db = "projeto_quimera";
    $usuario = "root";
    $senha = "";
 
    try {
 
        $pdo = new PDO("mysql:host=$host;dbname=$db",$usuario,$senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $pdo;
        //echo "Conectado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao conectar: " . $e->getMenssage();
    }
?>