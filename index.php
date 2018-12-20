<?php
    
     $servername = "localhost";
     $username = "cefet";
     $password = "cefet123";
     
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
    
    require("manipular.class.php");
    $editor = new Editor();
    $listar = $editor->listarArquivos();
?>


<!DOCTYPE html>
<html lang = "pt-br">
    <head>
        <meta charset = "utf-8">
        <title>Upload</title>
        <link rel = "icon" href = "imagens/upload.ico">
        <script src = "js/jquery.js"></script>
        <link rel = "stylesheet" href = "css/bootstrap.css">
        <link rel = "stylesheet" href = "css/design.css">
        <link rel = "stylesheet" href = "css/bootstrap.map.css">
        <script src = "js/bootstrap.js"></script>
        </script>
    </head>
    <body>
    <div class="jumbotron">
        <br>
        <br>
        <br>
        <div class="container">  
        <h1>Upload de arquivos&nbsp;&nbsp;&nbsp;<img src="imagens/upload.png" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
        </div>
    </div>
    <div class="container">
        <h2>Arquivos existentes</h2></br>
        </h3>Esses arquivos já sofreram upload anteriormente, se quiser manipular algum desses arquivos selecione e aperte o botão enviar.</h2></br></br>
        <form action="upload.php" method="post" enctype="multipart/form-data">

          <?php foreach($listar as $var): ?>
          <input type="radio" name="listar" value="<?php echo $var; ?>">&nbsp;&nbsp;<?php echo $var; ?></input></br>
          <?php endforeach; ?>
          </br>
          <a href="editar.php"><button type="button" class="btn btn-info">Editar</button></a> 
          <a href="deletar.php"><button type="button" class="btn btn-info">Deletar</button></a>


          <h2>Selecione o arquivo para fazer upload</h2></br>
          </h3>Se desejar fazer upload de um novo arquivo, basta slecioná-lo e apertar o botão enviar.</h3></br></br>
          <input type="file" name ="arquivo"></br></br>
          <a href="index.php"><button type="button" class="btn btn-info">Cancelar</button></a>
          <input type="submit" value="Enviar" class="btn btn-info"/>
          </br>
        </form>        
    </div>  
  </body>
</html>
