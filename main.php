<?php 

require_once './database/connection.php';

session_start();

if (empty($_SESSION['email'])) {
    header('location: ./login/login.php');
}

$statement = $pdo->prepare("SELECT * FROM apontamentos where email = :email AND ativo = 1");
$statement->bindValue(':email', $_SESSION['email']);
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
        <div class="container">
            <ul>
                <?php foreach ($apontamentos as $apontamento) : ?>
                    <li>
                        <a href="./crud/update.php?id=<?php echo $apontamento['id'] ?>" class="edit">Editar</a>
                        <form action="./crud/delete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $apontamento['id'] ?>">
                            <button type="submit" class="buttondel">Apagar</button>
                        </form>
                        <?php if(empty($apontamento['image_url'])){?>
                            <img src="./imagens/lembrete.png" style="width: 250px; height: 220px; margin-top: -27px; border-radius: 10px"/>
                        <?php } else {?>
                        <img src="<?php echo $apontamento['image_url']?>" style="width: 250px; height: 220px; margin-top: -27px; border-radius: 10px"/><?php } ?>
                        <div class="apt">
                            <h4>Tipo: </h4><?php echo ' ' . $apontamento['tipoApontamento'].' '?><br><br>
                            <h4>Descrição: </h4><?php echo ' ' . $apontamento['descricao'] . ' ' ?><br><br>
                            <h4>Informação: </h4><?php echo ' ' . $apontamento['informacao']?><br><br>
                            <h4>Data: </h4><?php echo ' ' . $apontamento['dataRegisto']?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
</body>
</html>