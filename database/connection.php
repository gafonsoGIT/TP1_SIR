<?php

$host = 'localhost';
$dbname = 'tp1_sir';
$user = 'root';
$password = '12131415';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro durante a conexão à BD';
    echo $e->getMessage();
    exit();
}