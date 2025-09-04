<?php
//Conexão com o banco
include('auxiliar/conectabd.php');
//String de conexão de seleção onde trazemos os nossos filmes
$sql = "SELECT * , tb_categorias.s_nm_categoria FROM tb_produtos, tb_categorias WHERE s_depart_produto = 2 AND tb_categorias.i_id_categoria = tb_produtos.s_depart_produto";
$response = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Lista de Filmes</title>
    <style>
        .header {
            text-align: center;
        }

        .tabela {
            padding: 0 100px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Estilo da tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-family: Arial, sans-serif;
        }

        /* Estilo das células da tabela */
        td,
        th {
            padding: 10px;
            border: 1px solid black;
        }

        /* Estilo das células do cabeçalho */
        th {
            background-color: #9b57c3;
            color: white;
        }

        /* Estilo das linhas pares */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Estilo ao passar o mouse sobre as linhas */
        tr:hover {
            background-color: #909090;
        }

        /* Estilo para células com texto centralizado */
        td.text-center,
        th.text-center {
            text-align: center;
        }

        /* Estilo para células com texto alinhado à direita */
        td.text-right,
        th.text-right {
            text-align: right;
        }

        /* Estilo para cabeçalhos com texto em negrito */
        th {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    include('cabecalho.php');
    include('seguranca1.php');
    ?>
    <div class="header">
        <h1>Lista de Filmes</h1>
    </div>
    <div class="tabela">
        <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Gênero</th>
                <th>Departamento</th>
                <th>Classe Etária</th>
                <th>Data de Lançamento</th>
                <th>Preço</th>
                <th>Direção</th>
                <th>Capa</th>
                <th>Estoque</th>
                <?php
                if ($_SESSION['nivel'] == 10) {
                ?>
                    <th></th>
                    <th></th>
                <?php
                }
                ?>
            </tr>
            <?php
            while ($tbl = mysqli_fetch_array($response)) {
            ?>
                <tr>
                    <td><?= $tbl[1] ?></td>
                    <td><?= $tbl[2] ?></td>
                    <td><?= $tbl[3] ?></td>
                    <td><?= $tbl[4] ?></td>
                    <td><?= $tbl[5] ?></td>
                    <td><?= date("d/m/Y", strtotime($tbl[6])) ?></td>
                    <td>R$ <?= number_format($tbl[7], 2, ',', ' ') ?></td>
                    <td><?= $tbl[9] ?></td>
                    <td><img src="imagens/<?= $tbl[13] ?>" width="60"></td>
                    <td><?= $tbl[14] ?></td>
                    <?php
                    if ($_SESSION['nivel'] == 10) {
                    ?>
                        <td><a href="alterafilme.php?prodid=<?= $tbl[0] ?>"><i class="material-icons">mode_edit</i></a></td>
                        <td><a href="deletafilme.php?prodid=<?= $tbl[0] ?>"><i class="material-icons">delete_forever</i></a></td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>