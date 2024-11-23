<?php
// Perfil.php

class Perfil {
    private $nome;
    private $dataNasc;
    private $cpf;
    private $email;
    private $nickname;
    private $conexao;

    public function __construct($nickname) {
        // Estabelece a conexão com o banco de dados
        $this->conexao = Conexao::getInstance();
        $this->nickname = $nickname;

        // Carrega os dados do usuário a partir do banco de dados
        $this->carregarPerfil();
    }

    private function carregarPerfil() {
        // Consulta ao banco de dados para buscar as informações do perfil
        $sql = "SELECT nome, dataNasc, cpf, email FROM cliente WHERE nickname = :nickname LIMIT 1";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':nickname', $this->nickname, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Atribui os valores obtidos do banco de dados às variáveis
            $this->nome = $usuario['nome'];
            $this->dataNasc = $usuario['dataNasc'];
            $this->cpf = $usuario['cpf'];
            $this->email = $usuario['email'];
        } else {
            // Se não encontrar, atribui valores padrão ou erro
            $this->nome = 'Informações não disponíveis';
            $this->dataNasc = 'Informações não disponíveis';
            $this->cpf = 'Informações não disponíveis';
            $this->email = 'Informações não disponíveis';
        }
    }

    // Getter e Setter para as variáveis

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDataNasc() {
        return $this->dataNasc;
    }

    public function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNickname() {
        return $this->nickname;
    }
}
?>
