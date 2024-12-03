<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
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
        FROM Carrinho c 
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
        <h2 class="text-4xl font-bold text-gray-300">Meu Carrinho</h2>
        <p class="text-gray-400 mt-2 text-purple-500">Confira os jogos que você adicionou ao carrinho!</p>
    </div>
    <script>
    function removerDoCarrinho(codJogo) {
        fetch('remover_do_carrinho.php', {
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
                    text: 'O item foi removido com sucesso do seu carrinho.',
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
                    text: 'Ocorreu um erro ao remover o item do carrinho. Tente novamente.',
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
    echo "<p class='text-purple-400 mb-4'>Itens no carrinho: " . $result->num_rows . "</p>";
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
                echo "<button class='absolute top-2 right-2  text-red-500 text-xs font-bold py-1 px-2 rounded-full border-4 border-red-500 hover:bg-red-500 hover:text-white hover:border-red-600 transition-all duration-300' onclick='removerDoCarrinho(" . $row['CodJogo'] . ")'>--</button>";
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
                   FROM Carrinho c 
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
    <button onclick="abrirPopupPagamento()" class="w-full bg-purple-700 py-2 rounded-full text-white font-bold hover:bg-purple-800 transition-all mb-2">Compre agora</button>

<!-- Popup de Opções de Pagamento -->
<div id="popupPagamento" class="fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center hidden">
    <div class="bg-gray-900 text-white p-6 rounded-lg w-96 shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Escolha a forma de pagamento</h2>
        <form id="formPagamento">
            <div class="mb-6">
                <label for="meioPagamento" class="block mb-2 text-lg">Opção de pagamento</label>
                <select id="meioPagamento" class="w-full px-4 py-2 border border-gray-600 rounded bg-gray-800 text-white">
                    <!-- Opções de pagamento serão carregadas aqui -->
                </select>
            </div>
            <div class="flex justify-between">
                <button type="button" onclick="fecharPopup()" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded transition-all">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded transition-all">Finalizar Compra</button>
            </div>
        </form>
    </div>
</div>

<script>
// Função para abrir o popup de pagamento
function abrirPopupPagamento() {
    // Aqui você pode adicionar uma validação, como verificar se o usuário está logado.
    document.getElementById("popupPagamento").classList.remove("hidden");
    
    // Carregar as opções de pagamento
    carregarOpcoesPagamento();
}

// Função para fechar o popup
function fecharPopup() {
    document.getElementById("popupPagamento").classList.add("hidden");
}

// Função para carregar as opções de pagamento
function carregarOpcoesPagamento() {
    fetch('obter_opcoes_pagamento.php')
    .then(response => response.json())
    .then(data => {
        const select = document.getElementById("meioPagamento");
        select.innerHTML = ''; // Limpa as opções anteriores
        data.opcoes.forEach(opcao => {
            const option = document.createElement("option");
            option.value = opcao.CodMeioPagamento;
            option.textContent = opcao.OpcoesPagamento;
            select.appendChild(option);
        });
    })
    .catch(error => console.error('Erro ao carregar opções de pagamento:', error));
}

// Função para pegar o CodJogo da URL
function obterCodJogoDaURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('CodJogo'); // Captura o CodJogo da URL
}

// Enviar a escolha de pagamento para o servidor
document.getElementById("formPagamento").addEventListener("submit", function(event) {
    event.preventDefault();

    const meioPagamento = document.getElementById("meioPagamento").value;

    fetch('processar_compra2.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            meioPagamento: meioPagamento
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "MeusJogos.php"; // Redireciona para a página de confirmação de compra
        } else {
            alert('Erro ao processar pagamento: ' + data.message);
        }
    })
    .catch(error => console.error('Erro ao processar pagamento:', error));
});



</script>


    </div>
    
<section class="mt-10">
    <?php include 'includes/random.php'; ?>
</section>

</main>



</div>
<?php include 'includes/footer.php'; ?>

</body>
</html>
