<?php
//Verifica se o nível está registrado como usuário
if(!isset($_SESSION['nivel']))
{
    header("Location: login.php?msg=Acesso Negado!");
    exit();
}
?>