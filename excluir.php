<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

        $stmt = $conn->prepare('DELETE FROM parametro WHERE doc = :id');
        $stmt->bindParam(':id', $_GET['id']);  
        $stmt->execute();

        $stmt1 = $conn->prepare('DELETE FROM documento WHERE id = :id');
        $stmt1->bindParam(':id', $_GET['id']);  
        $stmt1->execute();


        //echo $stmt->rowCount();

    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
    
    header('Location:lista.php');
?>

