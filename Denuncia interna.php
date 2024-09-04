<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'cabeçario.html'; ?>
    <?php include "formulario.html"?>
    <title>Denúncias - Dineng Ouvidoria</title>
    
    <link rel="stylesheet" href="ouvidoria_interna.css">
    <script src="chat.js" defer></script> 
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

        .hidden {
            display: none;
        }
    </style>
</head>

            </div>
        </div>
    </div>
    <footer class="footer text-center mt-4">
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
        document.getElementById('denuncia-form').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('arquivo');
            const file = fileInput.files[0];
            if (file && file.size > 2 * 1024 * 1024) { // 2 MB
                alert('O arquivo deve ter no máximo 2 MB.');
                fileInput.value = ''; // Limpa o campo de arquivo
                event.preventDefault(); // Impede o envio do formulário
            }
        });

        function toggleChat() {
            const chatContainer = document.getElementById('chat-container');
            chatContainer.style.display = chatContainer.style.display === 'none' || chatContainer.style.display === '' ? 'flex' : 'none';
        }

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

        function toggleAnonimo(isAnonimo) {
            const anonimoCampos = document.getElementById('anonimo-campos');
            if (isAnonimo) {
                anonimoCampos.classList.add('hidden');
            } else {
                anonimoCampos.classList.remove('hidden');
            }
        }


        function customizeForm() {
    const pageTitle = document.getElementById('page-title');
    const formTitle = document.getElementById('form-title');
    const mensagemLabel = document.getElementById('mensagem-label');

    const url = window.location.href;
    console.log('URL atual:', url); // Adiciona este log para verificar a URL

    }  if (url.includes('Denuncia interna.php')) {  // Remova espaços dos nomes de arquivos
        pageTitle.textContent = 'Denúncia Interna';
        formTitle.textContent = 'Envie sua Denúncia';
        mensagemLabel.textContent = 'Denúncia:';
   
    }

// Chama a função para personalizar o formulário ao carregar a página
window.onload = customizeForm;



    </script>
</body>
</html>

