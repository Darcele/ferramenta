<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

        $sql = 'UPDATE documento SET nome = :nome WHERE id = :id';
        $sql1 = 'DELETE FROM parametro WHERE nome = :nome';
        
        //foreach()
            $stm = $conn->prepare($sql);
            $stm->bindParam(':nome', $_GET['descricao']);
            $stm->bindParam(':id', $_GET['id']);
            $stm->execute();
            
        $stm1 = $conn->prepare($sql1);
        $stm1->bindParam(':nome', $_GET['parametro[]']);
        $stm1->execute();

    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  
    //header('Location:lista.php');
?>