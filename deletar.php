
<!DOCTYPE html>
<html lang = "pt-br">
  <head>
      <meta charset = "utf-8">
      <title>Deletar Arquivos</title>
      <link rel = "icon" href = "imagens/deletar.ico">
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
      <h1>Deletar Arquivos&nbsp;&nbsp;&nbsp;<img src="imagens/deletar.jpg" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
      </div>
    </div>
    <div class="container">
        
        <h2>Tem certeza que deseja deletar o arquivo?</h2>
        <!--conseguir colocar no h2 o nome do arquivo-->      

        <a href="excluir.php?id=<?=$_GET['id']?>"><button type="button" class="btn btn-info">Deletar</button></a>
        <a href="lista.php"><button type="button" class="btn btn-info">Cancelar</button></a>
      </form>
    </div>  
  </body>
</html>
