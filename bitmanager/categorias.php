<?php
//Inclusão do cabecalho
include('cabecalho.php');
//Conexão com o banco
include('auxiliar/conectabd.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['op'] == 'cadastrar'){
        $cat = $_POST['cat'];
        $sql = "SELECT COUNT(*) FROM tb_categorias WHERE s_nm_categoria = '$cat'";
        $result = mysqli_query($link,$sql);
        while($tbl = mysqli_fetch_array($result)){
            $total = $tbl[0];
        }
        if($total == 0){
            $sql = "INSERT INTO tb_categorias (s_nm_categoria)
                    VALUES ('$cat')";
            mysqli_query($link, $sql);
        }
    }
    elseif($_POST['op'] == 'apagar'){
        $cat = $_POST['cat'];

        $sql = "SELECT COUNT(*) FROM tb_produtos WHERE s_depart_produto = '$cat'";
        $result = mysqli_query($link,$sql);
        while($tbl = mysqli_fetch_array($result)){
            $total = $tbl[0];
        }
        if($total == 0){
            $sql = "DELETE FROM tb_categorias WHERE i_id_categoria = $cat";
            mysqli_query($link, $sql);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        img {
            position: relative;
            top: -71px;
            right: -407px;
        }
    </style>
</head>
<body>
<div class="w3-container form-container">
        <h1>Cadastro de Categoria</h1>
        <form action="categorias.php" method="POST">

            <label for="cat">Categoria</label>
            <input type="text" name="cat" id="cat" maxlength="25" required>
            <input type="hidden" name="op" value="cadastrar">

            <input type="submit" value="Cadastrar">
        </form>
        <?php
        if (isset($_GET['msg'])) {
            $mensagem = $_GET['msg'];
            echo ("<p class='msg'>$mensagem</p>");
            if($mensagem == "Dados incorretos"){
                echo("<p class='msg'><a href='recupera.php'>Recuperar senha</a>");
            }
        }
        ?>
    </div>
    <div class="w3-container form-container">
        <h1>Apagar Categoria</h1>
        <form action="categorias.php" method="POST">

            <label for="cat">Categoria</label>
        
            <select name="cat">
            <?php
                $sql = "SELECT * FROM tb_categorias ORDER BY s_nm_categoria";
                $result = mysqli_query($link,$sql);
                while($tbl = mysqli_fetch_array($result)){
                    ?>
                    <option value="<?=$tbl[0]?>"><?=$tbl[1]?></option>
                    <?php
                }
            ?>
           </select>

            <input type="hidden" name="op" value="apagar">

            <input type="submit" value="Apagar">
        </form>
        <?php
        if (isset($_GET['msg'])) {
            $mensagem = $_GET['msg'];
            echo ("<p class='msg'>$mensagem</p>");
            if($mensagem == "Dados incorretos"){
                echo("<p class='msg'><a href='recupera.php'>Recuperar senha</a>");
            }
        }
        ?>
    </div>
</body>
</html>