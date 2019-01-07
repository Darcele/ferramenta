<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');


        $consulta = $conn->query('UPDATE FROM tb_documento SET descricao = $DESCRICAO WHERE id = '.$_GET['id']);
       
        //'SELECT * FROM tb_documento WHERE id = ' . $_GET['id']
        
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) 
        {
            $DESCRICAO = $linha['descricao'];
            $PARAMETRO = $linha['parametro'];
            //$NOME = $linha['nome'];
        }

    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  
?>
