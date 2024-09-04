<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php include 'cabeçario.html'; ?>
    <title>Reclamações Internas - Dineng Ouvidoria</title>
    <link rel="stylesheet" href="ouvidoria_interna.css">
    <script src="chat.js" defer></script> 
    <script src="reclamacao.js"></script>
    <style>
        .dropdown-menu {
            background-color: #005a8b; /* Cor de fundo do dropdown */
        }

        .dropdown-item {
            color: #ffffff; /* Cor do texto dos links */
        }

        .dropdown-item:hover {
            background-color: #003f5c; /* Cor de fundo ao passar o mouse sobre o link */
        }

        /* Estilo da caixa FAQ */
        .faq-box {
            background-color: #005a8b;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 1.1rem;
            box-sizing: border-box;
            border: 7px solid transparent;
            text-decoration: none;
            display: inline-block;
            border-radius: 80px;
            transition: background-color 0.3s ease;
            margin: 20px -37px;
        }

        .faq-box:hover {
            background-color: #003f5c;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
            justify-content: space-evenly;
        }

        /* Estilos do chatbot */
        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 1000;
        }

        .chat-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            height: 400px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            display: none;
            flex-direction: column;
            z-index: 1000;
        }

        .chat-box {
            padding: 10px;
            height: 85%;
            overflow-y: auto;
            border-bottom: 1px solid #ddd;
            display: flex;
            flex-direction: column;
        }

        .input-container {
            display: flex;
            border-top: 1px solid #ddd;
        }

        .input-container input {
            flex: 1;
            border: none;
            padding: 10px;
            border-radius: 0;
        }

        .input-container button {
            border: none;
            background-color: #005a8b;
            color: #fff;
            padding: 10px;
            cursor: pointer;
        }

        .input-container button:hover {
            background-color: #003f5c;
        }

        .chat-message {
            margin-bottom: 10px;
        }

        .chat-message.user {
            align-self: flex-end;
            background-color: #e1ffc7;
            padding: 8px;
            border-radius: 10px;
        }

        .chat-message.bot {
            align-self: flex-start;
            background-color: #f1f1f1;
            padding: 8px;
            border-radius: 10px;
        }
        .dineng1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <h1 class="dineng1">Reclamações Internas</h1>

    <!-- Navegação -->

    <!-- Contêiner Principal -->
    <div class="main flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="content mx-auto p-4 bg-light rounded text-center" style="width: 300px; height: 300px;">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "conexao.php";

            // Verifica a conexão com o banco de dados
            if (!$conn) {
                die("Conexão falhou: " . mysqli_connect_error());
            }

            // Sanitização e validação dos dados
            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $reclamacao = trim($_POST['Reclamacao_interna']);
            $anonimo = isset($_POST['anonimo']) && $_POST['anonimo'] === "sim" ? true : false;
            $datareclamacao = date('Y-m-d H:i:s');

            // Configura anonimato
            if ($anonimo) {
                $nome = 'Anônimo';
                $email = 'anonimo@anonimo.com'; // E-mail padrão para anonimato
            }

            // Preparar o diretório para o upload
            $user_folder = "arquivos/" . $nome;
            if (!file_exists($user_folder)) {
                if (!mkdir($user_folder, 0777, true)) {
                    die("Erro ao criar diretório: " . error_get_last()['message']);
                }
            }

            // Configura o upload do arquivo
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

                $arquivo_nome = $nome . "_Reclamação_" . pathinfo($arquivo['name'], PATHINFO_EXTENSION);
                $arquivo_destino = $user_folder . "/" . $arquivo_nome;

                // Move o arquivo para o diretório de destino
                if (move_uploaded_file($arquivo['tmp_name'], $arquivo_destino)) {
                    $link_arquivo = $arquivo_destino;
                } else {
                    die("Erro ao mover o arquivo.");
                }
            }

            // Gerar código de reclamação
            $Cod_Reclamacao = strtoupper(substr(md5(uniqid()), 0, 2) . rand(100000, 999999));
            $status_reclamacao_interna= "Recebida";

            // Descrição do status
            $descricao = array(
                "Recebida" => "Reclamação recebida ao órgão competente para análise.",
                "Em análise" => "Reclamação em análise pelo órgão competente.",
                "Em processo" => "Reclamação em processo de investigação.",
                "Concluída" => "Reclamação concluída e resolvida.",
                "Arquivada" => "Reclamação arquivada por falta de provas ou por não ter sido possível identificar o autor."
            );
            $descricao_status = isset($descricao[$status_reclamacao_interna]) ? $descricao[$status_reclamacao_interna] : '';

            // Inserir reclamação no banco de dados com consulta preparada
            if ($stmt = $conn->prepare("INSERT INTO `reclamacoes internas` (nome, email, Reclamacao_interna, arquivo_nome4, Cod_Reclamacao, status_reclamacao_interna, descricao, datareclamacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
                if ($link_arquivo) {
                    $stmt->bind_param("ssssssss", $nome, $email, $reclamacao, $link_arquivo, $Cod_Reclamacao, $status_reclamacao_interna, $descricao_status, $datareclamacao);
                } else {
                    $stmt->bind_param("sssssss", $nome, $email, $reclamacao, $Cod_Reclamacao, $status_reclamacao_interna, $descricao_status, $datareclamacao);
                }

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Reclamação interna enviada com sucesso! Seu código de rastreamento é: <strong>$Cod_Reclamacao</strong></div>";
                } else {
                    echo "<div class='alert alert-danger'>Erro ao enviar Reclamação Interna: " . $stmt->error . "</div>";
                }

                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Erro na preparação da consulta: " . $conn->error . "</div>";
            }

            mysqli_close($conn);
        }
        ?>
        </div>
    </div>

    <!-- Rodapé -->
    <div class="footer text-center mt-auto py-3">
        <img src="imagens_botoes/Dineng_Logo_02.png" alt="Logo" style="height: 20px;">
        <p>&copy; 2024 Dineng Ouvidoria. Todos os direitos reservados.</p>
    </div>

    <!-- Botão do Chat -->
    <div class="chat-button" onclick="toggleChat()">
        <img src="imagens_botoes/chat-button.png" alt="Chat" style="height: 60px;">
    </div>

    <!-- Container do Chat -->
    <div class="chat-container">
        <div class="chat-box" id="chat-box">
            <!-- Mensagens do chat serão carregadas aqui -->
        </div>
        <div class="input-container">
            <input type="text" id="chat-input" placeholder="Digite sua mensagem..." />
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <script>
        function toggleChat() {
            var chatContainer = document.querySelector('.chat-container');
            chatContainer.style.display = chatContainer.style.display === 'none' || chatContainer.style.display === '' ? 'flex' : 'none';
        }

        function sendMessage() {
            var chatInput = document.getElementById('chat-input');
            var chatBox = document.getElementById('chat-box');

            if (chatInput.value.trim() === '') {
                return;
            }

            var userMessage = document.createElement('div');
            userMessage.className = 'chat-message user';
            userMessage.textContent = chatInput.value;
            chatBox.appendChild(userMessage);

            // Simular resposta do bot
            var botResponse = document.createElement('div');
            botResponse.className = 'chat-message bot';
            botResponse.textContent = 'Obrigado pela sua mensagem. Em breve responderemos.';
            chatBox.appendChild(botResponse);

            chatInput.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    </script>
</body>
</html>
