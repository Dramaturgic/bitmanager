<?php
//Inclusão do cabecalho
include("cabecalho.php");
//Verifica a segurança do site pelo administrador
include('seguranca10.php');
//Atribuição das variáveis e depois conexão com o banco
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email =  $_POST['email'];
    $telefone =  $_POST['telefone'];
    $nascimento = $_POST['nascimento'];
    $endereco = $_POST['endereco'];
    $cpf =  $_POST['cpf'];
    $senha =  $_POST['senha'];
    $nivel =  $_POST['nivel'];
    include("auxiliar/conectabd.php");

    //String de conexão onde determinamos o email do usuário
    $sql = "SELECT COUNT(*) FROM tb_usuarios
         WHERE s_eml_usuario = '$email'";

    $result = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($result)) {
        $count = $tbl[0];
    }
    //Caso for colocado um email existente, ele irá avisar e ser redirecionado para o login
    if ($count != 0) {
        header("Location: login.php?msg=Usuário já cadastrado");
        exit();
    }

    //Criptografia da senha com o algoritmo de has "md5"
    $tempero = rand(0, 999999999) . Date('now') . ":Eº°££¢²³FÇEE¨Eç¨çxcs454,l";
    $tempero = md5($tempero);

    //Atribuição da criptografia na senha
    $senha = md5($senha . $tempero);

    //String de conexão de inserção do usuário
    $sql = "INSERT INTO tb_usuarios (s_nm_usuario, s_unm_usuario, s_eml_usuario,
    s_tel_usuario, dt_nasc_usuario, s_end_usuario, s_cpf_usuario, s_pw_usuario,
    i_nvl_usuario, s_temp_usuario) VALUES ('$nome', '$username', '$email',
    '$telefone', '$nascimento', '$endereco', '$cpf', '$senha', '$nivel', '$tempero')";

    mysqli_query($link, $sql);
?>
    <meta http-equiv="refresh" content="1;url=listausuarios.php">
<?php
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra Usuário</title>
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
            <h1>Cadastro de Usuário</h1>
            <form action="cadastrausuario.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="50" required>

                <label for="username">UserName:</label>
                <input type="text" name="username" id="username" maxlength="50" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" maxlength="40" required>

                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" maxlength="14" placeholder="(00)00000-0000" required>

                <label for="nascimento">Data de Nascimento:</label>
                <input type="date" min="1900-01-01" max="2024-04-30" name="nascimento" id="nascimento" required>

        </div>
        <div class="w3-container form-container">

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" maxlength="50" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" maxlength="14" placeholder="000.000.000/00" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" maxlength="50" required>

            <label for="nivel">Nivel:</label>
            <select name="nivel">
                <option value="1">Usuário</option>
                <option value="10">Administrador</option>
            </select>

            <input type="submit" value="Gravar">

            <!-- Javascript para mascaras -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

            <script>
                $('#telefone').mask('(00)00000-0000');
                $('#cpf').mask('000.000.000-00', {
                    reverse: true
                });
            </script>
            </form>
        </div>
    </div>
</body>

</html>