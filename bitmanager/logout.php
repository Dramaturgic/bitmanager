<?php
//Sessão inicia
session_start();
//Sessão é destruída e redirecionamento para a página index
session_destroy();
header("Location: index.php");
?>