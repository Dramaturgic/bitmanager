<?php
//Inclusão do cabecalho
include('cabecalho.php');
//Verifica a segurança do site pelo administrador
include('seguranca10.php');
//Conexão com o banco e atribuições das variáveis
include('auxiliar/conectabd.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    $descricao = $_POST['descricao'];
    $genero = $_POST['genero'];
    $departamento = 2;
    $classet = $_POST['classet'];
    $lancamento = $_POST['lancamento'];
    $preco = $_POST['preco'];
    $direcao = $_POST['direcao'];
    $estoque = $_POST['estoque'];
    $video = $_POST['video'];
    $foto = $_POST['foto'];

    if ($video == "") {
        $video = "none.jpg";
    }
    if ($foto == "") {
        $foto = "none.jpg";
    }

    //String de conexão de inserção do produto
    $sql = "INSERT INTO tb_produtos (s_nm_produto, s_descri_produto, s_gen_produto, s_depart_produto,
    s_claset_produto, dt_dtlanc_produto, dc_prec_produto, s_direc_produto,
    i_estoq_produto, s_vid_produto, s_foto_produto) VALUES ('$produto', '$descricao',
    '$genero','$departamento', '$classet', '$lancamento', '$preco', '$direcao', '$estoque', '$video', '$foto')";

    mysqli_query($link, $sql);
?>
    <meta http-equiv="refresh" content="1;url=listafilmes.php">
<?php
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Filme</title>
    <link rel="stylesheet" href="resources/cadstyle.css">
    <style>
        #bitmanager{
            top: 6px;
        }
    </style>
</head>

<body>
    <div id="cad">
        <div class="w3-container form-container">
            <h1>Cadastro de Filme</h1>
            <form action="cadastrafilme.php" method="POST" class="w3-container">
                <label for="produto">Nome:</label>
                <input type="text" name="produto" id="produto" maxlength="50" required>

                <label for="descricao">Sinopse:</label>
                <textarea name="descricao" id="descricao" maxlength="100" required></textarea>

                <label for="genero">Gênero:</label>
                <select name="genero" id="genero" required>
                    <option value="Ação">Ação</option>
                    <option value="Animação">Animação</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Comédia">Comédia</option>
                    <option value="Crime">Crime</option>
                    <option value="Documentário">Documentário</option>
                    <option value="Drama">Drama</option>
                    <option value="Família">Família</option>
                    <option value="Fantasia">Fantasia</option>
                    <option value="Ficção Científica">Ficção Científica</option>
                    <option value="Horror">Horror</option>
                    <option value="Musical">Musical</option>
                    <option value="Mistério">Mistério</option>
                    <option value="Romance">Romance</option>
                    <option value="Suspense">Suspense</option>
                    <option value="Terror">Terror</option>
                    <option value="Thriller">Thriller</option>
                    <option value="Western">Western</option>
                </select>

                <label for="classe etaria">Classificação Etária:</label>
                <select name="classet" id="classet" required>
                    <option value="Livre">Livre</option>
                    <option value="10 anos">10 anos (10+)</option>
                    <option value="12 anos">12 anos (12+)</option>
                    <option value="14 anos">14 anos (14+)</option>
                    <option value="16 anos">16 anos (16+)</option>
                    <option value="18 anos">18 anos (18+)</option>

                </select>

                <label for="departamento">Departamento</label>
                <input type="departamento" value="Filme" disabled>

                <label for="lançamento">Data de Lançamento:</label>
                <input type="date" name="lancamento" id="lancamento" required>
        </div>
        <div class="w3-container form-container">

            <label for="valor">Valor:</label>
            <input type="number" name="preco" id="preco" placeholder="000,00" min="0" step="0.01" required>

            <label for="direcao">Direção:</label>
            <input type="text" name="direcao" id="direcao" maxlength="50" required>

            <label for="estoque">Estoque:</label>
            <input type="number" name="estoque" id="estoque" min="0" required>

            <label for="video">Vídeo:</label>
            <input type="file" name="video" id="video" onchange="atualiza1()">
            <img src="resources/imagens/none.jpg" width="60" id="video">

            <label for="foto">Imagem:</label>
            <input type="file" name="foto" id="foto" onchange="atualiza2()">
            <img src="resources/imagens/none.jpg" width="60" id="foto">

            <input type="submit" value="Gravar" class="w3-button w3-green">
            </form>
        </div>
    </div>
</body>

</html>
<script>
    function atualiza1() {
        document.getElementById('video').src = "resources/imagens/" +
            (document.getElementById("video").value).substr(12)
    }

    function atualiza2() {
        document.getElementById('img').src = "resources/imagens/" +
            (document.getElementById("foto").value).substr(12)
    }
</script>