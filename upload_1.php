<?php
    //Filedata é a variável que o flex envia com o arquivo para upload
    $doc = $_FILES['doc'];
    
    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = 'upload';

    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mbyte
 
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
 
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['doc']['error'] != 0) 
    {
            die("Não foi possível fazer o upload, erro:<br />" .
            $_UP['erros'][$_FILES['doc']['error']]);
            exit; 
    }
  
    // Faz a verificação do tamanho do arquivo enviado
    if ($_UP['tamanho'] < $_FILES['doc']['size']) 
    {
        echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
    }
 
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else 
    {
                $nome_final = $_FILES['doc']['name'];
    }
 
    if (move_uploaded_file($_FILES['doc']['tmp_name'], $_UP['pasta'] . '/' . $nome_final)) 
    {
         echo "Seu arquivo  foi inserido com sucesso!";
    } 
    else 
    {
            echo utf8_encode('Não foi possível enviar este arquivo, tente novamente');
    }
 
    //Inserir arquivo no zip

    $za = new ZipArchive;
    $za->open($_UP['pasta'] . '/arquivos_zip.zip', ZipArchive::CREATE);
    $za->addFile(realpath($_UP['pasta'] . '/' . $nome_final), $nome_final);
    $za->close();

    // Parametros de conexao com o banco de dados

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    try 
    {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
        exit;
    } 
    
    // Insere o documento no banco e dados

    $sql = "INSERT INTO documento(caminho, nome) VALUES(:caminho, :nome)";
    $stmt = $conn->prepare( $sql );
    $caminho = realpath($_UP['pasta'] . '/' . $nome_final);
    $stmt->bindParam(':caminho', $caminho);
    $stmt->bindParam(':nome', $nome_final);
    $result = $stmt->execute();

    if($result == FALSE)
    {
        echo 'NO';    
        var_dump( $stmt->errorInfo() );
        exit;    
    }

    $insertid = $conn->lastInsertId();

    // Obtem os parametros do arquivo

    $fileContents = file_get_contents($caminho);

    if ($fileContents === false) 
    {
        echo 'Erro ao ler o arquivo!';
    }
    $parametros = array();
    $palavras = str_word_count($fileContents,1, "{}");
    foreach($palavras as $palavra)
    {
        if(preg_match('/{{([^}]*)}}/', $palavra, $matches))
        {
            array_unshift($parametros, $matches[1]);
        }
    }


    $sql1 = "INSERT INTO parametro(nome, doc) VALUES(:nome, :id)";
    $stmt1 = $conn->prepare( $sql1 );

    
    foreach($parametros as $item)
    {
        $stmt1->bindParam(':id', $insertid);
        $stmt1->bindParam(':nome', $item);
        $stmt1->execute();
    }

    header("Location: criar.php?id=$insertid");

?>


