<?php

    //phpinfo();

   $servername = "localhost";
   $username = "cefet";
   $password = "cefet123";
       
   // Faz a conexao com o banco de dados
       
   try {
       $conn = new PDO("mysql:host=$servername;dbname=docs", $username, $password);
       $conn->exec('SET NAMES utf8');
   }
   catch(PDOException $e)
   {
       exit ("Connection failed: " . $e->getMessage());
   } 
?>


<!DOCTYPE html>
    <head>
        <meta charset = "utf-8">
        <title>Upload</title>
        <link rel = "icon" href = "imagens/upload.ico">
        <script src = "js/jquery.js"></script>
        <link rel = "stylesheet" href = "css/bootstrap.css">
        <link rel = "stylesheet" href = "css/design.css">
        <link rel = "stylesheet" href = "css/bootstrap.map.css">
        <script src = "js/bootstrap.js"></script>
       <title>Documentos</title>
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
       <!--<table border="1">-->
    <table class="table table-striped">
      <tr>
          <td>Nome</td>
          <td>Caminho do arquivo</td>
          <td colspan="2" align="center">Comandos</td>
       </tr>
<?php foreach ($conn->query("SELECT * FROM documento", PDO::FETCH_ASSOC) as $linha): ?>
      <tr>
          <td><?=$linha['nome']?></td>
          <td><?=$linha['caminho']?></td>
          <td><a href="editar.php?id=<?=$linha['id']?>">Editar</a></td>
          <td><a href="deletar.php?id=<?=$linha['id']?>">Deletar</a></td>
       </tr>
<?php endforeach; ?>
       <tr>
         <form  action="upload.php" method="post" enctype="multipart/form-data">
            <td colspan="2" align="right">Novo documento:</td>
            <td>
                 <input type="file" name="doc" />

            </td>
            <td>
                 <input type="submit" name="Enviar" value="criar"/>
            </td>
          </form>
       </tr>
       </table>
       </div>
    </body>
</html>