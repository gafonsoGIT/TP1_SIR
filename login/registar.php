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
            <form action="index.php">
                <br><h1>Criar conta</h1>
                <div class="distanciar">
                    <br><b><label for="nome">Nome Completo</label></b>
                    <input type="text" name="username" placeholder="Nome Completo..."/><br>
                    <br><b><label for="email">Email</label></b>
                    <input type="text" name="email" placeholder="Email..."/><br>
                    <br><b><label for="username">Palavra-passe</label></b>
                    <input type="password" name="password" placeholder="Palavra-passe..."/><br>
                    <input type="submit" value="Criar conta" class="button">
                </div>
            </form>
            <a class="button2" href="/TP1_SIR">Cancelar</a> 
        </div>
    <div>
</body>
</html>