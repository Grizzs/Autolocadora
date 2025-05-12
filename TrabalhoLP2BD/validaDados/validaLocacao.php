<?php 

require '../conexão/Connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigo_locacao = ($_POST['locacao']) ? trim($_POST['locacao']) : null;
    $veiculo_locacao = ($_POST['locacao_veiculo']) ?? null;
    $cliente_locacao = ($_POST['locacao_cliente']) ?? null;

    $inicioLocStr = isset($_POST['inicio_locacao']) ? trim($_POST['inicio_locacao']) : null;
    $fimLocStr = isset($_POST['fim_locacao']) ? trim($_POST['fim_locacao']) : null;

      if(empty($codigo_locacao) || empty($inicioLocStr) || empty($fimLocStr) || $veiculo_locacao == NULL || $cliente_locacao == NULL){
        header("Location:../cadastrar/cadastro_veiculo.php");
        exit;
    }


    $formatoBanco = 'Y-m-d'; 

    $dataInicioObj = DateTime::createFromFormat($formatoBanco, $inicioLocStr);
    $dataFimObj = DateTime::createFromFormat($formatoBanco, $fimLocStr);

    if ($dataInicioObj === false || $dataFimObj === false) {
        header("Location:../cadastrar/cadastro_locacao.php");
        exit;
    }
    
    $inicioData = $dataInicioObj->format($formatoBanco);
    $fimData = $dataFimObj->format($formatoBanco);


    if ($dataInicioObj === false || $dataFimObj === false) {
    header("Location:../cadastrar/cadastro_locacao.php");
    exit;
    }

    if($inicioData > $fimData){
        header("Location:../cadastrar/cadastro_locacao.php");
        exit;
    }


    try {
        $sql_check_codigo = "SELECT COUNT(*) FROM tblocacao WHERE locacao_codigo = :locacao_codigo";
        $stmt_check_codigo = $pdo->prepare($sql_check_codigo);
        $stmt_check_codigo->execute([':locacao_codigo' => $codigo_locacao]);
        $count_codigo = $stmt_check_codigo->fetchColumn();


        if ($count_codigo > 0) {
            header("Location:../cadastrar/cadastro_locacao.php");
            exit;
        }
        
        $sql = 'INSERT INTO tblocacao(locacao_codigo, locacao_veiculo, locacao_cliente, locacao_data_inicio, locacao_data_fim) VALUES (:codigo, :veiculo, :cliente, :inicio, :fim)';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':codigo', $codigo_locacao, PDO::PARAM_INT);
        $stmt->bindValue(':veiculo', $veiculo_locacao, PDO::PARAM_STR);
        $stmt->bindValue(':cliente', $cliente_locacao, PDO::PARAM_INT);
        $stmt->bindValue(':inicio', $inicioData);
        $stmt->bindValue(':fim', $fimData);

        $deuBom = $stmt->execute();
        if ($deuBom) {
            header('Location: ../main.php');
            exit();
        
        }
    }catch (\PDOException $e) {
        error_log("Erro no banco de dados: " . $e->getMessage());  
    }
    
}
?>