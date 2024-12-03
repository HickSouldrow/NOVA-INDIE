<?php
include 'conexoes/config.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['CodCliente'])) {
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para realizar a compra.']);
    exit;
}

// Obtendo os dados enviados pela requisição
$data = json_decode(file_get_contents('php://input'), true);

$codCliente = $_SESSION['CodCliente'];
$meioPagamento = $data['meioPagamento'];
$codJogo = $data['codJogo'];  // Array com os códigos dos jogos

// Iniciar a transação para garantir a integridade dos dados
$conn->begin_transaction();

try {
    // Registrar a nota fiscal
    $sqlNotaFiscal = "INSERT INTO notafiscal (CodCliente, MeioPagamento, DataCompra) VALUES (?, ?, NOW())";
    $stmtNotaFiscal = $conn->prepare($sqlNotaFiscal);
    $stmtNotaFiscal->bind_param("ii", $codCliente, $meioPagamento);
    $stmtNotaFiscal->execute();
    $codNotaFiscal = $conn->insert_id; // Pega o CodNotaFiscal recém-criado

    // Registrar a venda dos jogos na nota fiscal
    $sqlNotaFiscalJogo = "INSERT INTO notafiscaljogo (CodNotaFiscal, CodJogo, QtdVend) VALUES (?, ?, 1)";
    $stmtNotaFiscalJogo = $conn->prepare($sqlNotaFiscalJogo);

    // Para cada jogo no carrinho, insere na tabela notafiscaljogo
    foreach ($codJogos as $codJogo) {
        $stmtNotaFiscalJogo->bind_param("ii", $codNotaFiscal, $codJogo);
        $stmtNotaFiscalJogo->execute();
    }

    // Limpar o carrinho após a compra
    $sqlLimparCarrinho = "DELETE FROM Carrinho WHERE CodCliente = ?";
    $stmtLimparCarrinho = $conn->prepare($sqlLimparCarrinho);
    $stmtLimparCarrinho->bind_param("i", $codCliente);
    $stmtLimparCarrinho->execute();

    // Commit da transação
    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Compra realizada com sucesso!']);
} catch (Exception $e) {
    // Rollback em caso de erro
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Ocorreu um erro ao processar sua compra.']);
}
?>
