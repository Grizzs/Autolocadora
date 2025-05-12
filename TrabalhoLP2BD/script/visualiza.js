    const selectTipoTabela = document.getElementById('tipoTabelaSelect');
    const btnListar = document.getElementById('listarBtn');
    const containerTabela = document.getElementById('tabelaContainer');

    function criarTabela(dados) {
        containerTabela.innerHTML = ''; 
    
        if (!dados || dados.length === 0) {
            containerTabela.innerHTML = '<p>Nenhum dado encontrado para esta seleção.</p>';
            return;
        }
    
        let tabelaHtml = '<table border="1"><thead><tr>'; 
    
        const colunas = Object.keys(dados[0]);
        colunas.forEach(col => {
          tabelaHtml += `<th>${col}</th>`;
        });
        tabelaHtml += '<th>Ações</th>';
        tabelaHtml += '</tr></thead><tbody>';
    
        dados.forEach(row => {
            tabelaHtml += '<tr>';
            colunas.forEach(col => {
                tabelaHtml += `<td>${row[col] !== null ? row[col] : ''}</td>`;
        });
            
            let idRegistro;
        const tipoAtual = selectTipoTabela.value; 

        if (tipoAtual === 'tbcliente') {
            idRegistro = row.cliente_cpf; 
        } else if (tipoAtual === 'tbveiculo') {
            idRegistro = row.veiculo_placa; 
        }
        else if (tipoAtual === 'tbmarca') {
                idRegistro = row.marca_codigo; 
        }        
        else if (tipoAtual === 'tblocacao') {
                    idRegistro = row.locacao_codigo; 
        } else {
            idRegistro = null
        }


        if (idRegistro === undefined || idRegistro === null || idRegistro === '') { 
             console.error(`Erro: Não foi possível encontrar um ID válido na coluna esperada para o tipo '${tipoAtual}'. Dados da linha:`, row);
             tabelaHtml += '<td>Erro: ID inválido</td>'; // Mensagem de erro mais clara
        } else {
              tabelaHtml += `<td>
                        <form action="script/removerDados.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja remover este item?');">
                            <input type="hidden" name="id" value="${idRegistro}">
                            <input type="hidden" name="tipo" value="${tipoAtual}">
                            <input type="submit" value="Remover" class="btn-remover-form">
                        </form>
                   </td>`;
        }
            tabelaHtml += '</tr>';
        });
    
        tabelaHtml += '</tbody></table>'; 
    
        containerTabela.innerHTML = tabelaHtml;
    }

    selectTipoTabela.addEventListener('change', function() {
        const valorSelecionado = selectTipoTabela.value;

        if (valorSelecionado) {
            btnListar.style.display = 'block';
        } else {
            btnListar.style.display = 'none';     
            containerTabela.innerHTML = '';       
        }
    });

    btnListar.addEventListener('click', () => {
        const tipoSelecionado = selectTipoTabela.value;
        console.log("Listando...");

        fetch('buscaDados.php?tabela=' + tipoSelecionado)
        .then(response => response.json())
        .then(dados => {
            console.log('JSON recebido:', dados);
            criarTabela(dados);
        })
        .catch(error => {
            console.error('Erro ao buscar dados: ', error);      
        });
    });

