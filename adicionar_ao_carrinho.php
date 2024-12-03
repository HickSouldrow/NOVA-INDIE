<?php
include 'conexoes/config.php';

header('Content-Type: application/json');

// Função para enviar uma resposta padronizada
function enviarResposta($success, $message, $extra = []) {
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $extra));
    exit;
}

// Obtendo os dados da requisição
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['CodJogo'])) {
    $codJogo = $data['CodJogo'];

    // Verificando sessão do cliente
    session_start();
    if (!isset($_SESSION['CodCliente'])) {
        enviarResposta(false, 'Você precisa estar logado para adicionar ao carrinho.');
    }
    $codCliente = $_SESSION['CodCliente'];

    // Verificar se o jogo já está no carrinho
    $sqlCheck = "SELECT COUNT(*) as total FROM Carrinho WHERE CodJogo = ? AND CodCliente = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("ii", $codJogo, $codCliente);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $rowCheck = $resultCheck->fetch_assoc();

    if ($rowCheck['total'] > 0) {
        // Jogo já está no carrinho
        enviarResposta(false, 'Este jogo já está no seu carrinho.');
    } else {
        // Inserir o jogo no carrinho
        $sqlInsert = "INSERT INTO Carrinho (CodJogo, CodCliente) VALUES (?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ii", $codJogo, $codCliente);

        if ($stmtInsert->execute()) {
            enviarResposta(true, 'Jogo adicionado ao carrinho com sucesso.');
        } else {
            // Logue o erro no servidor para depuração (não exibir diretamente ao usuário)
            error_log('Erro ao inserir no carrinho: ' . $stmtInsert->error);
            enviarResposta(false, 'Houve um problema ao adicionar o jogo ao carrinho.');
        }

        $stmtInsert->close();
    }

    $stmtCheck->close();
    $conn->close();
} else {
    enviarResposta(false, 'Dados inválidos enviados.');
}
