document.addEventListener("DOMContentLoaded", function() {
    var menuToggle = document.getElementById("menu-toggle");
    var menuItems = document.getElementById("menu-items");

    menuToggle.addEventListener("click", function() {
        if (menuItems.style.display === "block") {
            menuItems.style.display = "none";
        } else {
            menuItems.style.display = "block";
        }
    });

    var chatButton = document.getElementById("chat-button");
    var chatContainer = document.getElementById("chat-container");

    chatButton.addEventListener("click", function() {
        chatContainer.classList.toggle("active");

        // Limpar a caixa de chat e o campo de entrada se o chat for fechado
        if (!chatContainer.classList.contains("active")) {
            var chatBox = document.getElementById("chat-box");
            var userInput = document.getElementById("user-input");
            chatBox.innerHTML = "";  // Limpar a caixa de chat
            userInput.value = "";    // Limpar o campo de entrada
        }
    });

    var userInput = document.getElementById("user-input");

    userInput.addEventListener("keypress", function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
});
// fala dineng.js

document.getElementById('menu-toggle').addEventListener('click', function() {
    var menuItems = document.getElementById('menu-items');
    if (menuItems.style.display === 'block') {
        menuItems.style.display = 'none';
    } else {
        menuItems.style.display = 'block';
    }
});

function sendMessage() {
    var userInput = document.getElementById("user-input");
    var userMessage = userInput.value.trim();

    if (userMessage !== "") {
        appendUserMessage(userMessage);
        respondToUser(userMessage);
        userInput.value = "";
    }
}

function appendUserMessage(message) {
    var chatBox = document.getElementById("chat-box");
    var userMessageElement = document.createElement("div");
    userMessageElement.className = "chat-message user";
    userMessageElement.textContent = message;
    chatBox.appendChild(userMessageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function respondToUser(message) {
    var chatBox = document.getElementById("chat-box");
    var botResponseElement = document.createElement("div");
    botResponseElement.className = "chat-message bot";
    var response = getBotResponse(message);
    botResponseElement.textContent = response;
    chatBox.appendChild(botResponseElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function getBotResponse(message) {
    message = message.toLowerCase();
    var response = "";

    if (message.includes("o que é uma manifestação")) {
        response = "Uma manifestação é um registro feito por um cidadão para expressar suas opiniões, denúncias, sugestões, solicitações ou elogios sobre serviços públicos.";
    } else if (message.includes("quais são os tipos de manifestação")) {
        response = "Os tipos de manifestação incluem denúncia, solicitação, sugestão, elogio e reclamação.";
    } else if (message.includes("quem pode se manifestar")) {
        response = "Qualquer cidadão pode se manifestar.";
    } else if (message.includes("como posso fazer uma manifestação")) {
        response = "Você pode fazer uma manifestação acessando a página de Ouvidoria no nosso site.";
    } else if (message.includes("o que é o sistema de ouvidoria")) {
        response = "O sistema de Ouvidoria é uma plataforma que permite ao cidadão registrar suas manifestações sobre serviços públicos.";
    } else if (message.includes("como acompanhar o andamento da minha manifestação")) {
        response = "Você pode acompanhar o andamento da sua manifestação acessando a seção de acompanhamento no nosso site.";
    } else if (message.includes("é possível alterar minha manifestação depois que foi enviada")) {
        response = "Não, não é possível alterar uma manifestação depois que foi enviada. Você pode registrar uma nova manifestação se necessário.";
    } else if (message.includes("posso incluir anexos na manifestação")) {
        response = "Sim, é possível incluir anexos na sua manifestação.";
    } else if (message.includes("é necessário me identificar para fazer uma manifestação")) {
        response = "Não é necessário se identificar para fazer uma manifestação, mas fornecendo seus dados você facilita o acompanhamento da sua manifestação.";
    } else if (message.includes("quais as garantias de proteção à minha identidade")) {
        response = "Sua identidade será protegida e mantida em sigilo conforme a legislação vigente.";
    } else if (message.includes("o que acontece com minha manifestação após o registro")) {
        response = "Após o registro, sua manifestação será analisada e encaminhada ao setor responsável para providências.";
    } else if (message.includes("qual o prazo para receber a resposta")) {
        response = "O prazo para receber a resposta pode variar conforme a complexidade da manifestação, mas nos empenhamos em responder o mais breve possível.";
    } else if (message.includes("como posso consultar o andamento da minha manifestação")) {
        response = "Você pode consultar o andamento da sua manifestação acessando a seção de acompanhamento no nosso site.";
    } else if (message.includes("posso alterar uma manifestação já enviada")) {
        response = "Não, não é possível alterar uma manifestação já enviada. Você pode registrar uma nova manifestação se necessário.";
    } else if (message.includes("posso fazer várias denúncias em uma só manifestação")) {
        response = "Não, cada denúncia deve ser registrada separadamente para facilitar o tratamento de cada caso.";
    } else if (message.includes("existe proteção para servidores que fazem denúncias")) {
        response = "Sim, existe proteção para servidores que fazem denúncias, garantindo o sigilo e a proteção contra retaliações.";
    } else if (message.includes("onde posso encontrar dados estatísticos sobre ouvidorias")) {
        response = "Você pode encontrar dados estatísticos sobre ouvidorias na seção de relatórios no nosso site.";
    } else if (message.includes("quem gere e mantém o sistema")) {
        response = "O sistema é gerido e mantido pela equipe técnica da nossa organização.";
    } else if (message.includes("onde o sistema é hospedado")) {
        response = "O sistema é hospedado em servidores seguros e confiáveis, garantindo a disponibilidade e a segurança das informações.";
    } else if (message.includes("o sistema tem algum custo")) {
        response = "Não, o uso do sistema de Ouvidoria é gratuito para os cidadãos.";
    } else if (message.includes("como aderir ao sistema")) {
        response = "Para aderir ao sistema, entre em contato com nossa equipe através dos canais de atendimento disponíveis no site.";
    } else if (message.includes("existe ambiente de treinamento para aprender a usar o sistema")) {
        response = "Sim, oferecemos um ambiente de treinamento para que você possa aprender a usar o sistema.";
    } else if (message.includes("como obter acesso aos ambientes de treinamento e produção")) {
        response = "Para obter acesso aos ambientes de treinamento e produção, entre em contato com nossa equipe de suporte técnico.";
    } else if (message.includes("o que é a ouvidoria interna")) {
        response = "A Ouvidoria Interna é um canal exclusivo para servidores fazerem manifestações sobre assuntos internos.";
    } else if (message.includes("quais manifestações posso fazer na ouvidoria interna")) {
        response = "Na Ouvidoria Interna, você pode fazer denúncias, solicitações, sugestões e reclamações sobre assuntos internos.";
    } else if (message.includes("como obter suporte técnico")) {
        response = "Para obter suporte técnico, entre em contato conosco através dos canais de atendimento disponíveis no site.";
    } else if (message.includes("horário de atendimento do suporte técnico")) {
        response = "Nosso suporte técnico está disponível de segunda a sexta-feira, das 9h às 18h.";
    } else {
        response = "Desculpe, não entendi. Por favor, reformule sua pergunta ou consulte a seção de Perguntas Frequentes.";
    }

    return response;
}
