<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_de_jogos');

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tabela = isset($_GET['tabela']) ? $_GET['tabela'] : null;

// Verifica se a tabela foi recebida corretamente
if ($tabela) {
    echo "Tabela recebida: " . htmlspecialchars($tabela); // Exibe a tabela recebida para fins de debugging

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os campos da tabela
        $result = $conn->query("SHOW COLUMNS FROM $tabela");

        if ($result) {
            $columns = $result->fetch_all(MYSQLI_ASSOC);

            // Prepara os campos e valores para o INSERT
            $fields = [];
            $values = [];

            foreach ($columns as $column) {
                $fieldName = $column['Field'];
                $isAutoIncrement = strpos($column['Extra'], 'auto_increment') !== false;

                // Ignora campos auto_increment e verifica se o campo está presente no formulário
                if (!$isAutoIncrement && isset($_POST[$fieldName])) {
                    $fields[] = $fieldName;
                    $values[] = "'" . $conn->real_escape_string($_POST[$fieldName]) . "'";
                }
            }

            if (!empty($fields) && !empty($values)) {
                // Monta a query INSERT
                $sql = "INSERT INTO $tabela (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $values) . ")";

                // Executa o INSERT
                if ($conn->query($sql)) {
                    // Redireciona com uma mensagem de sucesso
                    header("Location: CRUD_template.php?tabela=$tabela&msg=created");
                    exit;
                } else {
                    echo "Erro ao inserir registro: " . $conn->error;
                }
            } else {
                echo "Nenhum campo válido para inserir.";
            }
        } else {
            echo "Erro ao obter os campos da tabela: " . $conn->error;
        }
    }
} else {
    echo "Tabela não especificada.";
}

// Fecha a conexão com o banco
$conn->close();
?>
