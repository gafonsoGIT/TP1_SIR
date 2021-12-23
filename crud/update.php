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
$apontamento = $statement->fetch(PDO::FETCH_ASSOC);

$descricao = $apontamento['descricao'];
$info = $apontamento['info'];
$tipo = $apontamento['tipo'];

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