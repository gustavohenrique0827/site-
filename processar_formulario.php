<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <?php include 'cabeçario.html'; ?>
    <title>Ouvidoria - Dineng</title>
    <link rel="stylesheet" href="ouvidoria_interna.css">
    <link rel="stylesheet" href="cabeçario.css">
    <script src="chat.js" defer></script>
    <script src="denuncia.js"></script>
    <style>
        /* Estilos customizados aqui */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
     .h1,h1{
    text-align: center;
     }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <h1 class="dineng1">Ouvidoria Dineng</h1>

    <!-- Contêiner Principal -->
    <div class="main flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="content mx-auto p-4 bg-light rounded text-center" style="width: 300px; height: auto;">
        <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Inclua o autoload do Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "conexao.php";
    mysqli_set_charset($conn, "utf8");

    // Verifica a conexão com o banco de dados
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Recebe os dados do formulário
    $anonimo = isset($_POST['anonimo']) && $_POST['anonimo'] === "sim";
    $nome = $anonimo ? 'Anônimo' : (isset($_POST['nome']) ? trim($_POST['nome']) : '');
    $email = $anonimo ? 'anonimo@anonimo.com' : (isset($_POST['email']) ? trim($_POST['email']) : '');
    $tipo_servico = isset($_POST['tipo-servico']) ? trim($_POST['tipo-servico']) : '';
    $conteudo = isset($_POST['conteudo']) ? trim($_POST['conteudo']) : '';
    $tipo_ouvidoria = isset($_POST['tipo-ouvidoria']) ? trim($_POST['tipo-ouvidoria']) : '';
    $data_registro = date('Y-m-d H:i:s');

    // Preparar o diretório para o upload
    $user_folder = "arquivos/" . $nome;
    if (!file_exists($user_folder)) {
        if (!mkdir($user_folder, 0777, true)) {
            die("Erro ao criar diretório: " . error_get_last()['message']);
        }
    }

    // Configura o upload do arquivo (opcional)
    $link_arquivo = null;
    if (!empty($_FILES['arquivo']['name'])) {
        $arquivo = $_FILES['arquivo'];
        $tamanhoMaximo = 2 * 1024 * 1024; // 2 MB

        // Valida o tamanho do arquivo
        if ($arquivo['size'] > $tamanhoMaximo) {
            die("O arquivo deve ter no máximo 2 MB.");
        }

        // Verifica se há erros durante o upload
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            die("Erro ao enviar o arquivo.");
        }

        $arquivo_nome = $nome . "_{$tipo_servico}_" . pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $arquivo_destino = $user_folder . "/" . $arquivo_nome;

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($arquivo['tmp_name'], $arquivo_destino)) {
            $link_arquivo = $arquivo_destino;
        } else {
            die("Erro ao mover o arquivo.");
        }
    }

    // Gerar código único para cada tipo de manifestação
    $codigo_manifestacao = strtoupper(substr(md5(uniqid()), 0, 2) . rand(100000, 999999));
    $status = "Recebida";

    // Descrição do status
    $descricao = array(
        "Recebida" => "Recebida ao órgão competente para análise.",
        "Em análise" => "Em análise pelo órgão competente.",
        "Em processo" => "Em processo de investigação.",
        "Concluída" => "Concluída e resolvida.",
        "Arquivada" => "Arquivada por falta de provas ou por não ter sido possível identificar o autor."
    );
    $descricao_status = isset($descricao[$status]) ? $descricao[$status] : '';

    // Preparar a consulta SQL
    $sql = "INSERT INTO `Ouvidoria_registros` (`nome`, `email`, `tipo_servico`, `conteudo`, `arquivo_nome`, `codigo`, `status`, `descricao_status`, `data_registro`, `tipo_ouvidoria`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssss", $nome, $email, $tipo_servico, $conteudo, $link_arquivo, $codigo_manifestacao, $status, $descricao_status, $data_registro, $tipo_ouvidoria);

        // Executar a consulta
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>{$tipo_servico} enviada com sucesso! Seu código de rastreamento é: <strong>$codigo_manifestacao</strong></div>";

            // Configurar o PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtps.uhserver.com'; // Substitua pelo servidor SMTP correto
                $mail->SMTPAuth = true;
                $mail->Username = 'ouvidoria@dineng.com.br'; // Substitua pelo seu usuário SMTP
                $mail->Password = 'Dineng@123'; // Substitua pela sua senha SMTP
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465; // Porta SMTP
                
                // Configurar charset do PHPMailer
                $mail->CharSet = 'UTF-8';

                // Remetente e destinatário
                $mail->setFrom('ouvidoria@dineng.com.br', 'Ouvidoria Dineng');

                if (!$anonimo) {
                    // Enviar e-mail de confirmação para o usuário
                    $mail->addAddress($email); // E-mail do usuário
                    $mail->Subject = 'Confirmação de Recebimento - Ouvidoria Dineng';
                    $mail->Body    = "Sua manifestação foi recebida com sucesso! <br> Código de rastreamento: <strong>$codigo_manifestacao</strong><br> Status: $status<br>Descrição: $descricao_status";
                    $mail->AltBody = "Sua manifestação foi recebida com sucesso! Código de rastreamento: $codigo_manifestacao. Status: $status. Descrição: $descricao_status";
                } 

                // Enviar e-mail de notificação para o administrador
                $mail->clearAddresses(); // Limpar destinatários anteriores
                $mail->addAddress('comiteouvidoria@dineng.com.br'); // E-mail do administrador
                $mail->Subject = 'Nova Manifestação Recebida - Ouvidoria Dineng';
                $mail->Body    = "Uma nova manifestação foi recebida! <br> Código de rastreamento: <strong>$codigo_manifestacao</strong><br> Nome: $nome<br> E-mail: $email<br> Tipo de Serviço: $tipo_servico <br> Tipo_ouvidoria:$tipo_ouvidoria<br> Conteúdo: $conteudo";
                $mail->AltBody = "Uma nova manifestação foi recebida! Código de rastreamento: $codigo_manifestacao. Nome: $nome. E-mail: $email. Tipo de Serviço: $tipo_servico.Tipo_ouvidoria:$tipo_ouvidoria Conteúdo: $conteudo";

                $mail->send();
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>Erro ao enviar e-mail: {$mail->ErrorInfo}</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Erro ao enviar {$tipo_servico}: " . $stmt->error . "</div>";
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Fechar a conexão
    mysqli_close($conn);
}
?>
        </div>
    </div>

    <!-- Rodapé -->
</body>
</html>
