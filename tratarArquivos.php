<?php
    require('manipular.class.php');
    $editor = new Editor();
    $parametros = $editor ->verParametro($_GET['arquivo']);
    //$troca = $editor->trocaParametro($_POST['string']);

?>

<!DOCTYPE html>
<html lang = "pt-br">
  <head>
      <meta charset = "utf-8">
      <title>Tratamento de Arquivos</title>
      <link rel = "icon" href = "imagens/opcoes.ico">
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
      <h1>Tratamento de Arquivos&nbsp;&nbsp;&nbsp;<img src="imagens/opcoes.png" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
      </div>
    </div>
    <div class="container">
      <h2>Parâmetros presentes no arquivo selecionado</h2>
      <h4>Desmarque o que não for parâmetro</h4>
      <form action="manipular.class.php" method="post">

        <?php foreach($parametros as $var): ?>
        <input type="checkbox" name="parametros" value="<?php echo $var; ?>"checked>&nbsp;&nbsp;<?php echo $var; ?></input></br>
        <?php endforeach; ?>
        </br>

              </br>
      <h2>Descrição</h2>
      <h4> Escreva a descrição do documento.</h4>
        <div class="form-group">
          <textarea class="form-control" rows="5" id="descricao"></textarea>
        </div>
      </br>

        <input type="submit" value="OK" class="btn btn-info"/>
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
