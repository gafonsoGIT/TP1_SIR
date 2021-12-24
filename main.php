<?php 

require_once './database/connection.php';

$statement = $pdo->prepare("SELECT * FROM apontamentos");
$statement->execute();
$apontamentos = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Prático</title>
    <link rel="stylesheet" href="./styles/style.css">
    <style>
    body {
        background-color: lightblue;
    }
    </style>
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
        <a class="button" href="index.php" id="Logioutchi" >Terminar sessão</a> 
    </form>

    <h1 class="tit">Lista de Apontamentos</h1>
      <button class="buttonadd" onclick="window.location.href='./crud/create.php'">Adicionar apontamento</button>
      <ul>
        <?php foreach ($apontamentos as $apontamento) : ?>
            <li class="">
                <div class="container">
                    <a href="./crud/update.php?id=<?php echo $apontamento['id'] ?>" style="color: rgb(10,145,171);">Editar</a>
                    <form action="./crud/delete.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $apontamento['id'] ?>">
                        <button type="submit" class="buttondel">Apagar</button>
                    </form>
                    <h4><?php echo $apontamento['id'] . ' - ' . $apontamento['descricao'] ?></h4>
                    <h4 class=""><?php echo $apontamento['informacao'] ?></h4>
                    <h4><?php echo $apontamento['tipoApontamento'] ?></h4>
                    <?php if ($apontamento['descricao']) : ?>
                        <p><?php echo $apontamento['descricao'] ?></p>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>