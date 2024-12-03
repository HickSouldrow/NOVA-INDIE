<?php
include 'conexoes/config.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['CodCliente'])) {
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para realizar a compra.']);
    exit;
}

// Obtém o método de pagamento enviado pela requisição
$data = json_decode(file_get_contents('php://input'), true);
$meioPagamento = $data['meioPagamento'];
$codCliente = $_SESSION['CodCliente'];

// Buscar todos os jogos do carrinho do cliente
$sqlBuscarCarrinho = "SELECT CodJogo FROM Carrinho WHERE CodCliente = ?";
$stmtBuscarCarrinho = $conn->prepare($sqlBuscarCarrinho);
$stmtBuscarCarrinho->bind_param("i", $codCliente);
$stmtBuscarCarrinho->execute();
$resultCarrinho = $stmtBuscarCarrinho->get_result();

$jogos = [];
while ($row = $resultCarrinho->fetch_assoc()) {
    $jogos[] = $row['CodJogo'];
}

// Verifica se há jogos no carrinho
if (empty($jogos)) {
    echo json_encode(['success' => false, 'message' => 'Nenhum jogo no carrinho.']);
    exit;
}

// Iniciar a transação para garantir a integridade dos dados
$conn->begin_transaction();

try {
    // Criar uma nova nota fiscal
    $sqlNotaFiscal = "INSERT INTO notafiscal (CodCliente, MeioPagamento, DataCompra) VALUES (?, ?, NOW())";
    $stmtNotaFiscal = $conn->prepare($sqlNotaFiscal);
    $stmtNotaFiscal->bind_param("ii", $codCliente, $meioPagamento);
    $stmtNotaFiscal->execute();
    $codNotaFiscal = $conn->insert_id; // Pega o ID da nota fiscal recém-criada

    // Adicionar cada jogo do carrinho na nota fiscal
    $sqlNotaFiscalJogo = "INSERT INTO notafiscaljogo (CodNotaFiscal, CodJogo, QtdVend) VALUES (?, ?, 1)";
    $stmtNotaFiscalJogo = $conn->prepare($sqlNotaFiscalJogo);

    foreach ($jogos as $codJogo) {
        $stmtNotaFiscalJogo->bind_param("ii", $codNotaFiscal, $codJogo);
        $stmtNotaFiscalJogo->execute();
    }

    // Limpar o carrinho do cliente
    $sqlLimparCarrinho = "DELETE FROM Carrinho WHERE CodCliente = ?";
    $stmtLimparCarrinho = $conn->prepare($sqlLimparCarrinho);
    $stmtLimparCarrinho->bind_param("i", $codCliente);
    $stmtLimparCarrinho->execute();

    // Confirmar a transação
    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Compra realizada com sucesso!']);
} catch (Exception $e) {
    // Reverter a transação em caso de erro
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Erro ao processar a compra.']);
}
?>
