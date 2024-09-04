<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'cabeçario.html'?>
    
    <title>Quem Somos - Dineng Engenharia</title>
  
    <link rel="stylesheet" href="ouvidoria interna.css">
    <link rel="stylesheet" href="chat.css">
    <script src="chat.js" defer></script>
  
    <script src="fala dineng.js" defer></script>
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
    
        .dineng1{
            text-align: center;
        }
        .ceo-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .ceo-container h2 {
            margin-bottom: 1rem;
        }
        .ceo-container p {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    
        <h1 class="dineng1">Dineng Engenharia</h1>
            </div>
        </nav>
    </header>

    <!-- Seção "Quem Somos" -->
    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Nossa História</h2>
                <p>A DINENG está desde 1999 desenvolvendo projetos e construções de redes elétricas no estado do Tocantins e região norte do país.
Cada membro da nossa equipe é um elo vital na cadeia de inovação e técnica, e é com orgulho que destacamos a dedicação que eles trazem para cada projeto.
Nossos técnicos especializados são treinados nas mais recentes tecnologias e práticas da indústria, garantindo que cada projeto, manutenção ou reparo seja conduzido com precisão e eficácia.
Descubra o poder da engenharia elétrica conosco, onde o amanhã é alimentado pela nossa dedicação hoje.
Energizando o Futuro, Conectando Possibilidades.</p>
                <p>Nossa trajetória é marcada por projetos de grande impacto, realizados por uma equipe altamente qualificada e dedicada. Através da inovação contínua e do respeito aos valores éticos, consolidamos nossa posição como uma das principais empresas de engenharia do país.</p>
                <a href="nossa historia.php" class="btn btn-primary mt-3">Saiba mais</a>
            </div>
            <div class="col-md-6">
                <img src="imagens/nossa-historia.jpg" alt="Nossa História" class="img-fluid rounded">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 order-md-2">
                <h2>Missão, Visão e Valores</h2>
                <p><strong>Missão:</strong> Proporcionar soluções de engenharia que agreguem valor e sustentabilidade, atendendo às necessidades dos nossos clientes com excelência.</p>
                <p><strong>Visão:</strong> Ser reconhecida como uma empresa líder no setor de engenharia, comprometida com a inovação e a responsabilidade socioambiental.</p>
                <p><strong>Valores:</strong> Integridade, Excelência, Sustentabilidade, Inovação, Compromisso com o cliente.</p>
            </div>
            <div class="col-md-6 order-md-1">
                <img src="imagens/missao-visao-valores.jpg" alt="Missão, Visão e Valores" class="img-fluid rounded">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="ceo-container">
                    <h2>PALAVRA DO CEO</h2>
                    <p>
                        Na DINENG, nossa correnteza é formada pelos valores que nos guiam e nos impulsionam a cada dia. Somos movidos pelo compromisso com a excelência, navegando sempre com integridade e ética como nossa bússola.
                        Somos os melhores em projetar e executar construções de redes elétricas de grande porte! Nós te oferecemos o melhor, desde o primeiro contato até o momento da conclusão, com segurança e compromisso!
                        <br><br>
                        Siron Vieira de Oliveira
                        <br>
                        CEO DINENG
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <img src="imagens botoes/business-newsletter-1-730x1024.jpg" alt="Prêmios e Reconhecimentos" class="img-fluid rounded" style="height: 500px;">
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="footer text-center py-3 text-white">
        <img src="imagens botoes/Dineng_Logo_02.png" alt="Logo" style="height: 20px;">
        &copy; 2024 Dineng Engenharia. Todos os direitos reservados.
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
