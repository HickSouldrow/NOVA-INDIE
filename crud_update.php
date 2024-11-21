<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_de_jogos');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tabela = isset($_POST['tabela']) ? $_POST['tabela'] : null;

    if ($tabela) {
        // Obtém os campos da tabela para identificar a chave primária
        $result = $conn->query("SHOW COLUMNS FROM $tabela");

        if ($result) {
            $columns = $result->fetch_all(MYSQLI_ASSOC);
            $pk_field = $columns[0]['Field']; // O primeiro campo será considerado a PK

            // Prepara os valores para o UPDATE
            $sets = [];
            foreach ($_POST as $field => $value) {
                if ($field !== 'tabela' && $field !== $pk_field) { // Ignora o campo da tabela e a PK
                    $sets[] = "$field = '" . $conn->real_escape_string($value) . "'";
                }
            }

            if (isset($_POST[$pk_field])) {
                $pk_value = (int) $_POST[$pk_field];

                // Monta a query UPDATE
                $sql = "UPDATE $tabela SET " . implode(', ', $sets) . " WHERE $pk_field = $pk_value";

                // Executa o UPDATE
                if ($conn->query($sql)) {
                    // Redireciona para o CRUD com uma mensagem de sucesso
                    header("Location: CRUD_template.php?tabela=$tabela&msg=updated");
                    exit;
                } else {
                    echo "Erro ao atualizar: " . $conn->error;
                }
            } else {
                echo "Erro: Valor da chave primária não fornecido.";
            }
        } else {
            echo "Erro ao obter os campos da tabela: " . $conn->error;
        }
    } else {
        echo "Erro: Tabela não especificada.";
    }
} else {
    echo "Método inválido.";
}

// Fecha a conexão
$conn->close();
?>
