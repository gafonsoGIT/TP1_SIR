<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Prático</title>
    <link rel="stylesheet" href="../registar/registar.css">
    <style>
        body{
            background: rgb(9,115,121);
            background: linear-gradient(90deg, rgba(9,115,121,1) 16%, rgba(218,216,32,1) 100%);
        }
    </style>
</head>
<body>
    <div class="grid">
        <div class="imagem">
            <img src="../imagens/logo.png" alt="imagem"/>
        </div>
        <div class="registo">
            <form action="index.php">
                <br><h1>Criar conta</h1>
                <div class="distanciar">
                    <br><b><label for="username">Nome de Utilizador: </label></b>
                    <input type="text" name="username" placeholder="Nome de utilizador..."/><br>
                    <br><b><label for="username">Palavra-passe: </label></b>
                    <input type="password" name="password" placeholder="Palavra-passe..."/><br>
                    <input type="submit" value="Criar conta" class="button">
                    <button class="button2" formaction="../login/login.php">Cancelar</button> 
                </div>
            </form>
        </div>
    <div>
</body>
</html>