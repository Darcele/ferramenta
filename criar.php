<?php

    $servername = "localhost";
    $username = "cefet";
    $password = "cefet123";
        
    // Faz a conexao com o banco de dados
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
        $conn->exec('SET NAMES utf8');

/*
        $consulta = $conn->query('SELECT tb_documento.nome AS descricao , tb_parametro.nome AS parametro 
                FROM tb_parametro INNER JOIN tb_documento 
                ON tb_parametro.id_doc = tb_documento.id WHERE tb_documento.id = ' . $_GET['id']);
       
        //'SELECT * FROM tb_documento WHERE id = ' . $_GET['id']
        
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) 
        {
            $DESCRICAO = $linha['descricao'];
            //$PARAMETRO = $linha['parametro'];
            //$NOME = $linha['nome'];
        }
*/

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
      <!--</script>-->
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
      <h4>Desmarque os parâmetros que não serão mais considerados parâmetros.<h4>

      <?php foreach($consulta->fetch(PDO::FETCH_ASSOC) as $linha):?>
      <input type="checkbox" name="parametro[]" value="<?$linha['parametro']?>" checked><?=$linha['parametro']?></br>
      <?php endforeach; ?>

      <form action="/upload.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
      </br>
      <h2>Descrição</h2>
      <h4> Insira a descrição do documento.</h4>
        <div class="form-group">
          <textarea class="form-control" rows="5" id="1" name="descricao"><?=$DESCRICAO?></textarea>
        </div>
      </br>
        <input type="submit" value="Salvar" class="btn btn-info"/>
        <a href="lista.php"><button type="button" class="btn btn-info">Cancelar</button></a>
    </div>  
    </form>
  </body>
</html>