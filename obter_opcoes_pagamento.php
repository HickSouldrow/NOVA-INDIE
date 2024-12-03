<?php
include 'conexoes/config.php';

// Consultar as opções de pagamento
$sql = "SELECT * FROM meiopagamento";
$result = $conn->query($sql);

$opcoesPagamento = [];

while ($row = $result->fetch_assoc()) {
    $opcoesPagamento[] = $row;
}

echo json_encode(['opcoes' => $opcoesPagamento]);
?>
