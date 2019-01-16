<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

        $sql = 'INSERT INTO parametro(padrao) VALUES (:padrao) WHERE id = :id';
        echo $sql;

        $sql1 = 'UPDATE parametro SET padrao = :padrao WHERE id = :id';
        echo $sql1;

        $sql2 = 'UPDATE documento SET nome = :nome WHERE id = :id';
        echo $sql2;

        /*
        if('SELECT padrao FROM parametro WHERE padrao IS NULL')
        {
            $stm = $conn->prepare($sql);
        }

        else
        {
            $stm = $conn->prepare($sql1);
        }
        */

        for($i=0; $i<$_GET['cont']; $i++)
        {
            $stm = $conn->prepare($sql);
            $stm->bindParam(':id', $_GET['id']);
            $stm->bindParam(':padrao', $_GET['padrao']);
            $stm->bindParam(':id', $_GET['id_par']);
            $stm->execute();

            echo $_GET['padrao'];
            echo $_GET['PARAMETRO'];
        }
        
        $stm1 = $conn->prepare($sql2);
        $stm1->bindParam(':nome', $_GET['descricao']);
        $stm1->bindParam(':id', $_GET['id']);
        $stm1->execute();

        echo $sql1;
        
        echo $_GET['descricao'];
        echo $_GET['id'];
    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  
    //header('Location:lista.php');
?>
