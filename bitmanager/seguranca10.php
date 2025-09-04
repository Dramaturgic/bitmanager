<?php
//Verifica se o nível está registrado e como administrador
if(!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 10)
{
    header("Location: login.php?msg=Acesso Negado!");
    exit();
}
?>