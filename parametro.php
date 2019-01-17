<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

        $sql = 'INSERT INTO parametro(nome, doc) VALUES (:nome, :id)';

        function verParametro($arquivo){       
          $_UP['pasta'] = 'upload';
          $parametros = array();
          $zip = new ZipArchive;
          $zip->open($_UP['pasta'] . '/arquivos_zip.zip');
          $fileContents = $zip->getFromName($arquivo);
          $palavras = str_word_count($fileContents,1, "{}");
          foreach($palavras as $palavra){
              if(preg_match('/{{([^}]*)}}/', $palavra, $matches)){
                  array_unshift($parametros, $matches[1]);
                  $stm->bindParam(':nome', $palavra);
              }
          }
          $zip->close();
        //  return $parametros;
      }

      $stm->bindParam(':id', $_GET['id']);
      $stm->execute();
    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  header('Location:criar.php');
?>