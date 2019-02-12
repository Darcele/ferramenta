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
    
        $sql1 = 'SELECT COUNT(id) AS cont FROM parametro WHERE doc ='.$_POST['id'];

        //$cont; 
        
        $sql2 = 'DELETE FROM parametro WHERE doc=:doc'; 
        
        if (isset($_POST['parametro']))
        {
            $sql2 = 'DELETE FROM parametro WHERE id NOT IN (:id) AND doc = :doc';
            $p = $_POST['parametro'];
            $stm2 = $conn->prepare($sql1);
            $stm2->bindParam(':id', join(',', $p));
        }
        else
        {
            $sql2 = 'DELETE FROM parametro WHERE doc = :doc';
            $stm2 = $conn->prepare($sql1);
        }
        $stm2->bindParam(':doc', $_POST['id']);
        $stm2->execute();
        
        if($conn->query($sql1) == 0)
        {
            $sql3 = 'DELETE FROM documento WHERE doc=:doc';
            $stm3 = $conn->prepare($sql3);

            $stm3->execute();

            echo "APAGOU";

        }
       
    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
    
    //header('Location:lista.php');
?