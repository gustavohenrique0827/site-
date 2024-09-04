<?php
include 'conexao.php';

// Verifica se a conexão com o banco de dados foi estabelecida
if (!$conn) {
    die('Erro ao conectar com o banco de dados.');
}

// Descrições dos status
$descricao = array(
    "Recebida" => "Reclamações recebida ao órgão competente para análise.",
    "Em analise" => "Reclamações em analise pelo órgão competente.",
    "Em processo" => "Reclamações em processo de investigação.",
    "Concluída" => "Reclamações concluída e resolvida.",
    "Arquivada" => "Reclamações arquivada por falta de provas ou por não ter sido possível identificar o autor."
);

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Consulta as informações da denúncia com base no ID
    $stmt = $conn->prepare("SELECT * FROM `registros de reclamacoes` WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $denuncia = $result->fetch_assoc();
    } else {
        echo "Denúncia não encontrada.";
        exit;
    }

    // Atualiza o status e a descrição se o formulário de status for enviado
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $descricao_status = $descricao[$status]; // Obtém a descrição correspondente ao status

        try {
            $update_stmt = $conn->prepare("UPDATE `registros de reclamacoes` SET status_reclamacao = ?, descricao = ? WHERE ID = ?");
            $update_stmt->bind_param("ssi", $status, $descricao_status, $id);
            $update_stmt->execute();

            $mensagem = 'Status e descrição atualizados com sucesso!';
            
            // Atualiza os dados da denúncia após a atualização do status
            $stmt->execute(); // Atualiza o resultado
            $result = $stmt->get_result(); // Atualiza o resultado
            $denuncia = $result->fetch_assoc(); // Atualiza a variável $denuncia
        } catch (Exception $e) {
            $mensagem = 'Erro ao atualizar status e descrição: ' . $e->getMessage();
        }
    }

    // Cadastra uma nova observação se o formulário de observações for enviado
    if (isset($_POST['cadastrar_observacao'])) {
        $observacao = $_POST['observacao'];
        $data = date("Y-m-d"); // Data atual

        try {
            $insert_stmt = $conn->prepare("INSERT INTO `observacoes_reclamacoes` (id_reclamacoes, observacao, data) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("iss", $id, $observacao, $data);
            $insert_stmt->execute();

            $mensagem_observacao = 'Observação cadastrada com sucesso!';
        } catch (Exception $e) {
            $mensagem_observacao = 'Erro ao cadastrar observação: ' . $e->getMessage();
        }
    }

    // Consulta as observações associadas à denúncia
    $observacoes_stmt = $conn->prepare("SELECT * FROM `observacoes_reclamacoes` WHERE id_reclamacoes = ?");
    $observacoes_stmt->bind_param("i", $id);
    $observacoes_stmt->execute();
    $observacoes_result = $observacoes_stmt->get_result();

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
    <meta charset="UTF-8">
    <title>Reclamações - Dineng Administrativa</title>
    <link rel="stylesheet" href="Denuncia.css">
    <script src="tabela_de_denuncias.js" defer></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
    <style>

        body {
            background-color: #f7f7f7;
        }
        .header {
            text-align: center;
            margin-bottom: 40px; /* Espaçamento adicional */
        }
        .header img {
            height: 100px;
        }
        .header h1 {
            margin: 10px 0;
        }
        .container {
            max-width: 800px;
            margin: 74px auto;
            padding: 20px;
            background-color: #ffffff;
        }
        .content-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 110px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            table-layout: fixed;
            word-wrap: break-word;
        }
        .status-buttons {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .back-button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }
        .back-button img {
            margin-right: 10px;
        }
        .form-observacao {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="imagens_botoes/Dineng_Logo_02.png" alt="Dineng Logo">
        <h1 class="dineng1">Reclamações</h1>
    </div>
    <div class="container">
        <div class="content-container">
            <form action="" method="post">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>ID</th>
                        <td><?php echo htmlspecialchars($denuncia['ID']); ?></td>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <td><?php echo htmlspecialchars($denuncia['nome']); ?></td>
                    </tr>
                    <tr>
                        <th>Descrição da Reclamações</th>
                        <td><?php echo htmlspecialchars($denuncia['Reclamacao']); ?></td>
                    </tr>
                    <tr>
                        <th>Data de Envio</th>
                        <td><?php echo date("d/m/Y", strtotime(htmlspecialchars($denuncia['datareclamacao']))); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?php echo htmlspecialchars($denuncia['status_reclamacao']); ?></td>
                    </tr>
                    <tr>
                        <th>Descrição do Status</th>
                        <td><?php echo htmlspecialchars($denuncia['descricao']); ?></td>
                    </tr>
                </table>

                <div class="status-buttons">
                    <?php if ($denuncia['status_reclamacao'] == 'Recebida'): ?>
                        <button type="submit" name="status" value="Em analise" class="btn btn-primary">Em análise</button>
                    <?php elseif ($denuncia['status_reclamacao'] == 'Em analise'): ?>
                        <button type="submit" name="status" value="Em processo" class="btn btn-secondary">Em processo</button>
                        <button type="submit" name="status" value="Arquivada" class="btn btn-danger">Arquivada</button>
                    <?php elseif ($denuncia['status_reclamacao'] == 'Em processo'): ?>
                        <button type="submit" name="status" value="Concluída" class="btn btn-success">Concluída</button>
                        <button type="submit" name="status" value="Arquivada" class="btn btn-danger">Arquivada</button>
                    <?php elseif ($denuncia['status_reclamacao'] == 'Arquivada' || $denuncia['status_reclamacao'] == 'Concluída'): ?>
                        <button type="submit" name="status" value="Em analise" class="btn btn-primary">Em análise</button>
                    <?php endif; ?>
                </div>

                <?php if (isset($mensagem)): ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($mensagem); ?></div>
                <?php endif; ?>

                <!-- Formulário para cadastrar nova observação -->
                <div class="form-observacao">
                    <h3>Adicionar Observação</h3>
                    <div class="form-group">
                        <textarea name="observacao" class="form-control" rows="4" placeholder="Digite a observação..."></textarea>
                    </div>
                    <button type="submit" name="cadastrar_observacao" class="btn btn-primary">Cadastrar Observação</button>
                </div>

                <?php if (isset($mensagem_observacao)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($mensagem_observacao); ?></div>
                <?php endif; ?>

                <?php if ($show_observacoes): ?>
                    <h3>Observações</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Observação</th>
                            <th>Data</th>
                        </tr>
                        <?php while ($row = $observacoes_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['ID']); ?></td>
                                <td><?php echo htmlspecialchars($row['observacao']); ?></td>
                                <td><?php echo date("d/m/Y", strtotime(htmlspecialchars($row['data']))); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php endif; ?>
            </form>
        </div>
    </div>

    
    <div class="header text-center">
        <div class="back-arrow-container">
            <a href="javascript:history.back()" class="back-arrow">
                <img src="imagens botoes/de-volta (1).png" alt="Voltar" style="height: 40px;">
</body>
</html>
