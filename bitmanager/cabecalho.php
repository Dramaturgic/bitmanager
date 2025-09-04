<?php
if (session_id() === "") session_start();
$_SESSION['produtos_carrinho'] = 0;
include('auxiliar/conectabd.php');

//
if (isset($_SESSION['carrinho'])) {
    $sql2 = "SELECT COUNT(*) FROM tb_carrinhos 
    WHERE s_cod_carrinho = '{$_SESSION['carrinho']}'";
    $result2 = mysqli_query($link, $sql2);
    while ($tbl2 = mysqli_fetch_array($result2)) {
        $_SESSION['produtos_carrinho'] = $tbl2[0];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cabestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="resources/imagens/icon.png" type="image/x-icon">
    <style>
        /* Aqui está o estilo fornecido */
        body{
            background-color: #eddbc4;
        }

        #welcome-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 0px 0px 20px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #welcome-container span {
            font-weight: bold;
            margin-right: 10px;
            font-size: 18px;
        }

        #welcome-container a {
            text-decoration: none;
            color: #333;
            margin-right: 10px;
            transition: color 0.3s;
        }

        #welcome-container a:hover {
            color: #6b4fa0;
        }

        #welcome-container button {
            padding: 10px 20px;
            background-color: #6b4fa0;
            color: #fff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
            font-size: 16px;
            margin: 0 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #welcome-container button:hover {
            background-color: #1d1b19;
            color: #fff;
            transform: scale(1.05);
        }

        .sair {
            position: absolute;
            right: 190px;
        }

        .usuario {
            position: absolute;
            right: 300px;
        }

        .cart-container {
            position: relative;
        }

        .cart-container span {
            padding-left: 10 0 0;
        }

        .cart {
            position: absolute;
            top: 5px;
            right: -10px;
            background-color: #6b4fa0;
            color: white;
            border: none;
            border-radius: 50%;
            width: 47px;
            height: 47px;
            font-size: 20px;
            line-height: 40px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
        }

        .cart:hover {
            background-color: #1d1b19;
        }

        #bitmanager {
            position: relative;
            right: 650px;
        }

        .login {
            font-size: 16px;
            padding: 10px 20px;
            background-color: white;
            color: #fff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
            font-size: 16px;
            margin: 0 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Fim do estilo fornecido */

        .dropdown {
            position: relative;
            display: inline-block;
            cursor: default;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 10px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content button {
            margin-bottom: 10px;
        }

        button {
            cursor: pointer;
        }
        #dropdown-button{
            padding: 10px 10px;
        }
    </style>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
            cursor: default;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 10px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content button {
            margin-bottom: 10px;
        }

        button {
            cursor: pointer;
        }

        #img {
            position: relative;
            right: 445px;
        }
        #dropdown-button{
            padding: 10px 10px;
        }
    </style>
</head>

<body>

    <?php
    // Verifica se a sessão está definida e se o nível é 10
    if (isset($_SESSION['nivel']) && $_SESSION["nivel"] == 10) {
    ?>
        <div id="welcome-container" class="cart-container">

            <a href="index.php">
                <img src="resources/imagens/logotrans.png" alt="BITMANAGER" id="bitmanager">
            </a>

            <a href="index.php"><button>Página Inicial</button></a>
            <a href="cadastra.php"><button>Cadastra</button></a>

            <div class="dropdown">
                <span>Listas</span>
                <div class="dropdown-content">
                    <a href="listausuarios.php"><button class="dropdown-button">Lista Usuários</button></a>
                    <a href="listajogos.php" value="1"><button class="dropdown-button">Lista Jogos</button></a>
                    <a href="listafilmes.php" value="2"><button class="dropdown-button">Lista Filmes</button></a>
                    <a href="listamusicas.php" value="3"><button class="dropdown-button">Lista Músicas</button></a>
                </div>

            </div>
            <a href="logout.php" class="sair"><button><i class="fa fa-sign-out"></i></button></a>
            <span class="usuario">
                <tr><?= $_SESSION['nome'] ?></tr>
            </span>
            <a href="carrinho.php" class="btncarrinho"><i class="fa fa-shopping-cart" style="font-size:36px"></i> <?= $_SESSION['produtos_carrinho'] ?></a>
        </div>
        <br><br>
    <?php
    }

    // Verifica se a sessão está definida e se o nível é 1
    if (isset($_SESSION['nivel']) && $_SESSION["nivel"] == 1) {
    ?>
        <div id="welcome-container" class="cart-container">

            <a href="index.php">
                <img src="resources/imagens/logotrans.png" alt="BITMANAGER" id="img">
            </a>

            <a href="index.php"><button>Página Inicial</button>
            </a>
            <a href="logout.php" class="sair"><button><i class="fa fa-sign-out"></i></button></a>
            <span class="usuario">
                <tr><?= $_SESSION['nome'] ?></tr>
            </span>
            <a href="carrinho.php" class="btncarrinho"><i class="fa fa-shopping-cart" style="font-size:36px"></i> <?= $_SESSION['produtos_carrinho'] ?></a>
        </div>
        <br><br>
    <?php
    }

    // Se o nível não estiver definido na sessão
    if (!isset($_SESSION['nivel'])) {
    ?>
        <div id="welcome-container">

            <a href="index.php">
                <img src="resources/imagens/logotrans.png" alt="BITMANAGER" id="img">
            </a>

            <a href="login.php" class="login"><i class="fa fa-user" style="font-size:20px"> </i> Entrar</a>
            <a href="index.php"><button>Página Inicial</button></a>
        </div>
        <br><br>
    <?php
    }
    ?>

</body>

</html>