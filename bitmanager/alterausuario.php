<?php
//Inclusão do cabecalho
include('cabecalho.php');
//Verifica a segurança do site pelo administrador
include('seguranca10.php');
//Conexão com o banco
include("auxiliar/conectabd.php");
//Atribuição das variáveis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["userid"];
    $nome = $_POST["nome"];
    $username = $_POST["username"];
    $senha = $_POST["senha"];
    $senha_antiga = $_POST['senha_antiga'];
    $telefone = $_POST["telefone"];
    $nascimento = $_POST["nascimento"];
    $email = $_POST["email"];
    $email_original = $_POST['email_original'];
    $endereco = $_POST["endereco"];
    $cpf = $_POST["cpf"];
    $tempero = $_POST['tempero'];
    $nivel = $_POST["nivel"];

    if ($email != $email_original) {
        $sql = "SELECT COUNT(*) FROM tb_usuarios 
            WHERE s_eml_usuario = '$email'";
        $result = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($result)) {
            $count = $tbl[0];
        }
        if ($count != 0) {
            header("Location: login.php?msg=Usuário já cadastrado");
            exit();
        }
    }

    if ($senha != $senha_antiga) {
        $senha = md5($senha . $tempero);
    }

    //String de conexão de atualização do usuário
    $sql = "UPDATE tb_usuarios SET s_nm_usuario = '$nome',
    s_unm_usuario = '$username',
    s_pw_usuario = '$senha',
    s_tel_usuario = '$telefone',
    dt_nasc_usuario = '$nascimento',
    s_eml_usuario = '$email',
    s_end_usuario = '$endereco',
    s_cpf_usuario = '$cpf',
    i_nvl_usuario = '$nivel'
    WHERE i_id_usuario = $id";
    mysqli_query($link, $sql);
?>
    <meta http-equiv="refresh" content="1;url=listausuarios.php">
<?php
    exit();
}

//GET
if (!isset($_GET["userid"])) {
?>
    <meta http-equiv="refresh" content="1;url=listausuarios.php">
<?php
}
$id = $_GET["userid"];
//String de conexão de seleção, usada para exibir as informações do usuário na página
$sql = "SELECT * FROM tb_usuarios WHERE i_id_usuario = $id";
$result = mysqli_query($link, $sql);
while ($tbl = mysqli_fetch_array($result)) {
    $id = $tbl[0];
    $nome = $tbl[1];
    $username = $tbl[2];
    $senha = $tbl[3];
    $telefone = $tbl[4];
    $nascimento = $tbl[5];
    $email = $tbl[6];
    $endereco = $tbl[7];
    $cpf = $tbl[8];
    $tempero = $tbl[9];
    $nivel = $tbl[10];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Uusário</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #f4f4f4;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        img {
            position: relative;
            top: -71px;
            right: -407px;
        }
    </style>
</head>

<body>

    <div class="w3-container form-container">
        <h1>Alterar Usuário</h1>
        <form action="alterausuario.php" method="POST">

            <input type="hidden" name="userid" value="<?= $id ?>">
            <input type="hidden" name="tempero" value="<?= $tempero ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" maxlength="50" value="<?= $nome ?>" required>

            <label for="username">UserName:</label>
            <input type="text" name="username" id="username" maxlength="50" value="<?= $username ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" maxlength="40" value="<?= $email ?>" required>
            <input type="hidden" name="email_original" value="<?= $email ?>">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" maxlength="14" value="<?= $telefone ?>" required>

            <label for="nascimento">Data de nascimento:</label>
            <input type="date" name="nascimento" id="nascimento" value="<?= $nascimento ?>" required>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" maxlength="50" value="<?= $endereco ?>" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" maxlength="14" value="<?= $cpf ?>" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" maxlength="50" value="<?= $senha ?>" required>
            <input type="hidden" name="senha_antiga" value="<?= $senha ?>">

            <label for="nivel">Nivel:</label>
            <select name="nivel">
                <option value="1">Usuário</option>
                <option value="10" <?= $nivel == "10" ? "selected" : "" ?>>Administrador</option>
            </select>

            <input type="submit" value="Gravar">
        </form>
    </div>

</body>

</html>