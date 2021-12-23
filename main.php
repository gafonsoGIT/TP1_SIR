<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Prático</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<?php
  session_start();
  if(!empty($_POST['logout'])) {
      session_unset();
      session_destroy();
  }
  ?>
    <form method="POST" action="main.php">
        <a class="button" href="index.php">Terminar sessão</a> 
    </form>

    <h1>Lista de Apontamentos</h1>
      <a class="" href="./crud/create.php">Adicionar apontamento</a>
    
</body>
</html>