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
    $departamento = 3;
    $classet = $_POST['classet'];
    $lancamento = $_POST['lancamento'];
    $preco = $_POST['preco'];
    $artista = $_POST['artista'];
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
    s_claset_produto, dt_dtlanc_produto, dc_prec_produto, s_art_produto,
    i_estoq_produto, s_vid_produto, s_foto_produto) VALUES ('$produto', '$descricao',
    '$genero','$departamento', '$classet', '$lancamento', '$preco', '$artista', '$estoque', '$video', '$foto')";

    mysqli_query($link, $sql);
    ?>
    <meta http-equiv="refresh" content="1;url=listamusicas.php">
    <?php
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Música</title>
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
            <h1>Cadastro de Música</h1>
            <form action="cadastramusica.php" method="POST" class="w3-container">
                <label for="Nome">Nome:</label>
                <input type="text" name="produto" id="produto" maxlength="50" required>

                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" maxlength="100" required></textarea>

                <label for="genero">Gênero Musical:</label>
                <select name="genero" id="genero">
                    <option value="Rock">Rock</option>
                    <option value="Pop">Pop</option>
                    <option value="Hip Hop/Rap">Hip Hop/Rap</option>
                    <option value="Eletrônica">Eletrônica</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Blues">Blues</option>
                    <option value="Country">Country</option>
                    <option value="Reggae">Reggae</option>
                    <option value="R&B (Rhythm and Blues)">R&B (Rhythm and Blues)</option>
                    <option value="Metal">Metal</option>
                    <option value="Clássica">Clássica</option>
                    <option value="Folk">Folk</option>
                    <option value="Indie">Indie</option>
                    <option value="Funk">Funk</option>
                    <option value="Soul">Soul</option>
                    <option value="Punk">Punk</option>
                    <option value="EDM (Electronic Dance Music)">EDM (Electronic Dance Music)</option>
                    <option value="Alternativa">Alternativa</option>
                    <option value="Gospel">Gospel</option>
                    <option value="Sertanejo">Sertanejo</option>
                    <option value="Bossa Nova">Bossa Nova</option>
                    <option value="Instrumental">Instrumental</option>
                    <option value="Dancehall">Dancehall</option>
                    <option value="World Music">World Music</option>
                    <option value="Ambient">Ambient</option>
                    <option value="Reggaeton">Reggaeton</option>
                    <option value="Grunge">Grunge</option>
                    <option value="Trap">Trap</option>
                    <option value="K-Pop">K-Pop</option>
                    <option value="J-Pop">J-Pop</option>
                    <option value="MPB (Música Popular Brasileira)">MPB (Música Popular Brasileira)</option>
                    <option value="Samba">Samba</option>
                    <option value="Forró">Forró</option>
                    <option value="Pagode">Pagode</option>
                    <option value="Rock Alternativo">Rock Alternativo</option>
                    <option value="Heavy Metal">Heavy Metal</option>
                    <option value="Hard Rock">Hard Rock</option>
                    <option value="Jazz Fusion">Jazz Fusion</option>
                    <option value="Blues Rock">Blues Rock</option>
                    <option value="Rap Rock">Rap Rock</option>
                    <option value="Country Pop">Country Pop</option>
                    <option value="Acoustic">Acoustic</option>
                    <option value="House">House</option>
                    <option value="Techno">Techno</option>
                    <option value="Dubstep">Dubstep</option>
                    <option value="Disco">Disco</option>
                    <option value="Ska">Ska</option>
                    <option value="New Age">New Age</option>
                    <option value="Psychedelic">Psychedelic</option>
                    <option value="Ambiental">Ambiental</option>
                </select>

                <label for="classe etaria">classe etaria:</label>
                <select name="classet" id="classet">
                    <option value="Livre">Livre</option>
                    <option value="10 anos">10 anos (10+)</option>
                    <option value="12 anos">12 anos (12+)</option>
                    <option value="14 anos">14 anos (14+)</option>
                    <option value="16 anos">16 anos (16+)</option>
                    <option value="18 anos">18 anos (18+)</option>

                </select>
                <label for="departamento">Departamento</label>
                <input type="departamento" value="Música" disabled>
                
                
                <label for="lançamento">Data de Lançamento:</label>
                <input type="date" name="lancamento" id="lancamento" required>
        </div>
        <div class="w3-container form-container">


            <label for="valor">Valor:</label>
            <input type="number" name="preco" id="preco" placeholder="000,00" min="0" step="0.01" required>

            <label for="artista">Artista:</label>
            <input type="text" name="artista" id="artista" required>

            <label for="estoque">Estoque:</label>
            <input type="number" name="estoque" id="estoque" min="1" required>

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