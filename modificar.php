<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');
        $stm = $conn->prepare('DELETE FROM tb_parametro WHERE nome = :nome');

        
        if (count($GET_['parametro']) >= 1) {
            
            for ($i=0;$i<count($GET_['parametro']);$i++) 
            {
                $stm->bindParam(':nome', $_GET['parametro'][$i]);
                $stm->execute();
            }
            
        }

        $stm = $conn->prepare('UPDATE tb_documento SET nome = :nome WHERE id = :id');
        $stm->bindParam(':nome', $_GET['descricao']);
        //echo $_GET['$DESCRICAO'];
        $stm->bindParam(':id', $_GET['id']);
        $stm->execute();       

    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  
    header('Location:lista.php');
?>
