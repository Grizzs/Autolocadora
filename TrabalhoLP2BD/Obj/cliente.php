<?php
require '../conexão/Connect.php';

class Cliente {

    private string $cpf;
    private string $nome;
    private string $endereco;
    private \PDO $dbConnection;

    public function __construct($nome, $cpf, $endereco, $pdo) {
      
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
        $this->dbConnection = $pdo;
    }

    public function getNome() {
        return $this->nome;
    
    }
    public function getCPF() {
        return $this->cpf;
    
    }
    public function getEndereco() {
        return $this->endereco;
    
    }

    public function salvaCliente() {
        $sql = "INSERT INTO tbcliente(cliente_nome, cliente_cpf, cliente_endereco) VALUES (:nome, :cpf, :endereco)";

        try {
            $stmt = $this->dbConnection->prepare($sql);

            $stmt->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(':cpf', $this->getCPF(), PDO::PARAM_STR);
            $stmt->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $sucesso = $stmt->execute();
        
            if ($sucesso) {
        
                echo "Usuário salvo com sucesso!";
            } else {
                echo "Erro ao salvar o usuário.";
            }
        
        } catch (\PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
        
        }
    }

}

?>