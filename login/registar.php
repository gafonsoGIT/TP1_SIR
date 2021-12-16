<?php
require_once '../database/connection.php';

$nome = '';
$email = '';
$passwd = '';

$erro_email = '';
$erro_password = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST["email"];
    $passwd = $_POST['passwd'];
   
    $regex1 = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    if (!preg_match($regex1, $email)) {
        $erro_email = 'Email inválido!';
    }
    
    $regex2 = '/^\S*(?=\S{8,})/';
    if (!preg_match($regex2, $passwd)) {
        $erro_password = 'A password tem de ter pelo menos 8 carateres';
    }

    if(empty($erro_email) && empty($erro_password)){
    $statement = $pdo->prepare("INSERT INTO utilizadores(nome,email,passwd) VALUES (:nome, :email, :passwd);");

    $statement->bindValue(':nome', $nome);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':passwd', $passwd);

    $utilizador = $statement->execute();

        if($utilizador){
            header('location: ../main.php');
        }
    }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Prático</title>
    <link rel="stylesheet" href="login.css">
    <style>
        body{
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <div class="grid">
        <div class="imagem">
            <img src="../imagens/logo.png" alt="imagem"/>
        </div>
        <div class="login">
            <form method="POST" action="registar.php">
                <br><h1>Criar conta</h1>
                <div class="distanciar">
                    <br><b><label for="nome">Nome Completo</label></b>
                    <input type="text" name="nome" placeholder="Nome Completo..." required/><br>
                    <br><b><label for="email">Email</label></b>
                    <input type="text" name="email" placeholder="Email..." required/><br>
                    <br><b><label for="passwd">Palavra-passe</label></b>
                    <input type="password" name="passwd" placeholder="Palavra-passe..." required/><br>
                    <button type="submit" class="button">Criar conta</button>
                </div>
            </form>
            <?php if ($erro_email): ?>
                <div class="error">
                    <div><?php echo $erro_email ?></div>
                </div>
            <?php endif ?>
            <?php if ($erro_password): ?>
                <div class="error1">
                    <div><?php echo $erro_password ?></div>
                </div>
            <?php endif ?>
            <a class="button2" href="login.php">Cancelar</a> 
        </div>
    <div>
</body>
</html>