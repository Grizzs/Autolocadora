<?php
require '../conexão/Connect.php';


class Veiculo {

    private string $placa;
    private string $marcaId;
    private string $veiculo_descricao;
    private \PDO $dbConnection;

    public function __construct($placa, $marcaId,  $veiculo_descricao, $pdo) {
      
        $this->placa = $placa;
        $this->marcaId = $marcaId;
        $this->veiculo_descricao = $veiculo_descricao;
        $this->dbConnection = $pdo;
    }

    public function getPlaca() {
        return $this->placa;
    
    }
    public function getMarca() {
        return $this->marcaId;
    
    }
    public function getDescricao() {
        return $this->veiculo_descricao;
    
    }

    public function salvaVeiculo() {
        $sql = "INSERT INTO tbveiculo(veiculo_placa, veiculo_marca, veiculo_descricao) VALUES (:placa, :marca, :veiculo_descricao)";

        try {
            $stmt = $this->dbConnection->prepare($sql);

            $stmt->bindValue(':placa', $this->getPlaca(), PDO::PARAM_STR);
            $stmt->bindValue(':marca', $this->getMarca(), PDO::PARAM_INT);
            $stmt->bindValue(':veiculo_descricao', $this->getDescricao(), PDO::PARAM_STR);
            $query = $stmt->execute();
        
        } catch (\PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
            
        }
    }

}

?>