<?php 
require '../conexão/Connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigo_marca = $_POST['marca_codigo'] ? trim($_POST['marca_codigo']) : null;
    $descricao_marca = $_POST['marca_descricao'] ? trim($_POST['marca_descricao']) : null;


    if (empty($codigo_marca)) {
       header("Location:../cadastrar/cadastro_marca.php");
       exit;
    }
    if (empty($descricao_marca)) {
        header("Location:../cadastrar/cadastro_marca.php");
        exit;
    }
    try {
        $sql_check_codigo = "SELECT COUNT(*) FROM tbmarca WHERE marca_codigo = :codigo_marca";
        $stmt_check_codigo = $pdo->prepare($sql_check_codigo);
        $stmt_check_codigo->execute([':codigo_marca' => $codigo_marca]);
        $count_codigo = $stmt_check_codigo->fetchColumn();


        if ($count_codigo > 0) {
            header("Location:../cadastrar/cadastro_marca.php");
            exit;
        }

        $sql_check_descricao = "SELECT COUNT(*) FROM tbmarca WHERE marca_descricao = :marca_descricao";
        $stmt_check_descricao = $pdo->prepare($sql_check_descricao);
        $stmt_check_descricao->execute([':marca_descricao' => $descricao_marca]);
        $count_descricao = $stmt_check_descricao->fetchColumn();

        if ($count_descricao > 0) {
            header("Location:../cadastrar/cadastro_marca.php");
            exit;
        }

        
        $sql = 'INSERT INTO tbmarca(marca_codigo, marca_descricao) VALUES (:codigo_marca, :marca_descricao)';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':codigo_marca', $codigo_marca, PDO::PARAM_INT);
        $stmt->bindValue(':marca_descricao', $descricao_marca, PDO::PARAM_STR);
        $query = $stmt->execute();

    }catch (\PDOException $e) {
            error_log("Erro no banco de dados: " . $e->getMessage());
            
        }
        header('Location:../main.php');
        exit();
}

?>