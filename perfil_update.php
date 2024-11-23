<?php
// Conexão com o banco de dados
include 'conexoes/config.php';


// Verifica se o usuário está logado
session_start();
if (!isset($_SESSION['CodCliente'])) {
    header('Location: login.php');
    exit();
}


// Obtém o ID do usuário logado
$codCliente = $_SESSION['CodCliente'];

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $dataNasc = htmlspecialchars($_POST['dataNasc']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $senha = htmlspecialchars($_POST['senha']);

     
        // Atualiza o banco de dados
        $sql = "UPDATE cliente SET nome = ?, dataNasc = ?, cpf = ?, senha = ? WHERE CodCliente = ?";
        $stmt = $conn->prepare($sql);
        
        // Hash da senha
        
        // Execute o SQL
        $stmt->bind_param('ssssi', $nome, $dataNasc, $cpf, $senha, $codCliente);
        
        if ($stmt->execute()) {
            echo "<script>window.location.href='perfil.php'; </script>";
        } else {
            echo "<script>alert('Erro ao atualizar as informações. Tente novamente mais tarde.');</script>";
        }
    }

?>
