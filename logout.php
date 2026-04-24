<?php
session_start();
session_destroy();
// Deleta o cookie definindo tempo negativo
setcookie('usuario_lembrar', '', time() - 3600, "/");
header("Location: index.php");