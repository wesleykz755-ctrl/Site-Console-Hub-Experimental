<?php
// Exibir erros para depuração (remover depois em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CONFIGURAÇÃO DE CONEXÃO
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "site"; // banco correto

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// CAPTURA DADOS DO FORMULÁRIO
$nome      = $_POST['nome'] ?? '';
$endereco  = $_POST['endereco'] ?? '';
$email     = $_POST['email'] ?? '';
$senha     = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar-senha'] ?? '';

// VALIDAÇÃO SIMPLES
if (empty($nome) || empty($endereco) || empty($email) || empty($senha) || empty($confirmar)) {
    die("Por favor, preencha todos os campos.");
}

if ($senha !== $confirmar) {
    die("As senhas não conferem.");
}

// ESCAPAR DADOS PARA EVITAR SQL INJECTION
$nome     = $conn->real_escape_string($nome);
$endereco = $conn->real_escape_string($endereco);
$email    = $conn->real_escape_string($email);
$senha    = password_hash($senha, PASSWORD_DEFAULT); // criptografar senha

// INSERIR DADOS NO BANCO
$sql = "INSERT INTO usuarios (nome, endereco, email, senha) VALUES ('$nome', '$endereco', '$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    // Após inserir no banco com sucesso
header("Location: login.html?sucesso=Cadastro realizado com sucesso! Faça login.");
exit();
;
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>
