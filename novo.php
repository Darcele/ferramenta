<?php
    include "./config/config.php";

    $za = new ZipArchive;
    $za->open($upload_folder . '/'.$upload_zip, ZipArchive::CREATE);
    $za->addFile(realpath($_POST['caminho']), $_POST['nome_final']);
    $za->close();     

    $sql = "INSERT INTO documento(caminho, nome) VALUES(:caminho, :nome)";
    $stmt = $conn->prepare( $sql );
    $stmt->bindParam(':caminho', realpath($_POST['caminho']));
    $stmt->bindParam(':nome', $_POST['nome_final']);
    $result = $stmt->execute();
    if($result == FALSE)
    {
        echo 'NO';    
        var_dump( $stmt->errorInfo() );
        exit;    
    }

    $insertid = $conn->lastInsertId();
    
    $sql1 = "INSERT INTO parametro(nome, doc) VALUES(:nome, :id)";
    $stmt1 = $conn->prepare( $sql1 );
    
    foreach($_POST['parametros'] as $item)
    {
        $stmt1->bindParam(':id', $insertid);
        $stmt1->bindParam(':nome', $item);
        $stmt1->execute();
    }

  header('Location:lista.php');
?>