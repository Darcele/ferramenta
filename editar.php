<?php
    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');
        $sql = 'SELECT documento.id AS id, documento.nome AS descricao , parametro.nome AS parametro, parametro.padrao AS padrao, parametro.id AS id_par
        FROM parametro INNER JOIN documento 
        ON parametro.doc = documento.id WHERE documento.id = ' . $_GET['id'];
//        echo $sql;
        //echo $_GET['id'];
        
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
      <title>Editor de Arquivos</title>
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
      <h1>Editor de Arquivos&nbsp;&nbsp;&nbsp;<img src="imagens/editor.jpg" class="img-rounded" alt="Cinque Terre" width="80" height="80"> </h1> 
      </div>
    </div>

    <div class="container">
      <h3>Após alterar as informações aperte salvar para salvá-las ou cancelar para desfazê-las.</h3><br>
  
      <h2>Parâmetros</h2>
      <h4>Escreva o valor padrão para os parâmetros.</h4>

      <form action="/modificar.php" method="get" >
        <?php 
        while ($linha = $consulta->fetch()) 
        {
          $DESCRICAO = $linha['descricao'];
          $PARAMETRO = $linha['parametro'];
          $PADRAO = $linha['padrao'];
          $id_par = $linha['id_par'];
              
        ?>
            <?=$PARAMETRO?>:&nbsp;<input type="text" name="padrao_<?=$id_par?>" value="<?=$PADRAO?>"><br><br>
     
      <?php 
        }
      ?>
        <input type="hidden" name="parametro" value="<?=$PARAMETRO?>">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <?php //print_r($_GET['id']);?>
        <br>
        <h2>Descrição</h2>
        <h4> Edite a descrição do documento.</h4>
        <div class="form-group">
           <textarea class="form-control" rows="5" name="descricao"><?=$DESCRICAO?></textarea>
        </div>
        <br>
        <input type="submit" value="Salvar" class="btn btn-info"/>
        <a href="lista.php"><button type="button" class="btn btn-info">Cancelar</button></a>  
      </form>
    </div>
  </body>
</html>
