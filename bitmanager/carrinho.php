<?php
//Inclusão do cabecalho
include('cabecalho.php');
//Conexão com o banco e verificação de sessão
include('auxiliar/conectabd.php');
if (session_id() === "") session_start();

//verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
?>
    <meta http-equiv="refresh" content="1;url=login.php?msg=Você precisa fazer login antes.">
    <?php
    exit();
}

//Verifica se o cliente já tem carrinho criado
if (!isset($_SESSION['carrinho'])) {
    //Se não tiver cria o carrinho
    $_SESSION['carrinho'] = rand(111111, 99999999) . $_SESSION['id'];
}

//Adicionar produto no carrinho
if (isset($_POST['op']) && $_POST['op'] == 'incluir') {
    $id = $_POST['id'];
    $quantidade = $_POST['quantidade'];
    //Verifica se o produto já está no carrinho
    $sql = "SELECT COUNT(*) FROM tb_carrinhos 
    WHERE i_produto_id_carrinho = $id AND 
    s_cod_carrinho = {$_SESSION['carrinho']}";

    $result = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($result)) {
        $total = $tbl[0];
    }
    if ($total != 0) {
    ?>
        <meta http-equiv="refresh" content="1;url=carrinho.php">
    <?php
        exit();
    }

    //String de conexão de inserção do carrinho
    $sql = "INSERT INTO `tb_carrinhos`(`s_cod_carrinho`,
         `i_produto_id_carrinho`, `i_qtde_carrinho`,
         `i_usuario_id_carrinho`, `i_stat_carrinho`,
         `d_dt_carrinho`)
         VALUES ('{$_SESSION["carrinho"]}',
         '$id','$quantidade','{$_SESSION["id"]}',0,
         (SELECT CURRENT_TIMESTAMP()))";
    mysqli_query($link, $sql);
    ?>
    <meta http-equiv="refresh" content="1;url=carrinho.php">
<?php
}

//Verificação da operação que foi chamada no carrinho = "Apagar"
if (isset($_POST['op']) && $_POST['op'] == 'apagar') {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_carrinhos WHERE i_id_carrinho = $id";
    mysqli_query($link, $sql);
?>
    <meta http-equiv="refresh" content="1;url=carrinho.php">
    <?php
}

//Verificação da operação que foi chamada no carrinho = "Alterar"
if (isset($_POST['op']) && $_POST['op'] == 'alterar') {
    $id = $_POST['id'];
    if ($_POST['tipo'] == 'menos') {
        $sql = "SELECT i_qtde_carrinho 
        FROM tb_carrinhos WHERE i_id_carrinho = $id";
        $result = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($result)) {
            $quanti = $tbl[0];
        }
        if ($quanti <= 1) {
    ?>
            <meta http-equiv="refresh" content="1;url=carrinho.php">
        <?php
            exit();
        }

        //String de conexão de atualização do carrinho
        $sql = "UPDATE tb_carrinhos set i_qtde_carrinho =
        (SELECT i_qtde_carrinho FROM tb_carrinhos WHERE i_id_carrinho = $id) -1
        WHERE i_id_carrinho = $id";
        mysqli_query($link, $sql);
        ?>
        <meta http-equiv="refresh" content="1;url=carrinho.php">
        <?php
    }

    //Verifica operação solicitada no carrinho
    if ($_POST['tipo'] == 'mais') {
        $sql = "SELECT i_qtde_carrinho, i_produto_id_carrinho 
        FROM tb_carrinhos WHERE i_id_carrinho = $id";
        $result = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($result)) {
            $quanti_carrinho = $tbl[0];
            $id_produto = $tbl[1];
        }
        //String de conexão de seleção do estoque do produto no carrinho
        $sql = "SELECT i_estoq_produto FROM tb_produtos
        WHERE i_id_produto = $id_produto";
        $result = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($result)) {
            $quanti_estoque = $tbl[0];
        }
        if ($quanti_carrinho >= $quanti_estoque) {
        ?>
            <meta http-equiv="refresh" content="1;url=carrinho.php">
        <?php
            exit();
        }

        //String de conexão de atualização do carrinho
        $sql = "UPDATE tb_carrinhos set i_qtde_carrinho =
        (SELECT i_qtde_carrinho FROM tb_carrinhos WHERE i_id_carrinho = $id) +1
        WHERE i_id_carrinho = $id";
        mysqli_query($link, $sql);
        ?>
        <meta http-equiv="refresh" content="1;url=carrinho.php">
<?php
    }
}

//String de conexão de seleção dos produtos a serem exibidos no carrinho
$sql = "SELECT tb_produtos.s_nm_produto,
  tb_produtos.s_foto_produto,
  tb_produtos.dc_prec_produto,
  tb_produtos.i_estoq_produto,
  tb_carrinhos.i_qtde_carrinho,
  (tb_produtos.dc_prec_produto * tb_carrinhos.i_qtde_carrinho)as v_tot,
  tb_carrinhos.i_id_carrinho
FROM tb_produtos, tb_carrinhos 
WHERE tb_carrinhos.i_produto_id_carrinho = tb_produtos.i_id_produto AND
s_cod_carrinho = {$_SESSION['carrinho']}";

$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            text-align: center;
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

        .qtde {
            display: block;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border: 1px solid #6b4fa0;
            color: #fff;
            background-color: #6b4fa0;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .qtde:hover {
            background-color: #41217e;
            border-color: #41217e;
        }

        .btn_carrinho {
            display: block;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            border: 2px solid #6b4fa0;
            background-color: #6b4fa0;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
            text-decoration: none;

        }

        .btn_carrinho>a {
            text-decoration: none;
            color: #fff;

        }

        .btn_carrinho:hover {
            background-color: #41217e;
            border-color: #41217e;

        }

        .finalizar-carrinho {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td></td>
            <td></td>
            <td>Produto</td>
            <td>Valor Unit.</td>
            <td>Valor</td>

            <td>Remover</td>
        </tr>
        <?php
        $valor_total = 0;
        while ($tbl = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><img src="resources/imagens/<?= $tbl[1] ?>" width="50"></td>
                <td><?= $tbl[0] ?></td>
                <td>
                    <div class="qty-container">
                        <form action="carrinho.php" method="post">
                            <input type="hidden" name="op" value="alterar">
                            <input type="hidden" name="tipo" value="menos">
                            <input type="hidden" name="id" value="<?= $tbl[6] ?>">
                            <input type="submit" id="menos" value="-" class="qtde">
                        </form>
                        <?= $tbl[4] ?>
                        <form action="carrinho.php" method="post">
                            <input type="hidden" name="op" value="alterar">
                            <input type="hidden" name="tipo" value="mais">
                            <input type="hidden" name="id" value="<?= $tbl[6] ?>">
                            <input type="submit" id="mais" value="+" class="qtde">
                        </form>
                    </div>
                </td>

                <td>R$ <?= number_format($tbl[2], 2, ',', ' ') ?></td>
                <td>R$ <?= number_format($tbl[5], 2, ',', ' ') ?></td>
                <td>
                    <form action="carrinho.php" method="post">
                        <input type="hidden" name="op" value="apagar">
                        <input type="hidden" name="id" value="<?= $tbl[6] ?>">
                        <input type="submit" id="remove" value="Remover" class="btn_carrinho">
                    </form>
                </td>
            </tr>
        <?php
            $valor_total += $tbl[5];
        }
        ?>

        <tr>
            <td></td>
            <td></td>
            <td><button id="voltar" class="btn_carrinho">
                <a href="index.php">Voltar à loja</a>
            </button></td>
            <td>TOTAL:</td>
            <td>R$ <?= number_format($valor_total, 2, ',', ' ') ?></td>
            <td></td>
        </tr>

    </table>
    <a href="finalizar.php" class="finalizar-carrinho"><button id="finalizar" class="btn_carrinho" <?= $_SESSION['produtos_carrinho'] == 0 ? 'Disabled' : '' ?>>Finalizar Compra</button></a>
</body>

</html>