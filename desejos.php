<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Desejos - NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluindo SweetAlert -->
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
    </style>
</head>
<body class="bg-gray-800 text-white" style="background-color: #101014;">

<?php
include 'conexoes/config.php';
include 'includes/header.php';
session_start();

// Obter o ID do cliente logado
if (!isset($_SESSION['CodCliente'])) {
    echo "<p class='text-center text-red-500 mt-16'>Por favor, faça login para acessar seu carrinho.</p>";

    exit;
}

$codCliente = $_SESSION['CodCliente'];

// Buscar os jogos no carrinho do cliente
$sql = "SELECT j.CodJogo, j.nome, j.Preco, j.desconto 
        FROM Desejos c 
        INNER JOIN Jogo j ON c.CodJogo = j.CodJogo 
        WHERE c.CodCliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $codCliente);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="mx-auto max-w-screen-xl px-6 md:px-12 lg:px-16 py-4 mt-16 flex-grow">
    <!-- Título -->
    <div class="text-center mb-6">
        <h2 class="text-4xl font-bold text-gray-300">Minha Lista de Desejos</h2>
        <p class="text-gray-400 mt-2 text-purple-500">Confira os jogos que você adicionou à sua lista de desejos!</p>
    </div>
    <script>
    function removerDoCarrinho(codJogo) {
        fetch('remover_dos_desejos.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ CodJogo: codJogo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    background: '#1A202C',
                    confirmButtonColor: '#6B46C1',
                    icon: 'success',
                    title: 'Item removido!',
                    text: 'O item foi removido com sucesso da sua lista de desejos.',
                    showConfirmButton: false,
                    timer: 1500,
                    titleColor: '#ffffff',  // Cor do título em branco
                    textColor: '#ffffff',   // Cor do texto em branco
                    customClass: {
                        popup: 'text-white', // Garante que o texto será branco
                    }
                }).then(() => {
                    location.reload(); // Atualiza a página para refletir a remoção
                });
            } else {
                Swal.fire({
                    background: '#1A202C',
                    confirmButtonColor: '#6B46C1',
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao remover o item dos desejos. Tente novamente.',
                    showConfirmButton: true,
                    titleColor: '#ffffff',  // Cor do título em branco
                    textColor: '#ffffff',   // Cor do texto em branco
                    customClass: {
                        popup: 'text-white', // Garante que o texto será branco
                    }
                });
            }
        })
        .catch(error => console.error('Erro:', error));
    }

</script>

    <?php
    // Exibir quantidade de itens no carrinho
    echo "<p class='text-purple-400 mb-4'>Itens na lista de desejos: " . $result->num_rows . "</p>";
    ?>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $precoOriginal = $row['Preco'];
                $desconto = $row['desconto'];
                $precoFinal = $precoOriginal;

                if (!empty($desconto) && $desconto > 0) {
                    $precoFinal -= ($precoFinal * ($desconto / 100));
                }

                // Card do jogo
                echo "<div class='bg-gray-900 max-w-sm rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl relative'>";
                echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "'>";
                echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-60 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>";
                echo "</a>";
                echo "<div class='p-4'>";
                echo "<p class='text-gray-300 text-sm'>Jogo Base</p>"; 
                echo "<span class='text-lg font-bold'>" . htmlspecialchars($row['nome']) . "</span>";
                echo "<div class='mt-2'>";
                if (!empty($desconto) && $desconto > 0) {
                    echo "<span class='text-purple-500 font-bold'>-{$desconto}%</span>";
                    echo "<div class='flex items-center mt-1'>";
                    echo "<span class='line-through text-gray-400 mr-2'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                    echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoFinal, 2, ',', '.') . "</span>";
                    echo "</div>";
                } else {
                    echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                }
                echo "</div>";
                echo "</div>";
                // Botão para remover do carrinho
                echo "<button class='absolute top-1 right-1 text-purple-500 text-xl font-bold py-1 px-2 rounded-full border-4 border-purple-500 hover:bg-purple-500 hover:text-white hover:border-purple-600 transition-all duration-300' onclick='removerDoCarrinho(" . $row['CodJogo'] . ")'>
                <i class='fas fa-star'></i>
              </button>";
            echo "</div>";
            }
        } else {
            echo "<p class='text-white'>Seu carrinho está vazio.</p>";
        }
        ?>
        
    </div>

    <!-- Total geral -->
    <?php
    $totalQuery = "SELECT SUM(j.Preco - (j.Preco * (j.desconto / 100))) AS Total 
                   FROM Desejos c 
                   INNER JOIN Jogo j ON c.CodJogo = j.CodJogo 
                   WHERE c.CodCliente = ?";
    $stmtTotal = $conn->prepare($totalQuery);
    $stmtTotal->bind_param("i", $codCliente);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $total = $resultTotal->fetch_assoc()['Total'] ?? 0;
    ?>
<div class="text-center mt-8">
    <p class="text-xl font-bold text-gray-300">Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
    <button 
        class="mt-4 inline-block bg-green-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-600 transition-all duration-300" 
        onclick="adicionarTodosAoCarrinho()">
        Adicionar Todos ao Carrinho
    </button>
</div>
    
<section class="mt-10">
    <?php include 'includes/random.php'; ?>
</section>

</main>
<script>function adicionarTodosAoCarrinho() {
    fetch('adicionar_todos_ao_carrinho.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ adicionar_todos: true })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                background: '#1A202C',
                confirmButtonColor: '#6B46C1',
                icon: 'success',
                title: 'Todos os itens adicionados!',
                text: 'Todos os jogos foram movidos para o carrinho.',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    title: 'text-white', // Título em branco
                    popup: 'text-white', // Texto em branco
                }
            }).then(() => {
                location.reload(); // Atualiza a página para refletir as mudanças
            });
        } else {
            Swal.fire({
                background: '#1A202C',
                confirmButtonColor: '#6B46C1',
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao adicionar os itens ao carrinho.',
                showConfirmButton: true,
                customClass: {
                    title: 'text-white', // Título em branco
                    popup: 'text-white', // Texto em branco
                }
            });
        }
    })
    .catch(error => console.error('Erro:', error));
}
</script>

</div>
<?php include 'includes/footer.php'; ?>

</body>
</html>
