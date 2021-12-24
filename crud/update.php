<?php
require_once '../database/connection.php';

$id = $_GET['id'] ?? null;

if (!$_GET['id']) {
    header('location: main.php');
    exit;
}

$statement = $pdo->prepare("SELECT * FROM apontamentos WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$apontamentos = $statement->fetch(PDO::FETCH_ASSOC);

// $descricao = $apontamentos['descricao'];
// $info = $apontamentos['info'];
// $tipo = $apontamentos['tipo'];

$erros = [];
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
        $statement = $pdo->prepare("UPDATE apontamentos SET descricao = :descricao, informacao = :info, tipoApontamento = :tipo WHERE id = :id");
        $statement->bindValue(':descricao', $descricao);
        $statement->bindValue(':info', $info);
        $statement->bindValue(':tipo', $tipo);
        $statement->bindValue(':id', $id);

        $statement->execute();
        header('location: main.php');
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
    <style>
    body {
        background-color: lightblue;
    }
    </style>
</head>
<body>
</body>
    <div class="container">
      <form method="POST">
        <div class="inputcontainer">
            <b><label>Descrição</label>
            <input type="text" name="descricao" placeholder="Ex. Aniversário da Maria no dia 16"/>
            <br style="clear:both;"/>
            <b><label>Informação</label>
            <input type="text" name="info" placeholder="Ex. Levar a prenda"/>
            <br style="clear:both;"/>
            <b><label>Tipo</label>
            <input type="text" name="tipo" placeholder="Ex. Aniversário"/>
            <br style="clear:both;"/>
            <b><label>Foto</label>
            <input type="file" name="foto">
            <br style="clear:both;"/>
            <button type="submit" class="buttonadd1">Atualizar apontamento</button>
            <br><a style="color: rgb(10,145,171);" href="../main.php">Cancelar</a>
        </div>
      </form>
        <?php if (!empty($erros)): ?>
                <div class="erros">
                    <?php foreach($erros as $erro) : ?>
                        <div><?php echo $erro ?></div>
                    <?php endforeach; ?>
                </div>
        <?php endif ?>
    </div>
</html>