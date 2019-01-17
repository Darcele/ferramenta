<?php
    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

        $sql1 = 'UPDATE parametro SET padrao = :padrao WHERE id = :id';
        //echo $sql1;

        $sql2 = 'UPDATE documento SET nome = :nome WHERE id = :id';
        //ssecho $sql2;
       
        $stm = $conn->prepare($sql1); 
        foreach($_GET as $key => $val)
        {

            if(preg_match('/^padrao\_(\d+)$/', $key, $matches))
            {
                //$stm = $conn->prepare($sql);
                $stm->bindParam(':padrao', $val);
                $stm->bindParam(':id', $matches[1]);
                //$stm->bindParam(':nome', $_GET['parametro']);
                //$stm->bindParam(':doc', $_GET['id']);
                $stm->execute();

                print_r($_GET['parametro']);
                print_r($_GET['id']);
                print_r($val);
                print_r($matches);
            }

        }
        
        $stm1 = $conn->prepare($sql2);
        $stm1->bindParam(':nome', $_GET['descricao']);
        $stm1->bindParam(':id', $_GET['id']);
        $stm1->execute();
        //echo $sql1;
        
        //echo $_GET['descricao'];
        //echo $_GET['id'];
    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  
    header('Location:lista.php');
?>