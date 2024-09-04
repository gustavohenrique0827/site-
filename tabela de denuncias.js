function editarStatus(id, status) {
    // Envia uma requisição AJAX para atualizar o status
    $.ajax({
        type: 'POST',
        url: 'atualizar_status.php',
        data: {id: id, status: status},
        success: function(data) {
            // Atualiza o status na tabela
            $('#status-' + id).text(status);
        }
    });
}
function exibirTabelaDenuncias() {
    document.getElementById("tabela-denuncias").style.display = "block";
    document.getElementById("tabela-reclamacoes").style.display = "none";
}

function exibirTabelaReclamacoes() {
    document.getElementById("tabela-denuncias").style.display = "none";
    document.getElementById("tabela-reclamacoes").style.display = "block";
}