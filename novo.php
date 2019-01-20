<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

        $sql = 'UPDATE documento SET nome = :nome WHERE id = :id';
        
        
        $stm = $conn->prepare($sql);
        $stm->bindParam(':nome', $_POST['descricao']);
        $stm->bindParam(':id', $_POST['id']);
        $stm->execute();

        
        if (isset($_POST['parametro']))
        {
            $sql1 = 'DELETE FROM parametro WHERE id NOT IN (:id) AND doc = :doc';
            $p = $_POST['parametro'];
            $stm1 = $conn->prepare($sql1);
            $stm1->bindParam(':id', join(',', $p));
        }
        else
        {
            $sql1 = 'DELETE FROM parametro WHERE doc = :doc';
            $stm1 = $conn->prepare($sql1);
        }

        $stm1->bindParam(':doc', $_POST['id']);

        $stm1->execute();
    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }

    //header('Location:lista.php');
?>