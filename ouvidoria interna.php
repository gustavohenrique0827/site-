<!DOCTYPE html>
<html lang="pt-BR">
    <link rel="stylesheet" href="ouvidoria interna.css">
    <script src="chat.js" defer></script> <!-- Referência para o arquivo JavaScript externo -->
<body>
<?php include 'cabeçario.html' 
    ?>
<style></style>

        <h1 class="dineng1"><br>OUVIDORIA INTERNA</h1>
        


    <!-- Caixa de Mensagem Principal -->
    <div class="container my-4">
        <div class="menu-box text-center ">
            <h4>O QUE VOCÊ QUER FAZER?</h4>
            <p>Ajude a aprimorar os nossos serviços por meio de reclamações,<br>ou sugestões, ou ainda, registre uma denúncia.</p>
        </div>
    </div>

    <!-- Botão de Voltar -->

            
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6 col-lg- mb-6">
                <div class="subtitle text-center">
                    <a href="rastreamento.php">
                        <div class="subtitle-content">
                            <img src="imagens botoes/solicitaçao-removebg-preview.png" alt="Solicitações Imagem" class="subtitle-img img-fluid">
                            <h3>Solicitações</h3>
                        </div>
                    </a>
                    <p><br>Solicite a adoção de providências por parte de uma Ouvidoria.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg- mb-6">
                <div class="subtitle text-center">
                    <a href="reclamacoes interna.php">
                        <div class="subtitle-content">
                            <img src="imagens botoes/reclamaçoes-removebg-preview.png" alt="Reclamações Imagem" class="subtitle-img img-fluid">
                            <h3>Reclamações</h3>
                        </div>
                    </a>
                    <p><br>Manifeste sua insatisfação com o serviço da Dineng.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg- mb-6">
                <div class="subtitle  text-center">
                    <a href="Denuncia interna.php">
                        <div class="subtitle-content">
                            <img src="imagens botoes/denuncia-removebg-preview.png" alt="Denúncias Imagem" class="subtitle-img img-fluid">
                            <h3>Denúncias</h3>
                        </div>
                    </a>
                    <p>Comunique uma irregularidade, um ato ilícito ou uma violação de direitos na administração da Dineng Engenharia.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg- mb-6">
                <div class="subtitle  text-center">
                    <a href="sugestoes internas.php">
                        <div class="subtitle-content">
                            <img src="imagens botoes/sugestao-removebg-preview.png" alt="Sugestões Imagem" class="subtitle-img img-fluid">
                            <h3>Sugestões</h3>
                        </div>
                    </a>
                    <p><br>Envie uma ideia ou proposta de melhoria para os serviços da Dineng Engenharia.</p>
                </div>
            </div>
        </div>

        <!-- Link para Perguntas Frequentes -->
        <div class="container mt-4 mb-5">
            <a href="Perguntas frequentes.php" class="faq-box">Perguntas Frequentes</a>
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
</body>
</html>
<script>
    function toggleChat() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.style.display = chatContainer.style.display === 'none' || chatContainer.style.display === '' ? 'block' : 'none';
    }

    function sendMessage() {
        const input = document.getElementById('user-input');
        const chatBox = document.getElementById('chat-box');
        if (input.value.trim()) {
            const message = document.createElement('div');
            message.textContent = input.value;
            chatBox.appendChild(message);
            input.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }
</script>
<style>
.faq-box {
    background-color: #005a8b;
    color: #ffffff;
    padding: 10px;
    text-align: center;
    font-size: 1.1rem;
    box-sizing: initial;
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
.h1,h1{
text-align: center;
}
</style>