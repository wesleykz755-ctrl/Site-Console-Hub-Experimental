<?php
session_start();

// -----------------------------------------------------
// ⚙️ Configuração do banco de dados
// -----------------------------------------------------
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "site";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// -----------------------------------------------------
// 🧾 Captura e valida campos do formulário
// -----------------------------------------------------
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header("Location: login.html?erro=Por favor preencha todos os campos.");
    exit();
}

$email = $conn->real_escape_string($email);

// -----------------------------------------------------
// 🔍 Busca o usuário no banco
// -----------------------------------------------------
$sql = "SELECT * FROM usuarios WHERE email='$email' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // ✅ Verifica a senha
    if (password_verify($senha, $user['senha'])) {
        // 🧠 Define as variáveis de sessão com nomes consistentes
        $_SESSION['usuario'] = $user['nome'];  // <-- Agora bate com o site_principal.php
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        // 🔁 Redireciona para o site principal em PHP
        header("Location: site_principal.php");
        exit();
    } else {
        header("Location: login.html?erro=Senha incorreta!");
        exit();
    }
} else {
    header("Location: login.html?erro=Usuário não encontrado!");
    exit();
}

$conn->close();
?>
