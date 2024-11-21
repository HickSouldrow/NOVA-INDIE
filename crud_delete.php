
<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_de_jogos');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nome da tabela e ID recebidos via POST
    $tabela = isset($_POST['tabela']) ? $_POST['tabela'] : null;
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

    if ($tabela && $id) {
        // Consulta o nome do primeiro atributo (chave primária) dinamicamente
        $result = $conn->query("SHOW COLUMNS FROM $tabela");
        if ($result) {
            $columns = $result->fetch_all(MYSQLI_ASSOC);
            $pk_field = $columns[0]['Field']; // O primeiro campo será considerado a PK

            // Monta e executa a query DELETE
            $sql = "DELETE FROM $tabela WHERE $pk_field = $id";

            if ($conn->query($sql)) {
                // Redireciona para o CRUD após a exclusão
                header("Location: CRUD_template.php?tabela=$tabela&msg=deleted");
                exit;
            } else {
                echo "Erro ao deletar registro: " . $conn->error;
            }
        } else {
            echo "Erro ao obter os campos da tabela: " . $conn->error;
        }
    } else {
        echo "Erro: Tabela ou ID não foram fornecidos.";
    }
} else {
    echo "Método HTTP inválido.";
}

// Fecha a conexão
$conn->close();
?>