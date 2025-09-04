<?php
//Conexão com o banco
include("auxiliar/conectabd.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["login"])) {
        /* PHP do Login */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST['email'];
            $password = $_POST['password'];

            include("auxiliar/conectabd.php");

            // Obtém o "tempero" associado ao email do usuário da tabela tb_usuario
            $sql = "SELECT s_temp_usuario FROM tb_usuarios WHERE s_eml_usuario = '$email'";
            $result = mysqli_query($link, $sql);
            while ($tbl = mysqli_fetch_array($result)) {
                $tempero = $tbl[0];
            }

            // Calcula o hash da senha fornecida pelo usuário concatenando-a com o "tempero"
            $password = md5($password . $tempero);

            // Consulta SQL para verificar se existe um usuário com o email e senha fornecidos
            $sql = "SELECT COUNT(*) FROM tb_usuarios
                WHERE s_eml_usuario = '$email' AND
                s_pw_usuario = '$password'";
            $result = mysqli_query($link, $sql);
            while ($tbl = mysqli_fetch_array($result)) {
                $count = $tbl[0];
            }

            // Se não houver correspondência para o email e senha fornecidos, redireciona para a página de login com mensagem de erro
            if ($count == 0) {
                header("Location:login.php?msg=Dados incorretos");
                exit();
            }

            // Se houver correspondência para o email e senha fornecidos, recupera informações do usuário e armazena em variáveis de sessão
            $sql = "SELECT i_id_usuario, s_nm_usuario, i_nvl_usuario
                FROM tb_usuarios WHERE s_eml_usuario = '$email' AND
                s_pw_usuario = '$password'";
            $result = mysqli_query($link, $sql);
            while ($tbl = mysqli_fetch_array($result)) {
                session_start();
                $_SESSION['id'] = $tbl[0];
                $_SESSION['nome'] = $tbl[1];
                $_SESSION['nivel'] = $tbl[2];
            }

            // Redireciona o usuário para a página inicial após o login bem-sucedido
            header("Location:index.php");
            exit();
        }
    } elseif (isset($_POST["cadastro"])) {

        /* PHP do Cadastro */
        $nome = $_POST['name'];
        $unm = $_POST['username'];
        $password = $_POST['password'];
        $tel = $_POST['telefone'];
        $date = $_POST['dt'];
        $email = $_POST['email'];
        $end = $_POST['end'];
        $cpf = $_POST['cpf'];
        $nivel = 1;

        include("auxiliar/conectabd.php");

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

        $tempero = rand(0, 999999999) . Date('now') . ":Eº°££¢²³FÇEE¨Eç¨çxcs454,l";
        $tempero = md5($tempero);

        $password = md5($password . $tempero);

        $sql = "INSERT INTO tb_usuarios (s_nm_usuario, s_unm_usuario, s_pw_usuario, s_tel_usuario, dt_nasc_usuario, 
    s_eml_usuario, s_end_usuario, s_cpf_usuario, s_temp_usuario, i_nvl_usuario) VALUES ('$nome', '$unm', '$password',
    '$tel', '$date', '$email', '$end', '$cpf', '$tempero', '$nivel')";

        mysqli_query($link, $sql);

        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/logstyle.css">
    <title>Login</title>
    <link rel="shortcut icon" href="resources/imagens/icon.png" type="image/x-icon">
    <style>
        .msg {
            color: red;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="card-switch">
            <label class="switch">
                <input class="toggle" type="checkbox">
                <span class="slider"></span>
                <span class="card-side"></span>
                <div class="flip-card__inner">

                    <!-- Login -->

                    <div class="flip-card__front">
                        <div class="title">Login</div>
                        <form action="login.php" class="flip-card__form" method="POST">
                            <input type="hidden" name="login" value="0">
                            <input type="email" placeholder="Email" id="email" name="email" class="flip-card__input">
                            <input type="password" placeholder="Password" id="password" name="password" class="flip-card__input">
                            <button class="flip-card__btn">Enviar</button>
                            <?php
                            // verifica se há um parâmetro chamado 'msg' passado via URL usando o método GET
                            if (isset($_GET['msg'])) {
                                $mensagem = $_GET['msg'];
                                echo ("<p class='msg'>$mensagem</p>");
                                if ($mensagem == "Dados incorretos") {
                                }
                            }
                            ?>
                        </form>
                    </div>

                    <!-- Cadastro -->

                    <div class="flip-card__back">
                        <div class="title">Cadastro</div>
                        <form action="login.php" class="flip-card__form" method="POST">
                            <input type="hidden" name="cadastro" value="0">
                            <input type="text" placeholder="Nome" name="name" id="name" class="flip-card__input" maxlength="50" required>
                            <input type="username" placeholder="Username" name="username" id="username" class="flip-card__input" maxlength="50" required>
                            <input type="password" placeholder="Password" id="password" name="password" class="flip-card__input" maxlength="50" required>
                            <input type="telefone" placeholder="Telefone" id="tel" name="telefone" class="flip-card__input" required>
                            <input type="date" placeholder="Data" id="dt" min="1900-01-01" max="2024-04-30" name="dt" class="flip-card__input" required>
                            <input type="email" placeholder="Email" id="eml" name="email" class="flip-card__input" maxlength="50" required>
                            <input type="endereço" placeholder="Endereço" id="end" name="end" class="flip-card__input" required>
                            <input type="cpf" placeholder="CPF" id="cpf" name="cpf" class="flip-card__input" required>
                            <button class="flip-card__btn">Confirmar</button>
                        </form>

                        <!-- Javascript para mascaras -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
                        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

                        <script>
                            $('#tel').mask('(00)00000-0000');
                            $('#cpf').mask('000.000.000/00', {
                                reverse: true
                            });
                        </script>
                    </div>

                </div>
            </label>
        </div>
    </div>
</body>

</html>