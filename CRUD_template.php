<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Nova Indie</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">


    <style>


body {
    margin: 0; 
    padding: 0; 
    background-image: url('assets/img/background.png'); 
    background-repeat: no-repeat; 
    background-size: cover; 
    background-attachment: fixed; 
    background-position: center; 
    font-family: Arial; 
}
        table {
            font-size: 13px;
        }
        th, td {
            padding: 12px;
        }
        .form-input {
            height: 38px;
            border-radius: 8px;
            background-color: #2d2d2d;
            border: 1px solid #444444;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            background-color: #333333;
            border-color: #6b4cfc;
            box-shadow: 0 0 0 2px rgba(107, 76, 252, 0.5);
        }
        button {
            transition: transform 0.2s ease-in-out;
        }
        button:hover {
            transform: scale(1.05);
        }
        .button {
            border-radius: 8px;
            padding: 10px 15px;
            transition: background-color 0.3s ease;
        }
        .button-primary {
            background-color: #6b4cfc;
            color: white;
        }
        .button-primary:hover {
            background-color: #5736c3;
        }
        .button-secondary {
            background-color: #444444;
            color: white;
        }
        .button-secondary:hover {
            background-color: #353535;
        }
    </style>
</head>
<body class="bg-neutral-900 text-gray-200 mt-28">
    <?php include 'includes/header.php'; ?>
    <?php
    // Obtém o nome da tabela da URL
    $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : null;

    if ($tabela) {
        // Conectar ao banco
        $conn = new mysqli('localhost', 'root', '', 'loja_de_jogos');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
 // Definir o valor de pesquisa, se fornecido
        $pesquisaValor = isset($_GET['pesquisaValor']) ? $_GET['pesquisaValor'] : null;

    // Caso contrário, exibe todos os registros
    switch ($tabela) {
        case 'jogo':
            $sql = "SELECT * FROM jogo ORDER BY CodJogo";
            break;
        case 'desenvolvedora':
            $sql = "SELECT * FROM desenvolvedora ORDER BY CodDesenvolvedora";
            break;
        case 'cliente':
            $sql = "SELECT * FROM cliente ORDER BY CodCliente";
            break;
        case 'notafiscal':
            $sql = "SELECT * FROM notafiscal ORDER BY CodNotaFiscal";
            break;
        case 'genero':
            $sql = "SELECT * FROM genero ORDER BY CodGenero";
            break;
        case 'categoria':
            $sql = "SELECT * FROM categoria ORDER BY CodCategoria";
            break;
        case 'reqminimos':
            $sql = "SELECT * FROM reqminimos ORDER BY ReqMinId";
            break;
        case 'MeioPagamento':
            $sql = "SELECT * FROM MeioPagamento ORDER BY CodMeioPagamento";
            break;
        default:
            $sql = "SELECT * FROM $tabela";
    
}


    // Se pesquisaValor foi passado, ajusta a consulta para buscar o registro pela PK
    if ($pesquisaValor) {
        // Obtém dinamicamente a chave primária da tabela
        $result_pk = $conn->query("SHOW COLUMNS FROM $tabela");
        if ($result_pk) {
            $columns = $result_pk->fetch_all(MYSQLI_ASSOC);
            $pk_field = $columns[0]['Field']; // O primeiro campo será considerado a PK

            $sql = "SELECT * FROM $tabela WHERE $pk_field = '" . $conn->real_escape_string($pesquisaValor) . "'";
        } else {
            die("Erro ao obter os campos da tabela: " . $conn->error);
        }
    }

    // Executa a consulta
    $result = $conn->query($sql);

    // Obter os campos da tabela para criar o formulário e os botões
    $fields = $result ? $result->fetch_fields() : [];
} else {
    $result = null;
    $fields = [];
}
?>

    <main class="mx-auto max-w-5xl px-6 py-4">

 <!-- Campo de pesquisa -->
 <section class="mb-6">
        <form method="GET" action="">
            <input type="hidden" name="tabela" id="tabela" value="<?php echo $tabela; ?>">

            <label for="pesquisaValor" class="block text-sm font-medium mb-1 text-gray-300">Pesquisar por Código:</label>
            <div class="flex gap-2">
                <!-- Campo de pesquisa para PK -->
                <input type="text" name="pesquisaValor" id="pesquisaValor" class="form-input flex-1 p-3 focus:ring-2 focus:ring-purple-700 focus:border-transparent text-gray-200">

                <!-- Botão de pesquisa -->
                <button type="submit" name="btnPesquisar" class="py-2 px-4 bg-purple-700 button button-primary">Pesquisar</button>

                <!-- Botão de limpar -->
                <button type="reset" class="py-2 px-4 button button-secondary">Limpar</button>
            </div>
        </form>
        </section>


        <!-- Tabela de resultados -->
        <section class="bg-gray-900 mt-8 p-4 rounded-lg shadow-lg">
            <h2 class="text-center text-lg font-semibold mb-3">Tabela de <?php echo ucfirst($tabela); ?></h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto bg-gray-900 rounded-lg shadow-lg">
                    <thead class="bg-purple-700 text-gray-300">
                        <tr>
                            <?php 
                            foreach ($fields as $field): ?>
                                <th class="px-4 py-2"><?php echo ucfirst($field->name); ?></th>
                            <?php endforeach; ?>
                            <th class="px-4 py-2 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()): ?>
        <tr class="border-b border-gray-700 hover:bg-gray-800">
            <?php foreach ($row as $column): ?>
                <td class="px-4 py-2 text-gray-200"><?php echo $column; ?></td>
            <?php endforeach; ?>
            <td class="px-4 py-2 text-center">
                <div class="flex justify-center gap-2">
                        <?php
                        // Identifica o campo PK dinamicamente como o primeiro atributo
                        $pk_field = $fields[0]->name; 
                        ?>
                      <button type="button" 
    onclick="openDeleteModal(
        '<?php echo $row[$pk_field]; ?>', 
        <?php echo htmlspecialchars(json_encode($row)); ?>, 
        <?php echo htmlspecialchars(json_encode(array_column($fields, 'name'))); ?>
    )" 
    class="py-1 px-2 bg-[#101014] hover:bg-[#101014] text-red-500 border border-red-500 rounded text-sm">
    Excluir
</button>

                    <button href="#" onclick="openEditModal(
                            '<?php echo $row[$pk_field]; ?>', 
                            <?php echo htmlspecialchars(json_encode($row)); ?>, 
                            <?php echo htmlspecialchars(json_encode(array_column($fields, 'name'))); ?>
                        )"
                        class="py-1 px-2 bg-[#101014] hover:bg-[#101014] text-yellow-500 border border-yellow-500 rounded text-sm">
                        Alterar
            </button>
                </div>
            </td>
        </tr>
    <?php endwhile; 
                        } else { ?>
                            <tr>
                                <td colspan="<?php echo count($fields) + 1; ?>" class="px-4 py-2 text-center text-gray-400">Nenhum registro encontrado.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
        if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
            echo '<p class="text-center text-red-500">Registro excluído com sucesso!</p>';
        }
       
        if (isset($_GET['msg']) && $_GET['msg'] === 'updated') {
            echo '<p class="text-center mt-4 text-yellow-500">Registro atualizado com sucesso!</p>';
        }
        ?>
            <section class="bg-gray-900 mt-16 p-8 rounded-xl shadow-2xl mb-8 max-w-3xl mx-auto">
    <h2 class="text-center text-2xl font-bold mb-6 text-white">
        Gerenciar <?php echo ucfirst($tabela); ?>
    </h2>

    
    <form method="POST" action="crud_create.php?tabela=<?php echo $tabela; ?>" class="space-y-6">
    <?php
    // Obtem os campos da tabela dinamicamente
    $isFirstField = true; // Variável para identificar o primeiro campo
    foreach ($fields as $field):
        // Verifica se o campo é o primeiro e se é auto-incremento (geralmente a chave primária)
        if ($isFirstField && strpos($field->name, 'Cod') !== false) {
            // Se for o primeiro campo auto-incremento, pule-o
            $isFirstField = false;
            continue;
        }
    ?>
        <div class="relative group">
            <label for="<?php echo $field->name; ?>" 
                class="block text-sm font-semibold mb-1 text-gray-400 group-hover:text-purple-500 transition duration-300">
                <?php echo ucfirst($field->name); ?>
            </label>
            <input type="text" 
                name="<?php echo $field->name; ?>" 
                id="<?php echo $field->name; ?>" 
                class="form-input w-full p-4 rounded-lg bg-gray-800 text-gray-200 border border-gray-700 focus:ring-2 focus:ring-purple-600 focus:outline-none transition duration-300"
                placeholder="Digite <?php echo ucfirst($field->name); ?>">
        </div>
    <?php endforeach; ?>
    <div class="flex justify-between gap-4 mt-6">
        <button type="submit" 
            class="w-full py-3 px-6 bg-purple-700 hover:bg-purple-600 text-white font-semibold rounded-lg shadow-md transform transition duration-300 hover:scale-105 focus:ring-2 focus:ring-purple-500 focus:outline-none">
            Inserir
        </button>
        <button type="reset" 
            class="w-full py-3 px-6 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md transform transition duration-300 hover:scale-105 focus:ring-2 focus:ring-gray-500 focus:outline-none">
            Limpar
        </button>
    </div>
</form>

</section>


    </main>
    <?php include 'includes/footer.php'; ?>

    <script>
function openDeleteModal(pkValue, rowData, columnNames) {
    // Mostra o modal
    document.getElementById('deleteModal').classList.remove('hidden');

    // Define o valor da chave primária no campo hidden
    document.getElementById('deletePk').value = pkValue;

    // Container para os campos do formulário
    const deleteFields = document.getElementById('deleteFields');
    deleteFields.innerHTML = '';

    // Cria os campos para exibir os dados do registro
    columnNames.forEach((columnName) => {
        const value = rowData[columnName] || '';
        const fieldHTML = `
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">${columnName}</label>
                <p class="bg-gray-700 text-gray-400 border border-gray-600 rounded-lg w-full p-2">${value}</p>
            </div>
        `;
        deleteFields.innerHTML += fieldHTML;
    });
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

function openEditModal(pkValue, rowData, columnNames) {
    // Mostra o modal
    document.getElementById('editModal').classList.remove('hidden');

    // Container para os campos do formulário
    const editFields = document.getElementById('editFields');
    editFields.innerHTML = '';

    // Cria os campos do formulário
    columnNames.forEach((columnName, index) => {
        const value = rowData[columnName] || '';

        const fieldHTML = `
    <div>
        <label class="block text-sm font-semibold text-gray-300 mb-2 tracking-wide">${columnName}</label>
        <input 
            type="text" 
            name="${columnName}" 
            value="${value}" 
            ${index === 0 ? 
                'readonly class="bg-gray-700 text-gray-400 border border-gray-600 rounded-lg w-full p-2 cursor-not-allowed"' : 
                'class="form-input w-full rounded-lg border border-gray-600 p-2 focus:ring-2 focus:ring-purple-600 focus:border-transparent"'}>
    </div>
`;
        editFields.innerHTML += fieldHTML;
    });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6 max-w-lg w-full max-h-[90%] overflow-y-auto">
        <h2 class="text-lg font-semibold mb-4">Confirmação de Exclusão</h2>
        <form id="deleteForm" method="POST" action="crud_delete.php">
            <input type="hidden" name="tabela" value="<?php echo $tabela; ?>">
            <input type="hidden" id="deletePk" name="id" value="">

            <!-- Exibição dos dados do registro -->
            <div id="deleteFields" class="space-y-4 max-h-80 overflow-y-auto pr-2"></div>

            <!-- Botões -->
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeDeleteModal()" class="py-2 px-4 bg-gray-600 hover:bg-gray-500 text-white rounded-lg">Cancelar</button>
                <button type="submit" class="py-2 px-4 bg-red-600 hover:bg-red-500 text-white rounded-lg">Excluir</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6 max-w-lg w-full max-h-[90%] overflow-y-auto">
        <h2 class="text-lg font-semibold mb-4">Alterar Registro</h2>
        <form id="editForm" method="POST" action="crud_update.php">
            <input type="hidden" name="tabela" value="<?php echo $tabela; ?>">
            
            <!-- Campos do formulário -->
            <div id="editFields" class="space-y-4 max-h-80 overflow-y-auto pr-2"></div> <!-- Adicionado overflow-y-auto aqui -->

            <!-- Botões -->
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeEditModal()" class="py-2 px-4 bg-gray-600 hover:bg-gray-500 text-white rounded-lg">Cancelar</button>
                <button type="submit" class="py-2 px-4 bg-purple-600 hover:bg-purple-500 text-white rounded-lg">Salvar</button>
            </div>

        </form>
    </div>
</div>
</body>
</html>
