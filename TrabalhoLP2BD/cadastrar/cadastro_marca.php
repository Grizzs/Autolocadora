<?php 
require_once '../conexão/Connect.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Marca</title>
    <link rel="stylesheet" href="../src/cadastro.css">
</head>
<body>

    <div class="form-container">
        <form action="../validaDados/validaMarca.php" method="POST" id="cadastro-form">
            <h2>Cadastro de Marca</h2>

            <div class="form-group">
                <label for="marca_codigo">Código da Marca <span class="required" autocomplete="off">*</span></label>
                <input type="text" maxlength="7" id="marca_codigo" name="marca_codigo" placeholder="1" required>
            </div>
            <div class="form-group">
                <label for="marca_descricao">Descrição da Marca <span class="required" autocomplete="off">*</span></label>
                <input type="text" maxlength="22" id="marca_descricao" name="marca_descricao" placeholder="Chevrolet, Tesla, Mercedez" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>

            <p class="obrigatorio-aviso"><span class="required">*</span> Campos obrigatórios</p>
        </form>
    </div>

</body>