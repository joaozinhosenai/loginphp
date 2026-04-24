<?php
session_start();

// Se já houver sessão ou cookie "lembrar", redireciona para a home
if (isset($_SESSION['usuario_id']) || isset($_COOKIE['usuario_lembrar'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Acesso ao Sistema</h2>
    <form action="processa_login.php" method="POST">
        <input type="email" name="email" placeholder="E-mail" required><br><br>
        <input type="password" name="senha" placeholder="Senha" required><br><br>
        <label>
            <input type="checkbox" name="lembrar"> Lembrar-me
        </label><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>