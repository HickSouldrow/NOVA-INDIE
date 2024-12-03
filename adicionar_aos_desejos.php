<?php
include 'conexoes/config.php';

header('Content-Type: application/json');

// Obtendo os dados da requisição
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['CodJogo'])) {
    $codJogo = $data['CodJogo'];

    // Obtendo CodCliente do cabeçalho (exemplo: baseado na sessão do usuário)
    session_start();
    if (!isset($_SESSION['CodCliente'])) {
        echo json_encode(['success' => false, 'message' => 'Usuário não logado.']);
        exit;
    }
    $codCliente = $_SESSION['CodCliente'];

    // Verificar se o jogo já está no carrinho para o cliente
    $sqlCheck = "SELECT COUNT(*) as total FROM Desejos WHERE CodJogo = ? AND CodCliente = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("ii", $codJogo, $codCliente);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $rowCheck = $resultCheck->fetch_assoc();

    if ($rowCheck['total'] > 0) {
        // Jogo já está no carrinho
        echo json_encode(['success' => false, 'message' => 'Este jogo já está na sua lista de desejos.']);
    } else {
        // Inserir o jogo no carrinho
        $sqlInsert = "INSERT INTO Desejos (CodJogo, CodCliente) VALUES (?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ii", $codJogo, $codCliente);

        if ($stmtInsert->execute()) {
            echo json_encode(['success' => true, 'message' => 'Jogo adicionado à lista de desejos com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao adicionar o jogo à lista de desejos.']);
        }

        $stmtInsert->close();
    }

    $stmtCheck->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
}
