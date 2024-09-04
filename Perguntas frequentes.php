<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'cabeçario.html'; ?>
    <title>Ouvidoria Dineng - Perguntas Frequentes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header.dineng1 {
            background-color: #005a8b;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header.dineng1 h1 {
            margin: 0;
            font-size: 2rem;
        }

        main.main {
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .questions-container,
        .answers-container {
            margin-bottom: 20px;
        }

        .questions-container h2,
        .answers-container h2 {
            font-size: 1.5rem;
            color: #005a8b;
            margin-bottom: 10px;
        }

        .questions-container ul,
        .answers-container ul {
            list-style: none;
            padding: 0;
        }

        .questions-container ul li,
        .answers-container ul li {
            margin-bottom: 10px;
        }

        .questions-container ul li a {
            color: #005a8b;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .questions-container ul li a:hover {
            color: #003f5c;
        }

        .answers-container h3 {
            font-size: 1.3rem;
            color: #333;
            margin-top: 20px;
        }

        .answers-container p,
        .answers-container ul {
            margin: 10px 0;
        }

        .answers-container ul {
            list-style-type: disc;
            margin-left: 20px;
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
            margin: 20px 0;
        }

        .faq-box:hover {
            background-color: #003f5c;
        }

        footer {
            background-color: #005a8b;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: relative;
            width: 100%;
            bottom: 0;
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
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;
        }

        .chat-header {
            background-color: #005a8b;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-align: center;
        }

        .chat-messages {
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
        }

        .chat-input {
            padding: 10px;
            border-top: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .chat-input input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .chat-input button {
            background-color: #005a8b;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-input button:hover {
            background-color: #003f5c;
        }
    </style>
</head>
<body>
    <header class="dineng1">
        <h1>Perguntas Frequentes</h1>
    </header>

    <main class="main">
        <div class="container">
            <section class="questions-container">
                <h2>Perguntas</h2>
                <ul>
                    <li><a href="#q1">O que é uma manifestação?</a></li>
                    <li><a href="#q2">Quais são os tipos de manifestação?</a></li>
                    <li><a href="#q3">Quem pode se manifestar?</a></li>
                    <li><a href="#q4">Como posso fazer uma manifestação?</a></li>
                    <li><a href="#q5">O que é o sistema de Ouvidoria?</a></li>
                    <li><a href="#q6">Como acompanhar o andamento da minha manifestação?</a></li>
                    <li><a href="#q7">É possível alterar minha manifestação depois que foi enviada?</a></li>
                    <li><a href="#q8">Posso incluir anexos na manifestação?</a></li>
                    <li><a href="#q9">É necessário me identificar para fazer uma manifestação?</a></li>
                    <li><a href="#q10">Quais as garantias de proteção à minha identidade?</a></li>
                    <li><a href="#q11">O que acontece com minha manifestação após o registro?</a></li>
                    <li><a href="#q12">Qual o prazo para receber a resposta?</a></li>
                    <li><a href="#q13">Como posso consultar o andamento da minha manifestação?</a></li>
                    <li><a href="#q14">Posso alterar uma manifestação já enviada?</a></li>
                    <li><a href="#q15">Posso incluir anexos na minha manifestação?</a></li>
                    <li><a href="#q16">Posso fazer várias denúncias em uma só manifestação?</a></li>
                    <li><a href="#q17">Existe proteção para servidores que fazem denúncias?</a></li>
                    <li><a href="#q18">Onde posso encontrar dados estatísticos sobre ouvidorias?</a></li>
                    <li><a href="#q19">Quem gere e mantém o sistema?</a></li>
                    <li><a href="#q20">Onde o sistema é hospedado?</a></li>
                    <li><a href="#q21">O sistema tem algum custo?</a></li>
                    <li><a href="#q22">Como instalar o sistema?</a></li>
                    <li><a href="#q23">Como aderir ao sistema?</a></li>
                    <li><a href="#q24">Existe ambiente de treinamento para aprender a usar o sistema?</a></li>
                    <li><a href="#q25">Como obter acesso aos ambientes de treinamento e produção?</a></li>
                    <li><a href="#q26">O que é a Ouvidoria Interna?</a></li>
                    <li><a href="#q27">Quais manifestações posso fazer na Ouvidoria Interna?</a></li>
                    <li><a href="#q28">Como obter suporte técnico?</a></li>
                    <li><a href="#q29">Horário de atendimento do suporte técnico?</a></li>
                </ul>
            </section>

            <section class="answers-container">
                <h2>Respostas</h2>
                <div>
                    <h3 id="q1">O que é uma manifestação?</h3>
                    <p>Manifestação é a forma pela qual você pode expressar suas opiniões, dúvidas, reclamações, solicitações e elogios aos serviços públicos.</p>
                </div>
                <div>
                    <h3 id="q2">Quais são os tipos de manifestação?</h3>
                    <ul>
                        <li>Solicitação</li>
                        <li>Elogio</li>
                        <li>Sugestão</li>
                        <li>Reclamação</li>
                        <li>Denúncia</li>
                        <li>Pedido de Acesso à Informação</li>
                    </ul>
                </div>
                <div>
                    <h3 id="q3">Quem pode se manifestar?</h3>
                    <p>Qualquer cidadão ou servidor público pode se manifestar, desde que o faça de acordo com as normas e diretrizes estabelecidas.</p>
                </div>
                <div>
                    <h3 id="q4">Como posso fazer uma manifestação?</h3>
                    <p>Você pode fazer uma manifestação através do nosso site, telefone ou presencialmente em nossos escritórios.</p>
                </div>
                <div>
                    <h3 id="q5">O que é o sistema de Ouvidoria?</h3>
                    <p>O sistema de Ouvidoria é uma ferramenta que permite que cidadãos e servidores públicos possam registrar suas manifestações e acompanhar o andamento.</p>
                </div>
                <div>
                    <h3 id="q6">Como acompanhar o andamento da minha manifestação?</h3>
                    <p>Você pode acompanhar o andamento da sua manifestação acessando a área de acompanhamento em nosso site, usando o código de rastreamento fornecido.</p>
                </div>
                <div>
                    <h3 id="q7">É possível alterar minha manifestação depois que foi enviada?</h3>
                    <p>Sim, é possível alterar a manifestação após o envio, desde que seja dentro do prazo estabelecido e o sistema permita alterações.</p>
                </div>
                <div>
                    <h3 id="q8">Posso incluir anexos na manifestação?</h3>
                    <p>Sim, você pode incluir anexos ao fazer uma manifestação através do nosso sistema online.</p>
                </div>
                <div>
                    <h3 id="q9">É necessário me identificar para fazer uma manifestação?</h3>
                    <p>Não é necessário se identificar para fazer uma manifestação, você pode optar por permanecer anônimo.</p>
                </div>
                <div>
                    <h3 id="q10">Quais as garantias de proteção à minha identidade?</h3>
                    <p>Garantimos a proteção da sua identidade e a confidencialidade das suas informações, conforme nossa política de privacidade.</p>
                </div>
                <div>
                    <h3 id="q11">O que acontece com minha manifestação após o registro?</h3>
                    <p>Após o registro, sua manifestação é encaminhada ao setor responsável e é analisada conforme os procedimentos estabelecidos.</p>
                </div>
                <div>
                    <h3 id="q12">Qual o prazo para receber a resposta?</h3>
                    <p>O prazo para receber uma resposta varia de acordo com a natureza da manifestação, geralmente entre 15 e 30 dias úteis.</p>
                </div>
                <div>
                    <h3 id="q13">Como posso consultar o andamento da minha manifestação?</h3>
                    <p>Você pode consultar o andamento da sua manifestação através do nosso site, usando o código de rastreamento fornecido.</p>
                </div>
                <div>
                    <h3 id="q14">Posso alterar uma manifestação já enviada?</h3>
                    <p>Sim, você pode solicitar alterações na manifestação enviada, seguindo o procedimento específico do nosso sistema.</p>
                </div>
                <div>
                    <h3 id="q15">Posso incluir anexos na minha manifestação?</h3>
                    <p>Sim, anexos podem ser incluídos na manifestação, utilizando o recurso disponível em nosso site.</p>
                </div>
                <div>
                    <h3 id="q16">Posso fazer várias denúncias em uma só manifestação?</h3>
                    <p>Não, cada denúncia deve ser registrada separadamente para garantir um tratamento adequado.</p>
                </div>
                <div>
                    <h3 id="q17">Existe proteção para servidores que fazem denúncias?</h3>
                    <p>Sim, existem mecanismos de proteção para servidores que realizam denúncias, assegurando a confidencialidade e segurança.</p>
                </div>
                <div>
                    <h3 id="q18">Onde posso encontrar dados estatísticos sobre ouvidorias?</h3>
                    <p>Dados estatísticos podem ser encontrados em relatórios anuais disponíveis em nosso site.</p>
                </div>
                <div>
                    <h3 id="q19">Quem gere e mantém o sistema?</h3>
                    <p>O sistema é gerido e mantido pela equipe da Ouvidoria Dineng.</p>
                </div>
                <div>
                    <h3 id="q20">Onde o sistema é hospedado?</h3>
                    <p>O sistema é hospedado em servidores seguros, com alta disponibilidade e proteção de dados.</p>
                </div>
                <div>
                    <h3 id="q21">O sistema tem algum custo?</h3>
                    <p>Não há custo para o usuário final ao utilizar o sistema de Ouvidoria.</p>
                </div>
                <div>
                    <h3 id="q22">Como instalar o sistema?</h3>
                    <p>O sistema é disponibilizado como uma plataforma web, não sendo necessário instalar nada localmente.</p>
                </div>
                <div>
                    <h3 id="q23">Como aderir ao sistema?</h3>
                    <p>A adesão ao sistema é feita através de cadastro e procedimentos descritos em nosso portal.</p>
                </div>
                <div>
                    <h3 id="q24">Existe ambiente de treinamento para aprender a usar o sistema?</h3>
                    <p>Sim, oferecemos um ambiente de treinamento para que os usuários possam aprender a utilizar o sistema.</p>
                </div>
                <div>
                    <h3 id="q25">Como obter acesso aos ambientes de treinamento e produção?</h3>
                    <p>O acesso aos ambientes de treinamento e produção é fornecido após o cadastro e aprovação do usuário.</p>
                </div>
                <div>
                    <h3 id="q26">O que é a Ouvidoria Interna?</h3>
                    <p>A Ouvidoria Interna é um setor dedicado ao recebimento e gestão de manifestações internas dentro da organização.</p>
                </div>
                <div>
                    <h3 id="q27">Quais manifestações posso fazer na Ouvidoria Interna?</h3>
                    <p>Na Ouvidoria Interna, você pode fazer denúncias, reclamações, sugestões e solicitações relacionadas ao ambiente interno.</p>
                </div>
                <div>
                    <h3 id="q28">Como obter suporte técnico?</h3>
                    <p>O suporte técnico pode ser solicitado através do nosso portal ou pelo telefone de atendimento.</p>
                </div>
                <div>
                    <h3 id="q29">Horário de atendimento do suporte técnico?</h3>
                    <p>O suporte técnico está disponível de segunda a sexta-feira, das 8h às 18h.</p>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Ouvidoria Dineng. Todos os direitos reservados.</p>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
