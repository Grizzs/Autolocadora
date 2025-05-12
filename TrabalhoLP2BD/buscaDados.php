<?php 
require 'conexão/Connect.php';

$tabela = $_GET['tabela'] ?? '';

if($tabela !== 'tbcliente' && $tabela !== 'tbveiculo' && $tabela !== 'tbmarca' && $tabela !== 'tblocacao' ) {
    echo json_encode([]);
    exit;
}

$query = "SELECT * FROM {$tabela}";
$stmt = $pdo->query($query);
$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($dados);

?>