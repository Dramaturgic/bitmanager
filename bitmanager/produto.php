<?php
//Inclusão do cabecalho
include('cabecalho.php');
//Atribuição das variáveis e conexão com o banco
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    include('auxiliar/conectabd.php');
    $sql = "SELECT * , tb_categorias.s_nm_categoria 
    FROM tb_produtos, tb_categorias 
    WHERE s_depart_produto = i_id_categoria 
    AND i_id_produto = $id";
    $result = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($result)) {
        $nome = $tbl[1];
        $descricao = $tbl[2];
        $genero = $tbl[3];
        $departamento = $tbl[4];
        $classet = $tbl[5];
        $dtlancamento = $tbl[6];
        $valor = $tbl[7];
        $artista = $tbl[8];
        $direcao = $tbl[9];
        $desenvolvedor = $tbl[10];
        $chaveativacao = $tbl[11];
        $video = $tbl[12];
        $foto = $tbl[13];
        $estoque = $tbl[14];
    }
} else {
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
    <title>Detalhes do produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eddbc4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 20px auto;
            margin-top: 20px; /* Adiciona espaçamento entre as imagens e o contêiner */
        }

        .product {
            display: flex;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .product-images {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
        }

        .product-images img {
            max-width: 330px;
            height: auto;
            padding: 20px;
            border-radius: 10px; /* Adiciona bordas arredondadas */
        }

        .product-details {
            flex: 1;
            padding: 20px;
        }

        .product-details h1 {
            font-size: 28px;
            color: #333;
        }

        .product-details p {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        .product-details .sinopse {
            font-style: italic;
        }

        .product-details .characteristics {
            margin-bottom: 20px;
        }

        .buy-now {
            text-align: center;
        }

        .buy-now button {
            padding: 10px 20px;
            background-color: #6b4fa0;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .buy-now button:hover {
            background-color: #351b64;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="product">
            <div class="product-images">
                <img src="resources/imagens/<?= $foto ?>" alt="Imagem do Produto" class="product-image">
                <video src="resources/videos/<?= $video ?>" type="video/mp4" controls autoplay width="500px" alt="Vídeo do Produto" class="product-image"></video>
            </div>
            <form action="carrinho.php" method="post">
                <div class="product-details">
                    <h1><?= $nome ?></h1>

                    <p class="descricao"><?= $descricao ?></p>
                    <p class="genero"><strong>Genero:</strong> <?= $genero ?></p>
                    <p class="classet"><strong>Classe Etária:</strong> <?= $classet ?></p>
                    <p><strong>Data de Lançamento:</strong></p><input type="date" name="date" value="<?= $dtlancamento ?>" min="1900-01-01" max="<?= $dtlancamento ?>" disabled>
                    <p><strong>Departamento:</strong> <?= $departamento ?></p>
                    <p><strong>Artista:</strong> <?= $artista ?></p>
                    <p><strong>Direção:</strong> <?= $direcao ?></p>
                    <p><strong>Desenvolvedor:</strong> <?= $desenvolvedor ?></p>
                    <input type="hidden" name="op" value="incluir">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="number" name="quantidade" value="1" min="1" max="<?=$estoque?>">
                    <p><strong>Valor:</strong> $<?= $valor ?></p>
                    
                    <div class="buy-now">
                        <button>Comprar Agora</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>