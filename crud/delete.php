<?php
require_once '../database/connection.php';

$idProduto = $_POST['id'] ?? null;

if (!$_POST['id']) {
    header('location: main.php');
    exit;
}

$statement = $pdo->prepare("DELETE FROM apontamentos WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();

header('location: main.php');