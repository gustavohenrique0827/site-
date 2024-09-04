<!DOCTYPE html>
<html lang="pt-BR">
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fala Dineng</title>
    <link rel="stylesheet" href="ouvidoria interna.css">
    <link rel="stylesheet" href="index.css">
    <?php include  'cabeçario.html';
    ?>
    <script src="chat.js" defer></script> <!-- Referência para o arquivo JavaScript externo -->
    <style>
        /* Estilo personalizado para o dropdown */
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
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    
        <h1 class="dineng1"></h1>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              
               
            </div>
        </nav>
    </header>

    <!-- Caixa de Mensagem Principal -->
    <div class="container my-4">
        <div class="menu-box text-center">
            <h4>O QUE VOCÊ QUER FAZER?</h4>
            <p>Ajude a aprimorar os nossos serviços por meio de reclamações,<br>ou sugestões, ou ainda, registre uma denúncia.</p>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="subtitle text-center">
                    <a href="ouvidoria.php">
                        <div class="subtitle-content">
                            <img src="imagens botoes/ouvidoria-removebg-preview.png" alt="Solicitações Imagem" class="subtitle-img img-fluid">
                            <h3>Ouvidoria Externa</h3>
                        </div>
                    </a>
                    <p><br>Ajude a aprimorar os serviços da Dineng Engenharia, por meio de reclamações, sugestões, ou ainda, <br>
                    registre uma denúncia.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="subtitle text-center">
                    <a href="ouvidoria interna.php">
                        <div class="subtitle-content">
                            <img src="imagens botoes/ouvidoria_interna-removebg-preview.png" alt="Reclamações Imagem" class="subtitle-img img-fluid">
                            <h3>Ouvidoria Interna</h3>
                        </div>
                    </a>
                    <p><br>Canal destinado a servidores e trabalhadores da Dineng Engenharia para registro de manifestações.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="subtitle text-center">
                    <a href="Perguntas frequentes.php">
                        <div class="subtitle-content">
                            <img src="imagens botoes/perguntas frequentes.png" alt="Denúncias Imagem" class="subtitle-img img-fluid">
                            <h3>Dúvidas Frequentes</h3>
                        </div>
                    </a>
                    <p><br>Comunique uma irregularidade, um ato ilícito ou uma violação de direitos na administração da Dineng Engenharia.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="footer text-center py-2 text-white">
        <img src="imagens botoes/Dineng_Logo_02.png" alt="Logo" style="height: 20px;">
        &copy; 2024 Dineng Ouvidoria. Todos os direitos reservados.
    </footer>

    <!-- Botão de Chat -->
    <div class="chat-button" id="chat-button" onclick="toggleChat()">
        <img src="imagens botoes/chat-bot.png" alt="Chat Icon" class="img-fluid">
    </div>

    <!-- Container do Chatbot -->
    <div class="chat-container" id="chat-container">
        <div id="chat-box" class="chat-box"></div>
        <div class="input-container">
            <input type="text" id="user-input" placeholder="Digite sua pergunta...">
            <button type="button" onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <script>
        // Função para alternar a exibição do chatbot
        function toggleChat() {
            const chatContainer = document.getElementById('chat-container');
            chatContainer.style.display = chatContainer.style.display === 'none' || chatContainer.style.display === '' ? 'block' : 'none';
        }

        // Função para enviar mensagens no chatbot
        function sendMessage() {
            const input = document.getElementById('user-input');
            const chatBox = document.getElementById('chat-box');
            if (input.value.trim()) {
                const message = document.createElement('div');
                message.textContent = input.value;
                message.classList.add('chat-message', 'user');
                chatBox.appendChild(message);
                input.value = '';
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }
    </script>
</body>
</html>
