<?php
require_once '../database/connection.php';

$id = $_POST['id'] ?? null;

if (!$_POST['id']) {
    header('location: ../main.php');
    exit;
}

$statement = $pdo->prepare("UPDATE apontamentos SET ativo = 0 WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();

header('location: ../main.php');