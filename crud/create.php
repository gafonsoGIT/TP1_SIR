<?php
require_once '../database/connection.php';

$erros = [];
$descricao = '';
$info = '';
$tipo = '';
$foto = '';
$dataRegisto = '';
$imageExist = false;
$temp = '';

session_start();

if (empty($_SESSION['email'])) {
    header('location: ./login/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $info = $_POST['info'];
    $tipo = $_POST['tipo'];
    $dataRegisto = $_POST['dataRegisto'];
    $img_name = $_FILES['foto']['name'];
    $img_size = $_FILES['foto']['size'];
    $tmp_name = $_FILES['foto']['tmp_name']; 

    if (!$descricao) {
        $erros[] = 'A descrição é obrigatória!';
    }

    if (!$info) {
        $erros[] = 'A informação é obrigatória!';
    }

    if (!$tipo) {
        $erros[] = 'O tipo é obrigatório!';
    }

    if (isset($_FILES['foto'])) {
        $img_name = $_FILES['foto']['name'];
        $img_size = $_FILES['foto']['size'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        $error = $_FILES['foto']['error'];

        if($error === 0) {
            if($img_size > 1000000) {
                $erros[] = "Desculpe, a imagem não pode exceder 1mB";
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if(in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name  = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = '../imagens/'.$new_img_name;
                    $imageExist = true;
                }else {
                    $erros[] = "Formato inválido!";
                }
            }
        }
    }

    if (empty($erros)) {
        $statement = $pdo->prepare("INSERT INTO apontamentos(descricao, informacao, tipoApontamento, image_url, email, ativo, dataRegisto) VALUES (:descricao, :info, :tipo, :foto, :email, 1, :dataRegisto);");

        if($imageExist){
            $temp = './imagens/'.$new_img_name;
        }
        
        $statement->bindValue(':descricao', $descricao);
        $statement->bindValue(':info', $info);
        $statement->bindValue(':tipo', $tipo);
        $statement->bindValue(':foto', $temp);
        $statement->bindValue(':dataRegisto', $dataRegisto);
        $statement->bindValue(':email', $_SESSION['email']);
        move_uploaded_file($tmp_name, $img_upload_path);

        $statement->execute();
        header('location: ../main.php');
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
      <form method="POST" enctype="multipart/form-data">
        <div class="inputcontainer">
            <b><label>Tipo</label>
            <input type="text" name="tipo" placeholder="Ex. Aniversário"/>
            <br style="clear:both;"/>
            <b><label>Descrição</label>
            <input type="text" name="descricao" placeholder="Ex. Aniversário da Maria no dia 16"/>
            <br style="clear:both;"/>
            <b><label>Informação</label>
            <input type="text" name="info" placeholder="Ex. Levar a prenda"/>
            <br style="clear:both;"/>
            <b><label>Data</label>
            <input type="date" name="dataRegisto" value="<?php if(empty($dataRegisto)) echo (date('Y-m-d')); else echo($apontamentos['dataRegisto']);  ?>"/>
            <br style="clear:both;"/>
            <b><label>Foto (opcional)</label>
            <input type="file" name="foto">
            <br style="clear:both;"/>
            <button type="submit" class="buttonadd1">Criar apontamento</button>
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
