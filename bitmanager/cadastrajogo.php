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
    $departamento = 1;
    $classet = $_POST['classet'];
    $lancamento = $_POST['lancamento'];
    $preco = $_POST['preco'];
    $desenvolvedor = $_POST['desenvolvedor'];
    $ativacao = $_POST['ativacao'];
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
    s_claset_produto, dt_dtlanc_produto, dc_prec_produto, s_dev_produto,
    s_ativ_produto, i_estoq_produto, s_vid_produto, s_foto_produto) VALUES ('$produto', '$descricao', '$genero',
    '$departamento', '$classet', '$lancamento', '$preco', '$desenvolvedor', '$ativacao', '$estoque', '$video', '$foto')";

    mysqli_query($link, $sql);
?>
    <meta http-equiv="refresh" content="1;url=listajogos.php">
<?php
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Jogo</title>
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
            <h1>Cadastro de Jogo</h1>
            <form action="cadastrajogo.php" method="POST" class="w3-container">
                <label for="produto">Nome:</label>
                <input type="text" name="produto" id="produto" maxlength="50" required>

                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" maxlength="100" required></textarea>

                <label for="genero">Gênero:</label>
                <select name="genero" id="genero" required>
                    <option value="Action">Ação</option>
                    <option value="Adventure">Aventura</option>
                    <option value="Action RPG">RPG de Ação</option>
                    <option value="RPG">RPG (Role-Playing Game)</option>
                    <option value="Strategy">Estratégia</option>
                    <option value="Simulation">Simulação</option>
                    <option value="Sports">Esportes</option>
                    <option value="Puzzle">Quebra-Cabeça</option>
                    <option value="Horror">Horror</option>
                    <option value="Open World">Mundo Aberto (Open World)</option>
                    <option value="Battle Royale">Battle Royale</option>
                    <option value="Platformer">Plataforma</option>
                    <option value="indie">Indie</option>
                    <option value="Music/Rhythm">Música/Ritmo</option>
                    <option value="Narrative">Narrativo</option>
                    <option value="Sandbox">Sandbox</option>
                    <option value="Shotter">Shotter</option>
                    <option value="Outros">Outros</option>
                </select>

                <label for="classet">Classificação Etária:</label>
                <select name="classet" id="classet" required>
                    <option value="Pré-escolar, 3+">EC (Early Childhood) - Pré-escolar, 3+</option>
                    <option value="Todas as idades">E (Everyone) - Todas as idades</option>
                    <option value="10+, 10 anos ou mais">E10+ (Everyone 10 and older) - 10+, 10 anos ou mais</option>
                    <option value="Adolescentes, 13+">T (Teen) - Adolescentes, 13+</option>
                    <option value="Adultos, 17+">M (Mature) - Adultos, 17+</option>
                    <option value="Apenas para adultos, 18+">AO (Adults Only) - Apenas para adultos, 18+</option>
                    <option value="Classificação pendente">RP (Rating Pending) - Classificação pendente</option>
                </select>

                <label for="departamento">Departamento</label>
                <input type="departamento" value="Jogo" disabled>

                <label for="lançamento">Data de Lançamento:</label>
                <input type="date" name="lancamento" id="lancamento" required>
        </div>
        <div class="w3-container form-container">
            <label for="valor">Valor:</label>
            <input type="number" name="preco" id="preco" placeholder="000,00" min="0" step="0.01" required>

            <label for="desenvolvedor">Desenvolvedor:</label>
            <input type="text" name="desenvolvedor" id="desenvolvedor" maxlength="50" required>

            <label for="ativação">Chave de Ativação:</label>
            <input type="text" name="ativacao" id="ativacao" maxlength="30" required>

            <label for="estoque">Estoque:</label>
            <input type="number" name="estoque" id="estoque" min="0" required>

            <label for="video">Vídeo:</label>
            <input type="file" name="video" id="video" onchange="atualiza1()">
            <img src="resources/imagens/none.jpg" width="60" id="video">

            <!-- OBSERVAÇÃO, CRIAÇÃO DE UMA PASTA SOMENTE PARA VÍDEOS -->

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