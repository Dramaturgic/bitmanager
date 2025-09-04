<?php
//Inclusão do cabecalho
include('cabecalho.php');
//Verifica a segurança do site pelo administrador
include('seguranca10.php');
//Conexão com o banco
include("auxiliar/conectabd.php");
//Operação da exclusão do usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["confirma"] == "sim") {
    $id = $_POST["userid"];
    $sql = "DELETE FROM tb_usuarios WHERE i_id_usuario = $id";
    mysqli_query($link, $sql);
?>
    <meta http-equiv="refresh" content="1;url=listausuarios.php">
<?php
    exit();
}

if (!isset($_GET["userid"])) {
?>
    <meta http-equiv="refresh" content="1;url=listausuarios.php">
<?php
    exit();
}

$id = $_GET["userid"];
$sql = "SELECT s_nm_usuario FROM tb_usuarios WHERE i_id_usuario = $id";
$result = mysqli_query($link, $sql);
while ($tbl = mysqli_fetch_array($result)) {
    $nome = $tbl[0];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Deleta Usuário</title>
    <link rel="stylesheet" href="resources/deletastyle.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1 class="title">Excluir Usuario</h1>
            <form action="deletausuario.php" method="POST">
                <div class="checkbox-container">
                    <input type="checkbox" name="confirma" value="sim" id="chkbox" onclick="mudatexto()">
                    <label for="chkbox" class="confirm-label">Marque para confirmar a exclusão do Usuario: </label>
                    <span class="confirm-text"><?= $nome ?></span>
                </div>
                <input type="hidden" value="<?= $id ?>" name="userid">
                <div class="button-container">
                    <input type="submit" value="Voltar" id="btnsub">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<script>
    function mudatexto() {
        if (document.getElementById("chkbox").checked == true) {
            document.getElementById("btnsub").value = "Excluir"
            document.getElementById("btnsub").className = "w3-button w3-red"

        } else {
            document.getElementById("btnsub").value = "Voltar"
            document.getElementById("btnsub").className = "w3-button w3-green"
        }
    }
</script>

</html>