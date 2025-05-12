<?php 
require "../Obj/cliente.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="../src/cadastro.css">
</head>
<body>

    <div class="form-container">
        <form action="../validaDados/validaCliente.php" method="POST" id="cadastro-form"> <!-- action="#" apenas para exemplo -->
            <h2>Cadastro de Cliente</h2>

            <div class="form-group">
                <label for="cpf">CPF <span class="required" autocomplete="off">*</span></label>
                <input type="text" maxlength="11" id="cpf" name="cpf" placeholder="000.000.000-00" required>
            </div>

            <div class="form-group">
                <label for="nome">Nome Completo <span class="required">*</span></label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço <span class="required">*</span></label>
                <input type="text" id="endereco" name="endereco" placeholder="Rua, Número, Bairro" required>
            </div>

            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>

            <p class="obrigatorio-aviso"><span class="required">*</span> Campos obrigatórios</p>
        </form>
    </div>

</body>
</html>