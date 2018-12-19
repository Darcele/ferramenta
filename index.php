<?php
    require("manipular.class.php");
    $editor = new Editor();
    $listar = $editor->listarArquivos();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Envio de arquivo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <style>
    body{
      background-image: url("imagens/fundo_6.jpg");
    }
    .jumbotron{
      background-image: url("imagens/fundo_j_11.png");

    }
  </style>
  <body>
    <div class="jumbotron">
        <br>
        <br>
        <br>
        <div class="container">  
        <h1>Upload de arquivos&nbsp;&nbsp;&nbsp;<img src="imagens/icone_up.png" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
        </div>
    </div>
    <div class="container">
        <h2>Arquivos existentes</h2></br>
        </h3>Esses arquivos já sofreram upload anteriormente, se quiser manipular algum desses arquivos selecione e aperte o botão enviar.</h2></br></br>
        <form action="upload.php" method="post" enctype="multipart/form-data">

          <?php foreach($listar as $var): ?>
          <input type="radio" name="listar" value="<?php echo $var; ?>">&nbsp;&nbsp;<?php echo $var; ?></input></br>
          <?php endforeach; ?>

          <h2>Selecione o arquivo para fazer upload</h2></br>
          </h3>Se desejar fazer upload de um novo arquivo, basta slecioná-lo e apertar o botão enviar.</h3></br></br>
          <input type="file" name ="arquivo"></br></br>
          <a href="index.php"><button type="button" class="btn btn-info">Cancelar</button></a>
          <input type="submit" value="Enviar" class="btn btn-info"/>
        </form>        
    </div>  
  </body>
</html>
