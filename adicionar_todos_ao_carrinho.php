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

// Verificando se o usuário está logado
session_start();
if (!isset($_SESSION['CodCliente'])) {
    enviarResposta(false, 'Você precisa estar logado para adicionar os jogos ao carrinho.');
}

$codCliente = $_SESSION['CodCliente'];

// Verificando se a requisição é para adicionar todos os jogos da lista de desejos
if (isset($data['adicionar_todos']) && $data['adicionar_todos'] === true) {

    // Buscar todos os jogos da lista de desejos
    $sql = "SELECT CodJogo FROM Desejos WHERE CodCliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $codCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    // Iniciar transação para garantir integridade dos dados
    $conn->begin_transaction();

    try {
        // Adicionar cada jogo ao carrinho
        while ($row = $result->fetch_assoc()) {
            $codJogo = $row['CodJogo'];

            // Verificar se o jogo já está no carrinho
            $sqlCheck = "SELECT COUNT(*) as total FROM Carrinho WHERE CodJogo = ? AND CodCliente = ?";
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param("ii", $codJogo, $codCliente);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();
            $rowCheck = $resultCheck->fetch_assoc();

            if ($rowCheck['total'] == 0) {
                // Inserir o jogo no carrinho
                $sqlInsert = "INSERT INTO Carrinho (CodJogo, CodCliente) VALUES (?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("ii", $codJogo, $codCliente);
                $stmtInsert->execute();
            }
        }

        // Commit da transação
        $conn->commit();

        // Responder com sucesso
        enviarResposta(true, 'Todos os jogos foram adicionados ao carrinho.');

    } catch (Exception $e) {
        // Rollback em caso de erro
        $conn->rollback();
        error_log('Erro ao adicionar todos os jogos ao carrinho: ' . $e->getMessage());
        enviarResposta(false, 'Ocorreu um erro ao adicionar os jogos ao carrinho.');
    }
}
?>
