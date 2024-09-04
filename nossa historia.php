<?php 
include "cabeçario.html";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossa História</title>
    <style>
        /* Definir altura mínima para o corpo e garantir que o rodapé não seja sobreposto */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Garantir que a seção principal ocupe o espaço restante disponível */
        .container {
            flex: 5;
            padding: 0px 0px; /* Margem lateral para evitar que o texto toque nas bordas */
            padding-bottom: 110px; /* Ajuste conforme a altura do rodapé */
        }

        /* Estilo básico para imagens e conteúdo */
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        
        .rounded {
            border-radius: 0.5rem;
        }

        /* Adiciona margens ao texto para afastar do rodapé e melhorar o espaçamento */
        h2 {
            margin-bottom: 10px;
        }

        p {
    margin: -3px;
    line-height: 16px;
    padding: inherit;
   
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -200px;
    justify-content: space-evenly;
}
    </style>
</head>
<body>
    <!-- Seção "Quem Somos" -->
    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Nossa História</h2>
                <p>Desde 1999, a DINENG tem sido uma força pioneira no desenvolvimento e construção de redes elétricas, atuando com excelência no estado do Tocantins e na região Norte do Brasil. Nossa jornada é marcada por um compromisso inabalável com a inovação e a qualidade, sustentado por uma equipe dedicada e altamente qualificada. <br>
                    <br>Cada membro da nossa equipe desempenha um papel crucial na nossa missão de transformar o setor de engenharia elétrica. Com um orgulho imenso, destacamos a dedicação e a paixão que nossos profissionais trazem para cada projeto. Nossos técnicos especializados são continuamente treinados nas mais avançadas tecnologias e práticas da indústria, assegurando que cada projeto, manutenção ou reparo seja executado com a máxima precisão e eficiência.<br>
                    <br>A DINENG se orgulha de ser uma empresa que não apenas atende, mas supera as expectativas dos nossos clientes, promovendo a excelência em cada aspecto do nosso trabalho. Desde o início da nossa trajetória, temos sido responsáveis por projetos de grande impacto, que não apenas energizam a infraestrutura, mas também conectam comunidades e possibilitam o crescimento regional. <br>
                    <br>Nossa abordagem é guiada por um profundo respeito pelos valores éticos e pela inovação contínua. Com cada desafio, buscamos novas soluções e aprimoramos nossas práticas, sempre com o objetivo de oferecer resultados excepcionais e sustentáveis.<br>
                    <br>Através da nossa trajetória, consolidamos nossa posição como uma das principais empresas de engenharia do país, reconhecida pela nossa competência técnica e compromisso com a qualidade. Na DINENG, acreditamos que o amanhã é alimentado pela nossa dedicação hoje. Juntos, estamos energizando o futuro e conectando possibilidades, construindo um legado de inovação e excelência para as próximas gerações. <br>
                    <br>Nossa trajetória é marcada por projetos de grande impacto, realizados por uma equipe altamente qualificada e dedicada. Através da inovação contínua e do respeito aos valores éticos, consolidamos nossa posição como uma das principais empresas de engenharia do país. <br>
                </p>
            </div>
            <div class="col-md-6">
                <img src="imagens/nossa-historia.jpg" alt="Nossa História" class="img-fluid rounded">
            </div>
        </div>
    </section>
</body>
</html>
