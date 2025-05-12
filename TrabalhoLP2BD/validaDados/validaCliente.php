<?php
session_start();

require '../conexão/Connect.php';
require '../Obj/cliente.php';

$cpf_cliente = isset($_POST['cpf']) ? preg_replace('/\D/', '', $_POST['cpf']) : NULL;
$nome_cliente = ($_POST['nome']);
$endereco_cliente = ($_POST['endereco']);


if (!ctype_digit($cpf_cliente) || strlen($cpf_cliente) != 11 || empty($endereco_cliente)){
    $_SESSION['cadastrou'] = 0;
    header('Location:main.php');
    exit;
}else{
    $cliente = new Cliente($nome_cliente, $cpf_cliente, $endereco_cliente, $pdo);
    $cliente->salvaCliente();
    $_SESSION['cadastrou'] = 1;
}





header('Location:../main.php');

exit;

?>