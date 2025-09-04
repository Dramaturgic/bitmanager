<?php
//Inclusão do cabecalho
include('cabecalho.php');
//Verifica a segurança do site pelo administrador
include('seguranca10.php');
//Conexão com o banco
include("auxiliar/conectabd.php");
//Atribuição das variáveis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['prodid'];
    $nome = $_POST['produto'];
    $descricao = $_POST['descricao'];
    $genero = $_POST['genero'];
    $departamento = 3;
    $classet = $_POST['classet'];
    $lancamento = $_POST['lancamento'];
    $preco = $_POST['preco'];
    $artista = $_POST['artista'];
    $estoque = $_POST['estoque'];
    $img = $_POST['foto'];
    $img_orig = $_POST['foto_orig'];

    if ($img == "") {
        $img = $img_orig;
    }

    //String de conexão de atualização dos produtos
    $sql = "UPDATE tb_produtos SET
    s_nm_produto = '$nome',
    s_descri_produto = '$descricao',
    s_gen_produto = '$genero',
    s_depart_produto = '$departamento',
    s_claset_produto = '$classet',
    dt_dtlanc_produto = '$lancamento',
    dc_prec_produto = '$preco',
    s_art_produto = '$artista',
    i_estoq_produto = '$estoque',
    s_foto_produto = '$img'
    WHERE i_id_produto = $id";

    mysqli_query($link, $sql);
?>
    <meta http-equiv="refresh" content="1;url=listamusicas.php">
<?php
    exit();
}

//GET
if (!isset($_GET["prodid"])) {
?>
    <meta http-equiv="refresh" content="1;url=listamusicas.php">
<?php
    exit();
}
$id = $_GET["prodid"];
//String de conexão de seleção, usada para exibir as informações do produto na página
$sql = "SELECT * FROM tb_produtos WHERE i_id_produto = $id";
$result = mysqli_query($link, $sql);
while ($tbl = mysqli_fetch_array($result)) {
    $id = $tbl[0];
    $nome = $tbl[1];
    $descricao = $tbl[2];
    $genero = $tbl[3];
    $departamento = $tbl[4];
    $classet = $tbl[5];
    $lancamento = $tbl[6];
    $preco = $tbl[7];
    $artista = $tbl[8];
    $estoque = $tbl[14];
    $img = $tbl[13];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Música</title>
    <link rel="stylesheet" href="resources/cadstyle.css">
</head>

<body>
    <div id="cad">
        <div class="w3-container form-container">
            <h1>Alterar Música</h1>
            <form action="alteramusica.php" method="POST" class="w3-container">

                <input type="hidden" name="prodid" value="<?= $id ?>">
                <label for="produto">Nome:</label>
                <input type="text" name="produto" id="produto" maxlength="50" value="<?= $nome ?>" required>

                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" maxlength="100"><?= $descricao ?></textarea>

                <label for="genero">Gênero:</label>
                <input type="text" name="genero" id="genero" value="<?= $genero ?>">

                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" id="departamento" value="<?= $departamento ?>" disabled>

                <label for="classet">Classificação Etária:</label>
                <input type="text" name="classet" id="classet" value="<?= $classet ?>">

                <label for="lancamento">Lançamento:</label>
                <input type="date" name="lancamento" id="lancamento" value="<?= $lancamento ?>">
        </div>
        <div class="w3-container form-container">

            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" value="<?= $preco ?>" step="0.01" required>

            <label for="artista">Artista:</label>
            <input type="text" name="artista" id="artista" value="<?= $artista ?>" required>

            <label for="estoque">Estoque:</label>
            <input type="number" name="estoque" id="estoque" value="<?= $estoque ?>" min="0" required>

            <label for="foto">Capa:</label>
            <input type="file" name="foto" id="foto" onchange="atualiza1()">
            <img src="resources/imagens/<?= $img ?>" width="60" id="img">
            <input type="hidden" name="foto_orig" value="<?= $img ?>">

            <input type="submit" value="Gravar" class="w3-button w3-green">
            </form>
        </div>
    </div>
</body>

</html>
<script>
    function atualiza1() {
        document.getElementById('img').src = "resources/imagens/" +
            (document.getElementById("foto").value).substr(12)
    }
</script>