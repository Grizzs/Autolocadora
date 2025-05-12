<?php
require '../conexão/Connect.php';
require '../Obj/veiculo.php';

$veiculo_placa = ($_POST['placa']) ?? null;
$marca_texto = ($_POST['marca']) ?? null;
$veiculo_descricao = ($_POST['descricao']) ?? null;


function validaTbMarca($marca_texto, $pdo){
    if ($marca_texto == NULL){
        
        header('Location:../cadastrar/cadastro_veiculo.php');
        exit;
    }
    else{
        $stmt = $pdo->prepare('SELECT marca_codigo FROM tbmarca WHERE marca_descricao = :marca_descricao');
        $stmt->execute(['marca_descricao' => $marca_texto]);
        $veiculo_marca = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($veiculo_marca){
            return (int) $veiculo_marca['marca_codigo'];
        }
    }
}



if (empty($veiculo_placa) || strlen($veiculo_placa) != 7  || empty($veiculo_descricao)){
    header('Location:../cadastrar/cadastro_veiculo.php');
    exit;
}else{
    $veiculo_marca = validaTbMarca($marca_texto, $pdo);
    $veiculo = new Veiculo($veiculo_placa, $veiculo_marca, $veiculo_descricao, $pdo);
    $veiculo->salvaVeiculo();
    
}

header('Location:../main.php');
exit;


?>