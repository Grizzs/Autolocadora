<?php 
require_once '../conexão/Connect.php';
require "../Obj/veiculo.php";


$sql = "SELECT marca_descricao FROM tbmarca";
$resultado = $pdo->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veiculo</title>
    <link rel="stylesheet" href="../src/cadastro.css">
</head>
<body>

    <div class="form-container">
        <form action="../validaDados/validaVeiculo.php" method="POST" id="cadastro-form"> 
            <h2>Cadastro de Veiculo</h2>

            <div class="form-group">
                <label for="placa">Placa <span class="required" autocomplete="off">*</span></label>
                <input type="text" maxlength="7" id="placa" name="placa" placeholder="1234567" required>
            </div>
            <div class="form-group">
                <label for="Marca">Marca<span class="required">*</span></label>
                <select name="marca" id="tbmarca">
                <option value="">-- Selecione uma Marca --</option>
                    <?php 
                        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                            $marca_descricao = $row['marca_descricao'];
                            echo "<option value='{$marca_descricao}'>$marca_descricao</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição do Veiculo <span class="required">*</span></label>
                <input type="text" id="descricao" name="descricao" placeholder="Onix, Uno, Model S" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>

            <p class="obrigatorio-aviso"><span class="required">*</span> Campos obrigatórios</p>
        </form>
    </div>

</body>