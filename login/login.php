<?php
    require_once('../database/connection.php');

    $email = '';
    $passwd = '';

    $mensagem_erro="";

    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];

        $statement = $pdo->prepare("SELECT email, passwd FROM utilizadores WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();

        $utilizador = $statement->fetch(PDO::FETCH_ASSOC);

        if($utilizador){
            if($utilizador['passwd'] === $passwd){
                $_SESSION['email'] = $utilizador['email'];
                header('location: ../main.php');
            }
            else {
                $mensagem_erro = 'Credenciais erradas!';
            }
        }
        else {
            $mensagem_erro = 'O utilizador não existe!';
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
            <form method="POST" action="login.php">
                <br><h1>Iniciar Sessão</h1>
                <div class="distanciar">
                    <br><b><label for="email">Email</label></b>
                    <input type="text" name="email" placeholder="Email" required/><br>
                    <br><b><label for="passwd">Palavra-passe</label></b>
                    <input type="password" name="passwd" placeholder="Palavra-passe" required/><br>
                    <button type="submit" class="button">Entrar</button>
                </div>
            </form>
            <?php if ($mensagem_erro): ?>
                <div class="erro">
                    <div><?php echo $mensagem_erro ?></div>
                </div>
            <?php endif ?>
            <a class="button2" href="./registar.php">Registar</a>
        </div>
    <div>
</body>
</html>