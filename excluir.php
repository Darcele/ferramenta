<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');
    }
    catch(PDOException $e)
    {
        exit ("Connection failed: " . $e->getMessage());
    }


    function deletar(){
            $sql = "DELETE * FROM tb_documento WHERE id = :id";
            $stmt->bindParam( ':id', $_GET['id']);
            $conn->query($sql, PDO::FETCH_ASSOC);
    }

    header('Location:lista.php');
?>

/*

          function deletar(){
          $sql = "DELETE * FROM tb_documento WHERE id = (:id)";
          $string = realpath($PHP_SELF);
          $separa = explode('=', $string);
          $id = array_pop($separa);
          $stmt->bindParam( ':id', realpath($id));
          $conn->query($sql, PDO::FETCH_ASSOC);
          }

*/
