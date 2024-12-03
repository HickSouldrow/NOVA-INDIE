<?php
include 'conexoes/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $codJogo = $data['CodJogo'] ?? null;

    if (isset($_SESSION['CodCliente'], $codJogo)) {
        $codCliente = $_SESSION['CodCliente'];
        $sql = "DELETE FROM Desejos WHERE CodJogo = ? AND CodCliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $codJogo, $codCliente);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao remover item.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}
?>
