<?php
include_once 'config.php';
include_once 'conexao.php';

class Adm
{
    private $Email;
    private $Senha;
    private $conn;

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setSenha($Senha) {
        $this->Senha = $Senha;
    }

    public function logar()
    {
        try {
            $this->conn = new Conexao();
            $sql = $this->conn->prepare("SELECT * FROM adm WHERE senha = ? AND email = ?");
            @$sql->bindParam(1, $this->Senha, PDO::PARAM_STR);
            @$sql->bindParam(2, $this->Email, PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC); // Retorna um array associativo
            $this->conn = null;
            return $result;
        } catch(PDOException $exc) {
            echo "<span class='text-green-200'>Erro ao executar consulta.</span>" . $exc->getMessage();
        }
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

?>
