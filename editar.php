<!DOCTYPE html>
<html lang = "pt-br">
  <head>
      <meta charset = "utf-8">
      <title>Editor de Arquivos</title>
      <link rel = "icon" href = "imagens/editor.ico">
      <script src = "js/jquery.js"></script>
      <link rel = "stylesheet" href = "css/bootstrap.css">
      <link rel = "stylesheet" href = "css/design.css">
      <link rel = "stylesheet" href = "css/bootstrap.map.css">
      <script src = "js/bootstrap.js"></script>
      <!--</script>-->
  </head>
  <body>
    <div class="jumbotron">
      <br>
      <br>
      <br>
      <div class="container">  
      <h1>Editor de Arquivos&nbsp;&nbsp;&nbsp;<img src="imagens/editor.jpg" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
      </div>
    </div>
    <div class="container">
    <h3>Após alterar as informações aperte salvar para salvá-las ou cancelar para desfazê-las.</h3></br>
      
      <h2>Parâmetros</h2>
      <h4>Desmarque os parâmetros que não serão mais considerados parâmetros.<h4>
      <form action="manipular.class.php" method="post">

        <?php //foreach($parametros as $var): ?>
        <!--<input type="checkbox" name="parametros" value="<?php //echo $var; ?>">&nbsp;&nbsp;<?php //echo $var; ?></input></br>-->
        <?php //endforeach; ?>

      </br>
      <h2>Descrição</h2>
      <h4> Edite a descrição do documento.</h4>
        <div class="form-group">
          <textarea class="form-control" rows="5" id="descricao"></textarea>
        </div>
      </br>
        <input type="submit" value="Salvar" class="btn btn-info"/>
        <a href="editar.php"><button type="button" class="btn btn-info">Cancelar</button></a>
      </form>
    </div>  
  </body>
</html>
