<?php
session_start();
require '../conexão/Connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $tipoTabela = $_POST['tipo'] ?? null;

    $tabelasPermitidas = [
        'tbcliente' => 'cliente_cpf',
        'tbveiculo' => 'veiculo_placa',
        'tbmarca'   => 'marca_codigo',
        'tblocacao' => 'locacao_codigo'
    ];

    if ($id && $tipoTabela && array_key_exists($tipoTabela, $tabelasPermitidas)) {
        $nomeRealTabela = $tipoTabela;
        $colunaId = $tabelasPermitidas[$tipoTabela];

        try {
            $sql = "DELETE FROM " . $nomeRealTabela . " WHERE " . $colunaId . " = :id_param";
            $stmt = $pdo->prepare($sql);

            $param_type = PDO::PARAM_STR;
            if ($colunaId === 'marca_codigo' || $colunaId === 'locacao_codigo') { 
                $param_type = PDO::PARAM_INT;
            }
            $stmt->bindValue(':id_param', $id, $param_type);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION['feedback_remocao'] = "Registro removido";
                } else {
                    $_SESSION['feedback_remocao'] = "Nenhum registro encontrado";
                }
            }
        } catch (PDOException $e) {
            header('Location:../main.php');
            exit;
        }
    }

    header('Location:../visualiza.php');
    exit;
}
?>