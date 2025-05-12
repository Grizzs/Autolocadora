<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/visualiza.css">
    <title>Visualizar</title>
</head>
<body>
    <div class="selectHeader">
        <label for="tipoTabelaSelect">Escolha a Listagem:</label>
        <select id="tipoTabelaSelect">
            <option value="">-- Selecione --</option>
            <option value="tbcliente">Clientes</option>
            <option value="tbveiculo">Veículos</option>
            <option value="tbmarca">Marca</option>
            <option value="tblocacao">Locação</option>
        </select>
        <button id="listarBtn">Listar</button>
        
    </div>
    <div id="tabelaContainer">
        
    </div>

    <script src="script/visualiza.js"></script>
</body>
</html>

