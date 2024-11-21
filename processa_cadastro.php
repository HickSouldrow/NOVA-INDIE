<?php
session_start();
include_once 'conexoes/config.php';
include_once 'conexoes/cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nickname = $_POST['nickname'];
    $data_nasc = $_POST['datanasc'];
    $CPF = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    if ($senha !== $confirma_senha) {
        $_SESSION['error'] = 'As senhas não coincidem.';
        header('Location: cadastro.php');
        exit;
    }

    try {
        // Criando uma nova conexão com o banco de dados
        $conn = new Conexao();
        // Preparando a inserção dos dados do cliente
        $sql = $conn->prepare("INSERT INTO cliente (nome, nickname, datanasc, cpf, email, senha) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bindParam(1, $nome);
        $sql->bindParam(2, $nickname);
        $sql->bindParam(3, $data_nasc);
        $sql->bindParam(4, $CPF);
        $sql->bindParam(5, $email);
        $sql->bindParam(6, $senha);

        if ($sql->execute()) {
            // Realizando login automático após cadastro
            $usuario = new Cliente();
            $usuario->setEmail($email);
            $usuario->setSenha($senha);  // Sem hash, conforme sua solicitação

            // Tentando logar o usuário
            $pro_bd = $usuario->logar();
            if ($pro_bd) {
                $_SESSION['usuario'] = $pro_bd;
                
                // Verifica se o usuário é admin e define na sessão
                if ($usuario->isAdmin()) {
                    $_SESSION['is_admin'] = true;
                } else {
                    $_SESSION['is_admin'] = false;
                }
                
                header("Location: index.php");
                exit;
            }
        } else {
            $_SESSION['error'] = 'Erro ao cadastrar.';
            header('Location: cadastro.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Erro no banco de dados: ' . $e->getMessage();
        echo 'Erro no banco de dados: ' . $e->getMessage(); 
    }
}
?>
