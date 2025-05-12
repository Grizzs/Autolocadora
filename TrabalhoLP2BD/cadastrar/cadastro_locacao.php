<?php 
require_once '../conexão/Connect.php';

$sql = "SELECT locacao_veiculo FROM tblocacao";
$resultado = $pdo->query($sql);

$sql = "SELECT cliente_cpf FROM tbcliente";
$cliente = $pdo->query($sql);

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
        <form action="../validaDados/validaLocacao.php" method="POST" id="cadastro-form"> 
            <h2>Cadastro de Locações</h2>

            <div class="form-group">
                <label for="locacao">Código da Locação <span class="required" autocomplete="off">*</span></label>
                <input type="text" maxlength="5" id="locacao" name="locacao" placeholder="1234567" required>
            </div>
            <div class="form-group">
                <label for="veiculo">Veiculo<span class="required">*</span></label>
                <select name="locacao_veiculo" id="tblocacao">
                <option value="">-- Selecione o Veiculo --</option>
                    <?php 
                        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                            $locacao_veiculo = $row['locacao_veiculo'];
                            echo "<option value='{$locacao_veiculo}'>$locacao_veiculo</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Cliente">Cliente<span class="required">*</span></label>
                <select name="locacao_cliente" id="tblocacao">
                <option value="">-- Selecione o Cliente --</option>
                    <?php 
                        while ($row = $cliente->fetch(PDO::FETCH_ASSOC)) {
                            $cliente_cpf = $row['cliente_cpf'];
                            echo "<option value='{$cliente_cpf}'>$cliente_cpf</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inicio_locacao">Inicio da Locação <span class="required">*</span></label>
                <input type="date" id="inicio_locacao" maxlength='10' name="inicio_locacao" placeholder="aaaa-mm-dd" required>
            </div>
            <div class="form-group">
                <label for="fim_locacao">Fim da Locação <span class="required">*</span></label>
                <input type="date" id="fim_locacao" maxlength='10' name="fim_locacao" placeholder="aaaa-mm-dd" required>
            </div>
        
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>

            <p class="obrigatorio-aviso"><span class="required">*</span> Campos obrigatórios</p>
        </form>
    </div>

</body>