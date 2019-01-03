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
<html>
    <head>
       <title>Documentos</title>
    </head>
    <body>
       <ul>

<?php while($linha = $conn->query("SELECT * FROM tb_documento")): ?>
      <li><?php print_r($linha); ?></li>
<?php endwhile; ?>
       </ul>
    </body>
</html>