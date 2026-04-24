<?php
session_start();

// Configurações do Banco
$db = new mysqli('localhost', 'usuario', 'senha', 'sistema_login');

// Função simples para registrar log em arquivo
function registrarLog($mensagem) {
    $arquivo = 'acessos.log';
    $data = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
    $texto = "[$data] [IP: $ip] $mensagem" . PHP_EOL;
    file_put_contents($arquivo, $texto, FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $db->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = '$email'";
    $res = $db->query($sql);

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();

        if (password_verify($senha, $user['senha'])) {
            // Sucesso! Criar Sessão
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];

            // Se "Lembrar-me" estiver marcado, cria cookie de 30 dias
            if (isset($_POST['lembrar'])) {
                setcookie('usuario_lembrar', $user['id'], time() + (86400 * 30), "/");
            }

            registrarLog("SUCESSO: Usuário $email logou.");
            header("Location: dashboard.php");
        } else {
            registrarLog("ERRO: Senha incorreta para $email.");
            echo "E-mail ou senha inválidos!";
        }
    } else {
        registrarLog("ERRO: Usuário não encontrado ($email).");
        echo "E-mail ou senha inválidos!";
    }
}