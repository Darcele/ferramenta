<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');


        $sql = 'SELECT documento.nome AS descricao , parametro.nome AS parametro, 
        parametro.id AS id_param FROM parametro INNER JOIN documento 
        ON parametro.doc = documento.id WHERE documento.id =' . $_GET['id'];
        $consulta = $conn->query($sql);


    }
    catch(PDOException $e)
    {
        exit ("Error: " . $e->getMessage());
    }
  
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
      <h4>Mantenha marcado somente oque deseja considerar.<h4>

      <form action="novo.php" method="post">
      
      <?php
    
      while ($linha = $consulta->fetch()) 
      {
        $descricao = $linha['descricao'];
        $id_param = $linha['id_param'];
        $parametro = $linha['parametro'];
    
      ?>
      
      <input type="checkbox" name="parametro[]" value="<?=$id_param?>" checked><?=$parametro?><br>


        <?php 
      }
    ?>
      
      <br>
      <h2>Descrição</h2>
      <h4> Insira a descrição do documento.</h4>
        <div class="form-group">
          <textarea class="form-control" rows="5" name="descricao"><?=$descricao?></textarea>
        </div>
      <br>
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <input type="submit" value="Salvar" class="btn btn-info"/>
        <a href="lista.php"><button type="button" class="btn btn-info">Cancelar</button></a>
    </div>  
    </form>
  </body>
</html>