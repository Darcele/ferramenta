<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

        $sql1 = 'INSERT INTO parametro(nome, doc) VALUES (:nome, :id)';
        $stm->bindParam(':nome', $_GET['nome']);
        $stm->bindParam(':id', $_GET['id']);
        $stm->execute();
    
    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  //header('Location:criar.php');
?>