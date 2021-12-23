<?php
require_once '../database/connection.php';

$erros = [];
$descricao = '';
$info = '';
$tipo = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $info = $_POST['info'];
    $tipo = $_POST['tipo'];

    if (!$descricao) {
        $erros[] = 'A descrição é obrigatória!';
    }

    if (!$info) {
        $erros[] = 'A informação é obrigatória!';
    }

    if (!$tipo) {
        $erros[] = 'O tipo é obrigatório!';
    }

    if (empty($erros)) {
        $statement = $pdo->prepare("INSERT INTO apontamentos(descricao, informacao, tipoApontamento) VALUES (:descricao, :info, :tipo);");

        $statement->bindValue(':descricao', $descricao);
        $statement->bindValue(':info', $info);
        $statement->bindValue(':tipo', $tipo);

        $statement->execute();
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
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
</body>
    <div class="container">
      <form method="POST">
        <div class="alinhar">
            <label>Descrição</label>
            <input type="text" name="descricao" placeholder=" Ex. Aniversário da Maria no dia 16 " />
            <p>
            <label>Informação</label>
            <input type="text" name="info" placeholder=" Ex. Levar a prenda " />
            </p>
            <p>
            <label>Tipo</label>
            <input type="text" name="tipo" placeholder="Ex. Aniversário " />
            </p>
            <button type="submit" class="button">Criar apontamento</button>
        </div>
      </form>
    </div>
</html>
