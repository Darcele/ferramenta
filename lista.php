<?php

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
<html>
    <head>
       <title>Documentos</title>
    </head>
    <body>
       <table border="1">
      <tr>
          <td>Nome</td>
          <td>Caminho do arquivo</td>
          <td colspan="2">Comandos</td>
       </tr>
<?php foreach ($conn->query("SELECT * FROM tb_documento", PDO::FETCH_ASSOC) as $linha): ?>
      <tr>
          <td><?=$linha['nome']?></td>
          <td><?=$linha['caminho']?></td>
          <td><a href="editar.php?id=<?=$linha['id']?>">Editar</a></td>
          <td><a href="testar.php?id=<?=$linha['id']?>">testar</a></td>
       </tr>
<?php endforeach; ?>
       <tr>
         <form  method="post" enctype="multipart/form-data">
            <td colspan="2" align="right">Novo documento:</td>
            <td>
                 <input type="file" name="doc" />
            </td>
            <td>
                 <input type="submit" name="Enviar" />
            </td>
          </form>
       </tr>
       </table>
    </body>
</html>