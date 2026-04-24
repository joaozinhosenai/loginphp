<?php
session_start();

// Se não tem sessão mas tem cookie, recupera a sessão (simplificado)
if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_lembrar'])) {
    $_SESSION['usuario_id'] = $_COOKIE['usuario_lembrar'];
    $_SESSION['usuario_nome'] = "Usuário (via Cookie)"; // Em produção, busque no DB novamente
}

// Se ainda assim não estiver logado, volta pro login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
    <p>Você está em uma área segura.</p>
    <a href="logout.php">Sair do Sistema</a>
</body>
</html>