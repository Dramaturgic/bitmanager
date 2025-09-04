<?php
include('auxiliar/conectabd.php');
include('cabecalho.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <style>
        .cadastra {
            border: 1px solid black;
            width: 380px;
            height: 600px;
            float: left;
            text-align: center;
            margin-right: 30px;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.2s;
            cursor: pointer;
        }

        #container {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .cadastra:hover {
            transform: translateY(-10px);
        }

        #cadastras {
            display: flex;
            cursor: default;
        }

        h1{
            cursor: default;
        }

        #game{
            margin-left: 255px;
        }

        #movie{
            margin-left: 310px;
        }

        #music{
            margin-left: 300px;
        }

        #user{
            margin-left: 290px;
        }

        .asfoto {
            width: 100%;
            /* faz com que a imagem ocupe toda a largura da div */
            height: 600px;
            /* mantém a proporção da imagem */
            object-fit: cover;
            display: none;
            /* remove espaços extras ao redor da imagem */
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;"> O que deseja cadastrar?</h1>
    <div id="cadastras">
        <p id="game">Cadastrar Jogo</p>
        <p id="movie">Cadastrar Filme</p>
        <p id="music">Cadastrar Música</p>
        <p id="user">Cadastrar Usuário</p>
    </div>
    <div id="container">
        <div class="cadastra" id="jogo">
            <a href="Cadastrajogo.php">
                <div class="carrossel">
                    <img src="resources/imagens/apexlegends.jpg" alt="Apex Legends" class="asfoto" style="display: block;">
                    <img src="resources/imagens/codwar.jpg" alt="Call of Duty Warzone" class="asfoto">
                    <img src="resources/imagens/crash.png" alt="Crash Bandicoot" class="asfoto">
                    <img src="resources/imagens/darksouls.jpg" alt="Dark Souls" class="asfoto">
                    <img src="resources/imagens/buckshot.jpg" alt="Buckshot" class="asfoto">
                </div>
            </a>
        </div>
        <div class="cadastra" id="filme">
            <a href="cadastrafilme.php">
                <div class="carrossel">
                    <img src="resources/imagens/ratatouille.jpg" alt="Ratatouille" class="asfoto">
                    <img src="resources/imagens/thor3.jpg" alt="Thor Ragnarok" class="asfoto">
                    <img src="resources/imagens/coraline.jpg" alt="Coraline" class="asfoto">
                    <img src="resources/imagens/donniedarko.jpg" alt="Donnie Darko" class="asfoto">
                    <img src="resources/imagens/Drive.jpg" alt="Drive" class="asfoto">
                </div>
            </a>
        </div>
        <div class="cadastra">
            <a href="cadastramusica.php">
                <div class="carrossel">
                    <img src="resources/imagens/ridethelightning.jpg" alt="Ride the Lightning" class="asfoto">
                    <img src="resources/imagens/killemall.jpg" alt="Kill 'Em All" class="asfoto">
                    <img src="resources/imagens/masterofpuppets.jpg" alt="Master of Puppets" class="asfoto">
                    <img src="resources/imagens/load.jpg" alt="Load" class="asfoto">
                    <img src="resources/imagens/reload.jpg" alt="Reload" class="asfoto">
                </div>
            </a>
        </div>
        <div class="cadastra">
            <a href="cadastrausuario.php">
                <div class="carrossel">
                    <img src="resources/imagens/chad1.jpg" alt="Chad 1" class="asfoto">
                    <img src="resources/imagens/chad2.jpg" alt="Chad 2" class="asfoto">
                    <img src="resources/imagens/chad3.jpg" alt="Chad 3" class="asfoto">
                    <img src="resources/imagens/chad4.jpg" alt="Chad 4" class="asfoto">
                    <img src="resources/imagens/chad5.jpg" alt="Chad 5" class="asfoto">
                </div>
            </a>
        </div>
    </div>
    <script>
        const categorias = document.querySelectorAll('.cadastra');

        categorias.forEach(categoria => {
            const carrossel = categoria.querySelector('.carrossel');
            const imagens = carrossel.querySelectorAll('.asfoto');
            let index = 0;
            let intervalId;

            function trocarImagem() {
                imagens.forEach(img => img.style.display = 'none');
                imagens[index].style.display = 'block';
                index = (index + 1) % imagens.length;
            }

            intervalId = setInterval(trocarImagem, 2000); // Troca de imagem a cada 2 segundos

            categoria.addEventListener('mouseover', () => {
                intervalId = setInterval(trocarImagem, 2000); // Retoma o intervalo quando o mouse entra
            });

            categoria.addEventListener('mouseout', () => {
                clearInterval(intervalId); // Pára o intervalo quando o mouse sai
            });
        });
    </script>
</body>
</html>