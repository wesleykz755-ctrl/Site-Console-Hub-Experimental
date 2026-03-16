<?php
// ---------------------------------------------
// 🚀 checkout.php — grava pedidos no banco
// ---------------------------------------------
session_start();

// 🔗 Conexão com o banco
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "site";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["status" => "erro", "mensagem" => "Falha na conexão: " . $conn->connect_error]));
}

// ⚙️ Lê o corpo da requisição JSON (enviado pelo fetch no JS)
$dados = json_decode(file_get_contents("php://input"), true);

if (!$dados) {
    http_response_code(400);
    echo json_encode(["status" => "erro", "mensagem" => "Requisição inválida. Nenhum dado recebido."]);
    exit;
}

// 🧩 Validação básica
$nome      = trim($dados["nome"] ?? "");
$email     = trim($dados["email"] ?? "");
$telefone  = trim($dados["telefone"] ?? "");
$endereco  = trim($dados["endereco"] ?? "");
$pagamento = trim($dados["pagamento"] ?? "");
$itens     = $dados["itens"] ?? [];

if (!$nome || !$email || !$telefone || !$endereco || !$pagamento || empty($itens)) {
    http_response_code(400);
    echo json_encode(["status" => "erro", "mensagem" => "Campos obrigatórios ausentes."]);
    exit;
}

// 💰 Calcula total do pedido
$total = 0;
foreach ($itens as $item) {
    $preco = floatval($item["preco_unitario"] ?? 0);
    $qtd   = intval($item["quantidade"] ?? 1);
    $total += $preco * $qtd;
}

// 📝 Insere na tabela pedidos
$stmt = $conn->prepare("INSERT INTO pedidos (usuario_id, nome, email, telefone, endereco, pagamento, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
$usuario_id = $_SESSION["user_id"] ?? null; // se logado
$stmt->bind_param("isssssd", $usuario_id, $nome, $email, $telefone, $endereco, $pagamento, $total);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao registrar pedido: " . $stmt->error]);
    exit;
}

$pedido_id = $stmt->insert_id; // pega o ID do pedido criado
$stmt->close();

// 📦 Insere os itens do pedido
$stmt_item = $conn->prepare("INSERT INTO pedido_itens (pedido_id, produto_nome, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
foreach ($itens as $item) {
    $produto_nome  = $item["produto_nome"] ?? "Produto";
    $quantidade    = intval($item["quantidade"] ?? 1);
    $preco_unitario = floatval($item["preco_unitario"] ?? 0);
    $stmt_item->bind_param("isid", $pedido_id, $produto_nome, $quantidade, $preco_unitario);
    $stmt_item->execute();
}
$stmt_item->close();

// ✅ Resposta final ao frontend
echo json_encode([
    "status"   => "sucesso",
    "mensagem" => "Pedido registrado com sucesso!",
    "pedido_id" => $pedido_id
]);

$conn->close();
?>
