<?php
    require('manipular.class.php');
    $editor = new Editor();
    $parametros = $editor ->verParametro($_GET['arquivo']);
    //$troca = $editor->trocaParametro($_POST['string']);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tratamento de arquivos</title>
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
        <h1>Tratamento de Arquivos&nbsp;&nbsp;&nbsp;<img src="imagens/icone_up.png" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
        </div>
    </div>
    <div class="container">
        <h2>Parâmetros presentes no arquivo selecionado</h2></br>
        </h3>Selecione os parâmentros que deseja modificar</h2></br></br>
        <form action="manipular.class.php" method="post">

          <?php foreach($parametros as $var): ?>
          <input type="checkbox" name="parametros" value="<?php echo $var; ?>">&nbsp;&nbsp;<?php echo $var; ?></input></br>
          <?php endforeach; ?>
          <a href="tratarArquivos.php"><button type="button" class="btn btn-info">OK</button></a>
          </form>
          <!--
          <h2>Digite a palavra pela qual deseja modificar</h2></br>
          <input type="text" name="string"></br>
          </h3></h3></br></br>
        <a href="index.php"><button type="button" class="btn btn-info">Cancelar</button></a>
        <a href="tratarArquivos.php"><button type="button" class="btn btn-info">Enviar</button></a>
        -->
    </div>  
  </body>
</html>
