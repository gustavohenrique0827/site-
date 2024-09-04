// Dados do chatbot com agrupamento e respostas específicas
const chatData = {
    "denúncias": {
        description: "Denúncias referem-se a registros formais para relatar irregularidades, má conduta ou práticas não conformes.",
        questions: {
            "quais são as denúncias": "Denúncias incluem fraudes, corrupção, assédio, violação de políticas e má conduta. São ações para relatar irregularidades e práticas não conformes.",
            "como fazer uma denúncia": "Para fazer uma denúncia, utilize o formulário disponível no nosso site ou entre em contato pelos canais de atendimento. A denúncia pode ser feita de forma anônima.",
            "proteção do denunciante": "A identidade do denunciante será protegida e todas as informações serão tratadas com total confidencialidade."
        }
    },
    "reclamações": {
        description: "Reclamações são registros para expressar insatisfações sobre serviços ou produtos.",
        questions: {
            "o que é uma reclamação": "Uma reclamação é um registro para expressar insatisfações ou problemas com serviços ou produtos recebidos.",
            "como registrar uma reclamação": "Você pode registrar uma reclamação através do formulário disponível em nosso site ou entrando em contato com nosso suporte ao cliente."
        }
    },
    "sugestões": {
        description: "Sugestões são propostas para melhorias ou novas ideias sobre serviços ou produtos.",
        questions: {
            "o que é uma sugestão": "Uma sugestão é uma proposta para melhorias ou novas ideias sobre serviços ou produtos.",
            "como enviar uma sugestão": "Envie sua sugestão através do formulário disponível no nosso site ou entre em contato com nossa equipe de atendimento."
        }
    },
    "manifestação": {
        description: "Manifestação é um termo geral que abrange denúncias, reclamações, sugestões e outras formas de feedback.",
        questions: {
            "o que é uma manifestação": "Uma manifestação é um registro para expressar opiniões, denúncias, sugestões, solicitações ou elogios sobre os serviços.",
            "como fazer uma manifestação": "Para fazer uma manifestação, use o formulário no nosso site ou entre em contato através dos nossos canais de atendimento."
        }
    },
    "ouvidoria": {
        description: "Ouvidoria é o canal dedicado para registrar e acompanhar manifestações sobre os serviços.",
        questions: {
            "o que é a ouvidoria": "A ouvidoria é um canal para registrar e acompanhar manifestações sobre os serviços, garantindo que todas as questões sejam devidamente tratadas.",
            "como acompanhar uma manifestação": "Acompanhe sua manifestação através do sistema de rastreamento online disponível em nosso site."
        }
    },
    "ouvidoria interna": {
        description: "Ouvidoria interna é um canal exclusivo para os funcionários registrarem suas manifestações.",
        questions: {
            "o que é a ouvidoria interna": "A ouvidoria interna é um canal exclusivo para funcionários registrarem manifestações relacionadas ao ambiente de trabalho.",
            "como fazer uma manifestação na ouvidoria interna": "As manifestações na ouvidoria interna seguem o mesmo processo das externas, mas são ajustadas para questões internas."
        }
    }
};

// Função para exibir o chat
function toggleChat() {
    const chatContainer = document.getElementById('chat-container');
    chatContainer.style.display = chatContainer.style.display === 'none' || chatContainer.style.display === '' ? 'flex' : 'none';
    if (chatContainer.style.display === 'flex') {
        showTopics();
    }
}

// Função para mostrar tópicos
function showTopics() {
    const chatBox = document.getElementById('chat-box');
    const topics = Object.keys(chatData);
    const topicButtons = topics.map(topic => `<button onclick="showTopicDetails('${topic}')">${topic}</button>`).join('<br>');
    chatBox.innerHTML = `<p>Escolha um tópico para ver mais detalhes:</p>${topicButtons}`;
}

// Função para mostrar detalhes do tópico
function showTopicDetails(topic) {
    const chatBox = document.getElementById('chat-box');
    const { description, questions } = chatData[topic];
    const questionLinks = Object.keys(questions).map(question => `<a href="#" onclick="showQuestionAnswer('${topic}', '${question}')">${question}</a>`).join('<br>');
    chatBox.innerHTML = `<p>${description}</p><p>Perguntas relacionadas:</p>${questionLinks}<br><a href="#" onclick="showTopics()">Voltar para os tópicos</a>`;
}

// Função para mostrar a resposta da pergunta
function showQuestionAnswer(topic, question) {
    const response = chatData[topic].questions[question] || "Desculpe, não tenho uma resposta para isso.";
    appendMessage(response, 'bot');
    appendMessage('<a href="#" onclick="showTopicDetails(\'' + topic + '\')">Voltar para o tópico</a>', 'bot');
}

// Função para enviar a mensagem do usuário
function sendMessage() {
    const input = document.getElementById('user-input');
    const message = input.value.trim();

    if (message) {
        appendMessage(message, 'user');
        const response = getResponse(message);
        appendMessage(response, 'bot');
        input.value = '';
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }
}

// Função para adicionar uma mensagem ao chat
function appendMessage(message, type) {
    const chatBox = document.getElementById('chat-box');
    const chatMessage = document.createElement('div');
    chatMessage.className = `chat-message ${type}`;
    chatMessage.innerHTML = message;
    chatBox.appendChild(chatMessage);
}

// Função para obter a resposta do chatbot com base na mensagem do usuário
function getResponse(userMessage) {
    const lowerCaseMessage = userMessage.toLowerCase();
    const topics = Object.keys(chatData);

    // Verifica se a mensagem é um tópico
    for (const topic of topics) {
        if (lowerCaseMessage.includes(topic)) {
            return getTopicDescription(topic);
        }
    }

    // Verifica se a mensagem corresponde a uma pergunta específica dentro dos tópicos
    for (const topic of topics) {
        const questions = chatData[topic].questions;
        for (const question in questions) {
            if (lowerCaseMessage.includes(question.toLowerCase())) {
                return questions[question];
            }
        }
    }

    return "Desculpe, não entendi. Pode repetir a pergunta ou digitar algo diferente.";
}

// Função para exibir a descrição do tópico e links para perguntas relacionadas
function getTopicDescription(topic) {
    const { description, questions } = chatData[topic];
    return `<p>${description}</p>
            <p>Perguntas relacionadas:</p>
            ${Object.keys(questions).map(question => `<a href="#" onclick="showQuestionAnswer('${topic}', '${question}')">${question}</a>`).join('<br>')}
            <br><a href="#" onclick="showTopics()">Voltar para os tópicos</a>`;
}

// Adiciona evento de tecla Enter para enviar mensagem
document.getElementById('user-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});
