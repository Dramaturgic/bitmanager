<?php
session_start();
if (!isset($_SESSION['carrinho'])) {
    header("Location: index.php");
}
include('auxiliar/conectabd.php');
//Traga tudo da tabela carrinho em que o codigo seja 'carrinho'
$sql = "SELECT * FROM tb_carrinhos 
WHERE s_cod_carrinho = {$_SESSION['carrinho']}";
$result = mysqli_query($link, $sql);
while ($tbl = mysqli_fetch_array($result)) {
    //Atualiza a tabela produtos**********
    //Atualiza da tabela produtos e coloque(SET) o valor no Estoque
    $sql2 = "UPDATE tb_produtos SET i_estoq_produto = 
    ((SELECT i_estoq_produto 
    FROM tb_produtos 
    WHERE i_id_produto = $tbl[2]) - $tbl[3])
    WHERE i_id_produto = $tbl[2]";

    mysqli_query($link, $sql2);
}
//Atualiza a tabela carrinho
$sql3 = "UPDATE tb_carrinhos 
         SET i_stat_carrinho = 1 
         WHERE s_cod_carrinho = {$_SESSION['carrinho']}";
mysqli_query($link, $sql3);
unset($_SESSION['carrinho']);


if (isset($_SESSION['nivel']) || $_SESSION['nivel'] != 10) {
?>
    <meta http-equiv="refresh" content="1;url=index.php">
<?php
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada</title>
    <meta http-equiv="refresh" content="2; URL='index.php'">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #FF69B4;
            /* Cor rosa */
            color: #fff;
            /* Texto branco */
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        .remove-btn {
            color: #fff;
            font-size: 16px;
            background-color: #FF6347;
            /* Cor laranja */
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 50%;
            /* Transforma em um círculo */
            padding: 10px;
            /* Mais espaço interno */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Sombra suave */
            outline: none;
            /* Remove a borda ao focar */
        }

        .remove-btn:hover {
            background-color: #FF4500;
            /* Cor laranja mais vibrante */
            transform: scale(1.1);
            /* Efeito de escala */
        }

        .quantty-container {
            display: flex;
            align-items: center;
        }

        .quantty-container form {
            margin-right: 5px;
        }

        .quantty-container input[type="submit"] {
            background-color: #6b4fa0;
            /* Cor rosa */
            border: 1px solid #ccc;
            color: #fff;
            /* Texto branco */
            padding: 5px 10px;
            border-radius: 3px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .quantty-container input[type="submit"]:hover {
            background-color: #6b4fa0;
            /* Rosa mais vibrante */
        }

        .quantty-container span {
            font-size: 16px;
            margin: 0 5px;
        }

        .quantty-value {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 50px;
            font-size: 16px;
            margin-right: 5px;
            margin-left: 5px;
        }

        #finalizar {
            display: block;
            margin: 20px auto;
            /* Centraliza o botão */
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border: 2px solid #6b4fa0;
            /* Cor rosa */
            color: #fff;
            /* Texto branco */
            background-color: #6b4fa0;
            /* Cor rosa */
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        #finalizar:hover {
            background-color: #6b4fa0;
            /* Rosa mais vibrante */
            border-color: #6b4fa0;
            /* Rosa mais vibrante */
        }

        #finalizar:active {
            background-color: #6b4fa0;
            /* Rosa mais clara */
            border-color: #6b4fa0;
            /* Rosa mais clara */
        }
    </style>
</head>

<body>
    <h1>Obrigado pela compra!</h1>
</body>

</html>