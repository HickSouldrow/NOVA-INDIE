<?php
include_once 'config.php';
include_once 'conexao.php';

class Cliente
{
    private $CodCliente;
    private $Nome;
    private $Nickname;
    private $DataNasc;
    private $CPF;
    private $Senha;
    private $Email;

    private $conn;

    // Getters e Setters
    public function getCodCliente()
    {
        return $this->CodCliente;
    }

    public function setCodCliente($CodCliente)
    {
        $this->CodCliente = $CodCliente;
    }

    public function getNome()
    {
        return $this->Nome;
    }

    public function setNome($Nome)
    {
        $this->Nome = $Nome;
    }

    public function getNickname()
    {
        return $this->Nickname;
    }

    public function setNickname($Nickname)
    {
        $this->Nickname = $Nickname;
    }

    public function getDataNasc()
    {
        return $this->DataNasc;
    }

    public function setDataNasc($DataNasc)
    {
        $this->DataNasc = $DataNasc;
    }

    public function getCPF()
    {
        return $this->CPF;
    }

    public function setCPF($CPF)
    {
        $this->CPF = $CPF;
    }

    public function getSenha()
    {
        return $this->Senha;
    }

    public function setSenha($Senha)
    {
        $this->Senha = $Senha;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    // Métodos existentes
    public function logar()
    {
        try {
            $this->conn = new Conexao();
            $sql = $this->conn->prepare("SELECT * FROM cliente WHERE senha = ? AND email = ?");
            @$sql->bindParam(1, $this->getSenha(), PDO::PARAM_STR);
            @$sql->bindParam(2, $this->getEmail(), PDO::PARAM_STR);
            $sql->execute();
            return $sql->fetchAll();
            $this->conn = null;
        } catch (PDOException $exc) {
            echo "<span class='text-green-200'>Erro ao executar consulta.</span>" . $exc->getMessage();
        }
    }

    public function autenticar()
    {
        try {
            $this->conn = new Conexao();
            $sql = $this->conn->prepare("SELECT * FROM cliente WHERE email = ?");
            @$sql->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna como array associativo
            $this->conn = null;
            return $result;
        } catch (PDOException $exc) {
            echo "<span class='text-green-200'>Erro ao executar consulta.</span>" . $exc->getMessage();
        }
    }

    public function isAdmin()
    {
        try {
            $this->conn = new Conexao();
            $sql = $this->conn->prepare("SELECT COUNT(*) FROM adm WHERE email = ?");
            @$sql->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchColumn(); // Retorna o número de administradores com o e-mail
            $this->conn = null;
            return $result > 0; // Se encontrar um administrador com esse e-mail, retorna true
        } catch (PDOException $exc) {
            echo "<span class='text-green-200'>Erro ao executar consulta.</span>" . $exc->getMessage();
        }
    }

    // Novos métodos: Verificar duplicidade de email e nickname
    public function existeEmail($email)
    {
        try {
            $this->conn = new Conexao();
            $sql = $this->conn->prepare("SELECT 1 FROM cliente WHERE email = ? LIMIT 1");
            @$sql->bindParam(1, $email, PDO::PARAM_STR);
            $sql->execute();
            $exists = $sql->rowCount() > 0; // Retorna true se encontrar algum resultado.
            $this->conn = null;
            return $exists;
        } catch (PDOException $exc) {
            echo "<span class='text-green-200'>Erro ao executar consulta.</span>" . $exc->getMessage();
        }
    }

    public function existeNickname($nickname)
    {
        try {
            $this->conn = new Conexao();
            $sql = $this->conn->prepare("SELECT 1 FROM cliente WHERE nickname = ? LIMIT 1");
            @$sql->bindParam(1, $nickname, PDO::PARAM_STR);
            $sql->execute();
            $exists = $sql->rowCount() > 0; // Retorna true se encontrar algum resultado.
            $this->conn = null;
            return $exists;
        } catch (PDOException $exc) {
            echo "<span class='text-green-200'>Erro ao executar consulta.</span>" . $exc->getMessage();
        }
    }

    
} 
