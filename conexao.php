<?php
// Configurações de conexão
$servidor = "localhost";
$usuario = "root";
$senha =    "";
$banco = "site";

// Criar conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar se houve erro
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Caso chegue aqui, conexão deu certo!
?>
