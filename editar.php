<?php
include 'conexao.php';
mysqli_set_charset($conn, "utf8");

// Verifica se a conexão com o banco de dados foi estabelecida
if ($conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

// Descrições dos status
$descricao = array(
    "Recebida" => "Denúncia recebida ao órgão competente para análise.",
    "Em analise" => "Denúncia em análise pelo órgão competente.",
    "Em processo" => "Denúncia em processo de investigação.",
    "Concluída" => "Denúncia concluída e resolvida.",
    "Arquivada" => "Denúncia arquivada por falta de provas ou por não ter sido possível identificar o autor."
);

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta as informações da denúncia com base no ID
    $stmt = $conn->prepare("SELECT * FROM Ouvidoria_registros WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $denuncia = $result->fetch_assoc();
    } else {
        echo "Denúncia não encontrada.";
        exit;
    }

    // Consulta as observações associadas à denúncia
    $observacoes_stmt = $conn->prepare("SELECT * FROM Ouvidoria_observacoes WHERE id_registros = ?");
    $observacoes_stmt->bind_param("i", $id);
    $observacoes_stmt->execute();
    $observacoes_result = $observacoes_stmt->get_result();

    // Atualiza o status e a descrição na tabela Ouvidoria_registros se o formulário de status for enviado
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $descricao_status = $descricao[$status]; // Obtém a descrição correspondente ao status
        $status_antigo = $denuncia['status'];

        try {
            // Atualiza o status e a descrição na tabela Ouvidoria_registros
            $update_stmt = $conn->prepare("UPDATE Ouvidoria_registros SET status = ?, descricao_status = ? WHERE ID = ?");
            $update_stmt->bind_param("ssi", $status, $descricao_status, $id);
            $update_stmt->execute();

            // Adiciona uma nova observação com a transição de status
            $data = date("Y-m-d H:i:s"); // Data e hora atual
            $historico_status = "$status_antigo => $status"; // Adiciona seta para a transição
            $descricao_observacao = ""; // Variável adicionada para evitar erro
            $insert_stmt = $conn->prepare("INSERT INTO Ouvidoria_observacoes (id_registros, codigo, observacao, Data1, historico_status) VALUES (?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("issss", $id, $denuncia['codigo'], $descricao_observacao, $data, $historico_status);
            $insert_stmt->execute();

            $mensagem = 'Status e descrição atualizados com sucesso!';

            // Atualiza os dados da denúncia após a atualização do status
            $stmt->execute();
            $result = $stmt->get_result();
            $denuncia = $result->fetch_assoc();
        } catch (Exception $e) {
            $mensagem = 'Erro ao atualizar status e descrição: ' . $e->getMessage();
        }
    }

    // Cadastra uma nova observação se o formulário de observações for enviado
    if (isset($_POST['cadastrar_observacao'])) {
        $observacao = $_POST['observacao'];
        $codigo = $denuncia['codigo'];
        $data = date("Y-m-d H:i:s"); // Data e hora atual

        try {
            // Adiciona uma nova observação
            $insert_stmt = $conn->prepare("INSERT INTO Ouvidoria_observacoes (id_registros, codigo, observacao, Data1) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("isss", $id, $codigo, $observacao, $data);
            $insert_stmt->execute();

            $mensagem_observacao = 'Observação cadastrada com sucesso!';
        } catch (Exception $e) {
            $mensagem_observacao = 'Erro ao cadastrar observação: ' . $e->getMessage();
        }
    }

    // Determine se deve mostrar observações
    $show_observacoes = ($observacoes_result->num_rows > 0 || isset($mensagem_observacao));

} else {
    echo "ID não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'cabeçario2.html'; ?>
    <title>Denúncia - Dineng Ouvidoria</title>
    <link rel="stylesheet" href="Denuncia.css">
    <link rel="stylesheet" href="editar.css">
    <script src="tabela de denuncias.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="content-container">
            <!-- Tabela de Detalhes da Denúncia -->
            <div class="denuncia-details">
                <h2>Detalhes da Denúncia</h2>
                <form action="" method="post">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <td><?php echo htmlspecialchars($denuncia['ID']); ?></td>
                        </tr>
                        <tr>
                            <th>Código</th>
                            <td><?php echo htmlspecialchars($denuncia['codigo']); ?></td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <td><?php echo htmlspecialchars($denuncia['nome']); ?></td>
                        </tr>
                        <tr>
                            <th>Descrição da Denúncia</th>
                            <td><?php echo htmlspecialchars($denuncia['conteudo']); ?></td>
                        </tr>
                        <tr>
                            <th>Data de Envio</th>
                            <td><?php echo date("d/m/Y H:i:s", strtotime(htmlspecialchars($denuncia['data_registro']))); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo htmlspecialchars($denuncia['status']); ?></td>
                        </tr>
                        <tr>
                            <th>Descrição do Status</th>
                            <td><?php echo htmlspecialchars($denuncia['descricao_status']); ?></td>
                        </tr>
                    </table>

                    <div class="status-buttons">
                        <?php if ($denuncia['status'] == 'Recebida'): ?>
                            <button type="submit" name="status" value="Em analise"class="btn btn-primary">Em análise</button>
                        <?php elseif ($denuncia['status'] == 'Em analise'): ?>
                            <button type="submit" name="status" value="Em processo" class="btn btn-secondary">Em processo</button>
                            <button type="submit" name="status" value="Arquivada" class="btn btn-danger">Arquivada</button>
                        <?php elseif ($denuncia['status'] == 'Em processo'): ?>
                            <button type="submit" name="status" value="Concluída" class="btn btn-success">Concluída</button>
                            <button type="submit" name="status" value="Arquivada" class="btn btn-danger">Arquivada</button>
                        <?php elseif ($denuncia['status'] == 'Concluída' || $denuncia['status'] == 'Arquivada'): ?>
                            <button type="submit" name="status" value="Em analise" class="btn btn-primary">Em análise</button>
                        <?php endif; ?> <td>  <a class='btn btn-lg btn-primary' href='<?php echo htmlspecialchars($arquivos['arquivo_nome']); ?>'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-archive' viewBox='0 0 16 16'>
                                            <path d='M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 0 12.5v-10z'/>
                                        </svg>
                                    </a>
                                </td>
                    </div> 
                    <?php if (isset($mensagem)): ?>
                        <div class="alert alert-info"><?php echo htmlspecialchars($mensagem); ?></div>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Formulário para cadastrar nova observação -->
            <?php if ($show_observacoes): ?>
                <div class="observacoes">
                    <h2>Observações</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="observacao">Nova Observação:</label>
                            <textarea name="observacao" id="observacao" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="cadastrar_observacao" class="btn btn-primary">Cadastrar Observação</button>
                    </form>

                    <!-- Mensagem de sucesso ou erro ao cadastrar observação -->
                    <?php if (isset($mensagem_observacao)): ?>
                        <div class="alert alert-info"><?php echo htmlspecialchars($mensagem_observacao); ?></div>
                    <?php endif; ?>

                    <!-- Tabela de observações existentes -->
                    <?php if ($observacoes_result->num_rows > 0): ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Observação</th>
                                    <th>Histórico de Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($observacao = $observacoes_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo date("d/m/Y H:i:s", strtotime(htmlspecialchars($observacao['Data1']))); ?></td>
                                        <td><?php echo htmlspecialchars($observacao['observacao']); ?></td>
                                        <td><?php echo htmlspecialchars($observacao['historico_status']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>
