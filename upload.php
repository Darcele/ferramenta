<?php
    include "./config/config.php";

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
 
    $nome_temp = $_FILES['doc']['tmp_name'];
    
    $extension = "txt";
		
	//Define o tempo máximo para esperar.
	set_time_limit(7200);

	//Inicializa as variaveis para armazenar os bytes
	$byte1 = "";
	$byte2 = "";
	$byte3 = "";
	$byte4 = "";
	
	//Verifica se o arquivo existe
	if(file_exists($nome_temp) and !empty($nome_temp))
	{
		//Abre o arquivo em modo leitura binário (rb)
		$fp = fopen($nome_temp, "rb");
		//Le o primeiro byte
		$byte1 = sprintf("%02X",ord(fgetc($fp)));echo $byte1;
		//Le o segundo byte
		$byte2 = sprintf("%02X",ord(fgetc($fp)));echo $byte2;
		//Le o terceiro byte
		$byte3 = sprintf("%02X",ord(fgetc($fp)));//echo $byte3;
		//Le o quarto byte
		$byte4 = sprintf("%02X",ord(fgetc($fp)));//echo $byte4;
		//Fecha o arquivo
		fclose($fp);
    }
    echo $byte1;

    echo $byte2;
	//Agora testa os bytes
	if ($byte1=='50' && $byte2=='4B')
	{
		echo "Arquivo binario";
		$extension = "bin";
    }
    
    echo $extension;
	
	//Agora continua com a extração dos parâmetros para os casos de ser binário ou texto
	
    if($extension == "txt")
    {
		$fileContents = file_get_contents($nome_temp);
		if ($fileContents === false) 
		{
			echo 'Erro ao ler o arquivo!';
		}
		$parametros = array();
		$palavras = str_word_count($fileContents,1, "{}<>");
		echo 'ok 127';
        foreach($palavras as $palavra)
        {
            if(preg_match('/{{([^}]*)}}/', $palavra, $matches))
            {
                echo 'entrou';
                array_unshift($parametros, $matches[1]);
                print_r($matches);
            }
        }
    }
    
    if($extension == "bin")
    {                
    
        $zip = new ZipArchive;
        $dataFile = "content.xml";

        //echo $caminho;

        if ($zip->open($nome_temp)) 
        {
            $fileContents = $zip->getFromName($dataFile);
            //echo '<br>';

            //$zip->deleteName($dataFile);
            $palavras = str_word_count($fileContents,1, "{}<>");
            
            $parametros = array();
            foreach($palavras as $palavra)
            {
                //echo $palavra . '<br>';
                //print_r ($palavras);
                echo $palavra;
                
            if(preg_match('/{(<[^>]+>)*({([^}]*)})(<[^>]+>)*}/', $palavra, $matches))
                {
                    echo 'entrou';
                    print_r($matches);
                    //print_r ($palavras);
                    array_unshift($parametros, $matches[3]);

                }
            }

            $zip->close();
            echo 'ok 117';
        } 
        else 
        {
            echo 'failed';
        }
    }

    $caminho = $upload_folder . '/'.$nome_final;
    copy($nome_temp, $caminho);

?>

<!DOCTYPE html>
<html lang = "pt-br">
  <head>
      <meta charset = "utf-8">
      <title>Novo Arquivo</title>
      <link rel = "icon" href = "imagens/editor.ico">
      <script src = "js/jquery.js"></script>
      <link rel = "stylesheet" href = "css/bootstrap.css">
      <link rel = "stylesheet" href = "css/design.css">
      <link rel = "stylesheet" href = "css/bootstrap.map.css">
      <script src = "js/bootstrap.js"></script>
  </head>
  <body>
    <div class="jumbotron">
      <br>
      <br>
      <br>
      <div class="container">  
      <h1>Novo Arquivo&nbsp;&nbsp;&nbsp;<img src="imagens/editor.jpg" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
      </div>
    </div>
    <div class="container">
    <h3>Após alterar as informações aperte salvar para salvá-las ou cancelar para desfazê-las.</h3></br>
  
      <h2>Parâmetros</h2>
      <h4>Mantenha marcado somente o que deseja considerar.<h4>

      <form action="novo.php" method="post">
      
      <?php
    
      //echo 'TESTE' . $_GET[$nome_final] .'E'. $_GET[$parametros];
      foreach($parametros as $parametro) 
      {

      ?>
      
      <input type="checkbox" name="parametros[]" value="<?=$parametro?>" checked><?=$parametro?><br>


        <?php 
      }
    ?>
       <br>
      <h2>Descrição</h2>
      <h4> Insira a descrição do documento.</h4>
        <div class="form-group">
          <textarea class="form-control" rows="5" name="nome_final"><?=$nome_final?></textarea>
        </div>
      <br>
        <input type="hidden" name="caminho" value="<?=$caminho?>">
        <input type="submit" value="Salvar" class="btn btn-info"/>
        <a href="excluir.php?id=<?=$_GET['id']?>"><button type="button" class="btn btn-info">Cancelar</button></a>
    </div>  
    </form>
  </body>
</html>
 
 