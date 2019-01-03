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
        <h2>Tem certeza que deseja deletar esse arquivo?</h2>
        <!--conseguir colocar no h2 o nome do arquivo-->
        <?php
          $servername = "localhost";
          $username = "cefet";
          $password = "cefet123";
              
          // Faz a conexao com o banco de dados
              
          try {
              $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
          }
          catch(PDOException $e)
          {
              exit ("Connection failed: " . $e->getMessage());
          } 
      ?>

        <a href="index.php"><button type="button" class="btn btn-info">Deletar</button></a> 
        <a href="index.php"><button type="button" class="btn btn-info">Cancelar</button></a>
      </form>
    </div>  
  </body>
</html>
