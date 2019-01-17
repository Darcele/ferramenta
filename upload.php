1 de 1.478
Páginas editar.php e modificar.php
Darcele Christo Leão <darcele.leao@gmail.com>
	
Anexos14:07 (Há 8 horas)
	
para eu

2 anexos
Darcele Christo Leão <darcele.leao@gmail.com>
	
Anexos14:13 (Há 7 horas)
	
para eu
O que falta fazer para testar o funcionamento do processo de upload de um novo arquivo é conferir a linha 59 da página criar.php e terminar o código da página novo.php.

Segue em anexo as páginas upload.php, criar.php, parametro.php, excluir.php e novo.php.



Em qua, 16 de jan de 2019 às 14:07, Darcele Christo Leão <darcele.leao@gmail.com> escreveu:


5 anexos
	
	
	

<?php
    //Filedata é a variável que o flex envia com o arquivo para upload
    $arquivo = $_FILES['arquivo'];
    $nome_arquivo = $_FILES['arquivo']['name'];
    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = 'upload';


    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mbyte
 
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('odt','xml','txt', 'odf','doc','zip','docx','pptx');
 
    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = false;
 
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
 
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['arquivo']['error'] != 0) 
    {
            die("Não foi possível fazer o upload, erro:<br />" .
            $_UP['erros'][$_FILES['arquivo']['error']]);
            exit; // Para a execução do script
    }
 
    // Caso script chegue a este ponto, não houve erro com o processo de  upload
    // e o PHP pode continuar
 
    // Faz a verificação da extensão do arquivo
 
    $extensao = strtolower(end(explode('.',  $nome_arquivo)));
    //$arquivo = $_FILES['Filedata']['name'];
    //$extensao  = substr($arquivo,-3);
    if (array_search($extensao, $_UP['extensoes']) === false) 
    {
            echo "Por favor, envie arquivos com as seguintes extensões: odt,odf, txt ou xml";
    }
 
    // Faz a verificação do tamanho do arquivo enviado
    else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) 
    {
        echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
    }
 
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else 
    {
            // Primeiro verifica se deve trocar o nome do arquivo
            if ($_UP['renomeia'] == true) 
            {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $nome_final = date('d-m-Y').'_'.".$extensao";
            } 
            else 
            {
            // Mantém o nome original do arquivo
                $nome_final = $_FILES['arquivo']['name'];
            }
    }

 
    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . '/' . $nome_final)) 
    {
        // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
        echo "Seu arquivo  foi inserido com sucesso!";
        //echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '"> Clique aqui para acessar o arquivo</a>';
    } 
    else 
    {
        // Não foi possível fazer o upload.Algum problema com a pasta
            echo utf8_encode('Não foi possível enviar este arquivo, tente novamente');
    }
 
    //Inserir arquivo no zip

    $za = new ZipArchive;
    $za->open($_UP['pasta'] . '/arquivos_zip.zip', ZipArchive::CREATE);
    //$za->open($_UP['pasta'] . '/arquivos.zip', ZipArchive::CREATE|ZipArchive::OVERWRITE);
    $za->addFile(realpath($_UP['pasta'] . '/' . $nome_final), $nome_final);
    $za->close();

    // Parametros de conexao com o banco de dados

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    } 

    // Prepara o SQL de insert no banco

    $sql = "INSERT INTO tb_documento(caminho, nome) VALUES(:caminho, :nome)";

    // Prepara o banco de dados carregando o SQL

    $stmt = $PDO->prepare( $sql );

    // Liga o parametro (:caminho) com o valor (realpath($_UP['pasta'] . '/' . $nome_final))

    $stmt->bindParam(':caminho', realpath($_UP['pasta'] . '/' . $nome_final));

    // Liga o parametro (:nome) com o valor ($nome_final)

    $stmt->bindParam(':nome', $nome_final);
    
    // Executa o SQL inserindo o caminho no banco
    
    $result = $stmt->execute();
    
    // Verifica o resultado 
    
    if ( ! $result )
    {
        // Deu erro!!!

        var_dump( $stmt->errorInfo() );
        exit;
    }

    // Funcionou! Imprime quantas linhas foram inseridas.

    echo $stmt->rowCount() . "linhas inseridas";

    
    header('Location: parametro.php?arquivo='.$_FILES['arquivo']['name']);

?>
