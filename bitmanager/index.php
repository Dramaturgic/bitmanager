<?php
include('auxiliar/conectabd.php');
include("cabecalho.php");
$sql = "SELECT * , tb_categorias.s_nm_categoria 
FROM tb_produtos, tb_categorias 
WHERE s_depart_produto = i_id_categoria 
ORDER BY RAND()";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["op"] == "all") {
    $sql = "SELECT * , tb_categorias.s_nm_categoria 
FROM tb_produtos, tb_categorias 
WHERE s_depart_produto = i_id_categoria 
ORDER BY RAND()";
    $response = mysqli_query($link, $sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["op"] == "jogox") {
    $sql = "SELECT *, tb_categorias.s_nm_categoria FROM
     tb_produtos, tb_categorias
      WHERE s_depart_produto = 1
      AND tb_categorias.i_id_categoria = tb_produtos.s_depart_produto";
    $response = mysqli_query($link, $sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["op"] == "musicax") {
    $sql = "SELECT *, tb_categorias.s_nm_categoria FROM 
    tb_produtos, tb_categorias 
    WHERE s_depart_produto = 3 
    AND tb_categorias.i_id_categoria = tb_produtos.s_depart_produto";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["op"] == "filmex") {
    $sql = "SELECT *, tb_categorias.s_nm_categoria FROM 
    tb_produtos, tb_categorias 
    WHERE s_depart_produto = 2 
    AND tb_categorias.i_id_categoria = tb_produtos.s_depart_produto";
    $response = mysqli_query($link, $sql);
}


$response = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitmanager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="resources/indexstyle.css">
</head>

<body>

    <!-- Carrosel Foda com imagens Fodas de propagandas fodas -->

    <div class="header-inner-content">
        <div class="slideshow-container">

            <div class="mySlides fade">
                <a href=""><img src="https://t.ctcdn.com.br/gzcMsAT56f7vZ30WPwIfmLTVoP4=/48x27:931x524/1200x675/smart/i371015.jpeg" style="width:100%"></a>
            </div>

            <div class="mySlides fade">
                <a href=""><img src="https://uploads.jovemnerd.com.br/wp-content/uploads/2020/06/bloodborne-e-um-jogo-de-terror-lovecraftniano-que-desafia-a-percepcao-do-jogador.jpg" style="width:100%"></a>
            </div>

            <div class="mySlides fade">
                <a href=""><img src="https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_1240/b_white/f_auto/q_auto/ncom/software/switch/70010000001702/dac3a26570b5ca1ddf703bf0add7cc7c527f71a2b56521baf69e20c7a573c610" style="width:100%"></a>
            </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

        </div>
        <br>
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>

        <script>
            let slideIndex = 1;
            let slideInterval;

            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
                resetInterval();
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
                resetInterval();
            }

            function showSlides(n) {
                let i;
                let slides = document.getElementsByClassName("mySlides");
                let dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                    slideIndex = 1;
                }
                if (n < 1) {
                    slideIndex = slides.length;
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
            }

            function resetInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(function() {
                    plusSlides(1);
                }, 3500);
            }
            resetInterval();
        </script>
    </div>
    <br>

    <!-- Conteudo Principal -->

    <main>

        <!-- 3 Imagens mostrando musica, jogo e filme -->

        <div class="gray-background">
            <div class="page-inner-content">
                <div class="cols colunas-3" id="bota">
                    <form action="index.php" method="POST" id="all">
                        <button type="submit" name="op" value="all" class="MAIN_BTN">
                            <img src="resources/imagens/iconall.png" alt="tudo" width="100px" height="100px">
                        </button>
                    </form>
                    <form action="index.php" method="POST" id="jogox">
                        <button type="submit" name="op" value="jogox" class="MAIN_BTN">
                            <img src="resources/imagens/jogos.png" alt="Imagem de introdução 1" width="100px" height="100px">
                        </button>
                    </form>
                    <form action="index.php" method="POST" id="musicax">
                        <button type="submit" name="op" value="musicax" class="MAIN_BTN">
                            <img src="resources/imagens/musicas.png" alt="Imagem de introdução 2" width="100px" height="100px">
                        </button>
                    </form>
                    <form action="index.php" method="POST" id="filmex">
                        <button type="submit" name="op" value="filmex" class="MAIN_BTN">
                            <img src="resources/imagens/filmes.png" alt="Imagem de introdução 3" width="100px" height="100px">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div>
            <div class="page-inner-content">
                <h3 class="section-title">Produtos Disponiveis</h3>
                <div class="subtitle-underline"></div>
                <br><br>
                <div>

                    <div class="product">
                        <?php
                        while ($tbl = mysqli_fetch_array($response)) {
                        ?>
                            <form action="produto.php" method="post">
                                <div class="product-card" method="post">
                                    <img src="resources/imagens/<?= $tbl[13] ?>" alt="Imagem produto 1">
                                    <input type="hidden" name="id" value="<?= $tbl[0] ?>">
                                    <p class="product-name"><?= $tbl[1] ?></p>
                                    <p class="product-price">R$<?= number_format($tbl[7], 2, ',', ' ') ?></p>
                                    <button id="button-products">Sobre o Produto</button>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                    </div>


                </div>
            </div>
        </div>
    </main>
    <?php 
        include('footer.php');
    ?>
</body>

</html>