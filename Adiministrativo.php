<?php
// Conectar ao banco de dados
include 'conexao.php';
// Verifique se ambos os arquivos de conexão são necessários
include 'conexao2.php';

mysqli_set_charset($conn, "utf8");
// Verificar o perfil do usuário
$perfil = 'administrador'; // Exemplo, substitua com a lógica real
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'cabeçarioadm.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Administrativo - Dineng Administrativo</title>
    <link rel="stylesheet" href="Adiministrativo.css">
    <script src="tabela_de_denuncias.js" defer></script>
    
    <!-- Inclua Bootstrap CSS aqui -->
</head>
<body>
    
    <div class="sidebar">
    <br><img src="imagens botoes/Dineng_Logo_02.png" alt="Dineng Logo" style="height: 70px;">
        <a href="#collapseExample1" data-toggle="collapse"><img src="imagens botoes/dashboard.png" alt="Logo" style="height: 20px;"> Dashboard</a>
        <a href="#collapseExample2" data-toggle="collapse"><img src="imagens botoes/pessoa.png" alt="Logo" style="height: 20px;"> Recebida 
            <?php 
            // Consulta SQL para contar o número de registros recebidos
            $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida'";
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['count'];
            } else {
                echo "Erro na consulta.";
            }
            ?>
        </a>
        <br>
        <a href="#collapseExample3" data-toggle="collapse"><img src="imagens botoes/analise-de-dados.png" alt="Logo" style="height: 20px;"> Em Análise 
            <?php 
            // Consulta SQL para contar o número de registros em análise
            $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise'";
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['count'];
            } else {
                echo "Erro na consulta.";
            }
            ?>
        </a>
        <br>
        <a href="#collapseExample4" data-toggle="collapse"><img src="imagens botoes/formato-de-dados-simples.png" alt="Logo" style="height: 20px;"> Em Processo 
            <?php 
            // Consulta SQL para contar o número de registros em processo
            $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo'";
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['count'];
            } else {
                echo "Erro na consulta.";
            }
            ?>
        </a>
        <br>
        <a href="#collapseExample5" data-toggle="collapse"><img src="imagens botoes/tarefa-concluida (2).png" alt="Logo" style="height: 20px;"> Concluídas 
            <?php 
            // Consulta SQL para contar o número de registros concluídos
            $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Concluída'";
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['count'];
            } else {
                echo "Erro na consulta.";
            }
            ?>
        </a>
        <br>
        <a href="#collapseExample6" data-toggle="collapse"><img src="imagens botoes/pasta.png" alt="Logo" style="height: 20px;"> Arquivadas 
            <?php 
            // Consulta SQL para contar o número de registros arquivados
            $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Arquivada'";
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                echo $row['count'];
            } else {
                echo "Erro na consulta.";
            }
            ?>
        </a>
        <br>
        <?php if ($perfil === 'administrador') { ?>
            <a href="#collapseExample7" data-toggle="collapse"><img src="imagens botoes/grupo.png" alt="Logo" style="height: 20px;"> Usuários</a>
        <?php } ?>
    </div>

    <div class="container2" id="myGroup">
        <div class="d-flex mb-3">
            <!-- Colapso para cada status -->
            <div class="collapse" id="collapseExample2" data-parent="#myGroup">
                <div class="card card-body">
                    <h4 class="text-center">Recebidas</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Tipo Serviço</th>
                                <th>Tipo Ouvidoria</th>
                                <th>Conteúdo</th>
                                <th>Data de Envio</th>
                                <th>Status</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Filtrar apenas o status 'Recebida'
                        $sql_query = $conn->query("SELECT * FROM Ouvidoria_registros WHERE status = 'Recebida'") or die($conn->error);
                        while ($arquivos = $sql_query->fetch_assoc()) {
                            if ($arquivos) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($arquivos['ID']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['codigo']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_servico']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_ouvidoria']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['conteudo']); ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($arquivos['data_registro'])); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($arquivos['ID']); ?>"><?php echo htmlspecialchars($arquivos['status']); ?></td>
                                    <td>
                                        <a class='btn btn-lg btn-primary' href='editar.php?id=<?php echo htmlspecialchars($arquivos['ID']); ?>'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.5l-.707.707L12.086 7.5 13.5 6.086zm-.207 7.5h2a1 1 0 0 1 1 1v1H4v-1a1 1 0 0 1 1-1h2.5v-1H6.5v-2h4v2h-1v1z'/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="collapse" id="collapseExample3" data-parent="#myGroup">
                <div class="card card-body">
                    <h4 class="text-center">Em Análise</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Tipo Serviço</th>
                                <th>Tipo Ouvidoria</th>
                                <th>Conteúdo</th>
                                <th>Data de Envio</th>
                                <th>Status</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Filtrar apenas o status 'Em análise'
                        $sql_query = $conn->query("SELECT * FROM Ouvidoria_registros WHERE status = 'Em analise'") or die($conn->error);
                        while ($arquivos = $sql_query->fetch_assoc()) {
                            if ($arquivos) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($arquivos['ID']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['codigo']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_servico']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_ouvidoria']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['conteudo']); ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($arquivos['data_registro'])); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($arquivos['ID']); ?>"><?php echo htmlspecialchars($arquivos['status']); ?></td>
                                    <td>
                                        <a class='btn btn-lg btn-primary' href='editar.php?id=<?php echo htmlspecialchars($arquivos['ID']); ?>'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.5l-.707.707L12.086 7.5 13.5 6.086zm-.207 7.5h2a1 1 0 0 1 1 1v1H4v-1a1 1 0 0 1 1-1h2.5v-1H6.5v-2h4v2h-1v1z'/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="collapse" id="collapseExample4" data-parent="#myGroup">
                <div class="card card-body">
                    <h4 class="text-center">Em Processo</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Tipo Serviço</th>
                                <th>Tipo Ouvidoria</th>
                                <th>Conteúdo</th>
                                <th>Data de Envio</th>
                                <th>Status</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Filtrar apenas o status 'Em processo'
                        $sql_query = $conn->query("SELECT * FROM Ouvidoria_registros WHERE status = 'Em processo'") or die($conn->error);
                        while ($arquivos = $sql_query->fetch_assoc()) {
                            if ($arquivos) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($arquivos['ID']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['codigo']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_servico']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_ouvidoria']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['conteudo']); ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($arquivos['data_registro'])); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($arquivos['ID']); ?>"><?php echo htmlspecialchars($arquivos['status']); ?></td>
                                    <td>
                                        <a class='btn btn-lg btn-primary' href='editar.php?id=<?php echo htmlspecialchars($arquivos['ID']); ?>'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.5l-.707.707L12.086 7.5 13.5 6.086zm-.207 7.5h2a1 1 0 0 1 1 1v1H4v-1a1 1 0 0 1 1-1h2.5v-1H6.5v-2h4v2h-1v1z'/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="collapse" id="collapseExample5" data-parent="#myGroup">
                <div class="card card-body">
                    <h4 class="text-center">Concluídas</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Tipo Serviço</th>
                                <th>Tipo Ouvidoria</th>
                                <th>Conteúdo</th>
                                <th>Data de Envio</th>
                                <th>Status</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Filtrar apenas o status 'Concluída'
                        $sql_query = $conn->query("SELECT * FROM Ouvidoria_registros WHERE status = 'Concluída'") or die($conn->error);
                        while ($arquivos = $sql_query->fetch_assoc()) {
                            if ($arquivos) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($arquivos['ID']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['codigo']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_servico']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_ouvidoria']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['conteudo']); ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($arquivos['data_registro'])); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($arquivos['ID']); ?>"><?php echo htmlspecialchars($arquivos['status']); ?></td>
                                    <td>
                                        <a class='btn btn-lg btn-primary' href='editar.php?id=<?php echo htmlspecialchars($arquivos['ID']); ?>'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.5l-.707.707L12.086 7.5 13.5 6.086zm-.207 7.5h2a1 1 0 0 1 1 1v1H4v-1a1 1 0 0 1 1-1h2.5v-1H6.5v-2h4v2h-1v1z'/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="collapse" id="collapseExample6" data-parent="#myGroup">
                <div class="card card-body">
                    <h4 class="text-center">Arquivadas</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Tipo Serviço</th>
                                <th>Tipo Ouvidoria</th>
                                <th>Conteúdo</th>
                                <th>Data de Envio</th>
                                <th>Status</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Filtrar apenas o status 'Arquivada'
                        $sql_query = $conn->query("SELECT * FROM Ouvidoria_registros WHERE status = 'Arquivada'") or die($conn->error);
                        while ($arquivos = $sql_query->fetch_assoc()) {
                            if ($arquivos) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($arquivos['ID']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['codigo']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_servico']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['tipo_ouvidoria']); ?></td>
                                    <td><?php echo htmlspecialchars($arquivos['conteudo']); ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($arquivos['data_registro'])); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($arquivos['ID']); ?>"><?php echo htmlspecialchars($arquivos['status']); ?></td>
                                    <td>
                                        <a class='btn btn-lg btn-primary' href='editar.php?id=<?php echo htmlspecialchars($arquivos['ID']); ?>'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.5l-.707.707L12.086 7.5 13.5 6.086zm-.207 7.5h2a1 1 0 0 1 1 1v1H4v-1a1 1 0 0 1 1-1h2.5v-1H6.5v-2h4v2h-1v1z'/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } 
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="collapse" id="collapseExample7" data-parent="#myGroup">
            <div class="card card-body">
                <h4 class="text-center">Dados dos Usuários</h4>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Perfil</th>
                            <th>Matrícula</th>
                            <th>Usuário</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    try {
                        $stmt = $conexao->query("SELECT * FROM `usuarios da empresa`");
                        while ($usuarios = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($usuarios['id']); ?></td>
                                <td><?php echo htmlspecialchars($usuarios['nome']); ?></td>
                                <td><?php echo htmlspecialchars($usuarios['Perfil']); ?></td>
                                <td><?php echo htmlspecialchars($usuarios['Matricula']); ?></td>
                                <td><?php echo htmlspecialchars($usuarios['usuario']); ?></td>
                                <td>
                                    <?php if ($perfil === 'administrador') { ?>
                                        <a class='btn btn-lg btn-primary' href='editar_usuario.php?id=<?php echo htmlspecialchars($usuarios['id']); ?>'>
                                       <svg xmlns='http://www.w3.org/2000/svg' width='30' height='20' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5v-.5h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5v-.5h-.293l6.5 6.5z'/>
                                            </svg>
                                
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } catch (Exception $e) {
                        echo 'Erro: ' . htmlspecialchars($e->getMessage());
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

    <div class="collapse" id="collapseExample1" data-parent="#myGroup">
    <!-- Montserrat Font -->
    <main class="main-container">
        <div class="main-title">
        </div>
        <div class="main-cards1">
             <div class="card1">
                <div class="card-inner">
               </div> 
               
             </div>
          
                <div class="card1">
                <div class="card-inner">
                    <h3>Denúncias</h3>
                    <span class="material-icons-outlined"></span>
                </div>  
                <h1><?php  
                // Consulta SQL para contar o número de registros arquivados
                $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Denúncia'";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                } else {
                    echo "Erro na consulta.";
                }?></h1>
                <a href="#collapseExample9" data-toggle="collapse">
                    <br>
                    <img src="imagens botoes/atencao.png" alt="Logo" style="height: 60px; cursor: pointer;">  
                </a>
             
            </div>
            <div class="card2">
                <div class="card-inner2">
                    <h3>Reclamações</h3>
                    <span class="material-icons-outlined"></span>
                </div>  
                <h1><?php  
                // Consulta SQL para contar o número de registros arquivados
                $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Reclamação'";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                } else {
                    echo "Erro na consulta.";
                }?></h1>
                <a href="#collapseExample10" data-toggle="collapse">
                   <br><img src="imagens botoes/atencao.png" alt="Logo" style="height: 60px; cursor: pointer;">  
                </a>
            </div> 

            <div class="card3">
                <div class="card-inner3">
                    <h3>Sugestões</h3>
                    <span class="material-icons-outlined"></span>
                </div>
                <h1><?php 
                // Consulta SQL para contar o número de registros arquivados
                $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Sugestao'";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                } else {
                    echo "Erro na consulta.";
                }?></h1>
                <a href="#collapseExample11" data-toggle="collapse">
                    <img src="imagens botoes/sugestao.png">  
                </a>
            </div> 
            <div class="card3">
                <div class="card-inner3">
                    <h3>Ouvidoria Externa</h3>
                    <span class="material-icons-outlined"></span>
                </div>
                <h1><?php 
                // Consulta SQL para contar o número de registros arquivados
                $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Externa'";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                } else {
                    echo "Erro na consulta.";
                }?></h1>
                
                <a href="#collapseExample12" data-toggle="collapse">
                    <img src="imagens botoes/atencao.png" alt="Logo" style="height: 60px; cursor: pointer;">  
                </a>
            </div>
            <div class="card4">
                <div class="card-inner4">
                    <h3>Ouvidoria Interna</h3>
                    <span class="material-icons-outlined"></span>
                </div>
                <h1><?php 
                // Consulta SQL para contar o número de registros arquivados
                $query = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Interna'";
                $result = $conn->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                } else {
                    echo "Erro na consulta.";
                }?></h1>
                
                <a href="#collapseExample13" data-toggle="collapse">
                    <img src="imagens botoes/atencao.png" alt="Logo" style="height: 60px; cursor: pointer;">  
                </a>
            </div>
        </div>
            
            <div class="charts4">
    <div class="charts-card4">
        <h5 class="chart-title4"><br> Denúncias</h5>
        
        <!-- Inclua o CSS do ApexCharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.js"></script>
        
        <!-- Primeiro Gráfico de Pizza -->
        <div id="piechart1" style="width: 500px; height: 300px;"></div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Dados para o gráfico de Denúncias
                var options1 = {
                    chart: {
                        type: 'pie',
                        height: 300
                    },
                    series: [
                        <?php 
                        // Consulta SQL para contar o número de registros com Status "Recebida" e tipo_servico "Denúncia"
                        $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_servico = 'Denúncia'";
                        $resultRecebida = $conn->query($queryRecebida);
                        $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em análise" e tipo_servico "Denúncia"
                        $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_servico = 'Denúncia'";
                        $resultEmAnalise = $conn->query($queryEmAnalise);
                        $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em processo" e tipo_servico "Denúncia"
                        $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_servico = 'Denúncia'";
                        $resultEmProcesso = $conn->query($queryEmProcesso);
                        $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                        // Exibindo os resultados no gráfico
                        echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                        ?>
                    ],
                    labels: ['Recebida', 'Em análise', 'Em processo'],
                    title: {
                        text: 'Quantidade de Denúncias em aberto',
                        align: 'center'
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                enabled: true,
                                formatter: function (val, opts) {
                                    // Retorna o número da série sem porcentagem
                                    return opts.w.globals.series[opts.seriesIndex];
                                }
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                // Exibe o número no tooltip sem porcentagem
                                return val;
                            }
                        }
                    },
                    colors: ['#FF5722', '#9E9E9E', '#0331f4'] // Laranja escuro, azul escuro, cinza
                };

                // Criação do gráfico
                var chart1 = new ApexCharts(document.querySelector("#piechart1"), options1);
                chart1.render();
            });
        </script>
    </div>
</div>

<div class="charts3">
    <div class="charts-card3">
        <h5 class="chart-title3"><br> Reclamações</h5>
        
        <!-- Segundo Gráfico de Pizza -->
        <div id="piechart2" style="width: 500px; height: 300px;"></div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Dados para o gráfico de Reclamações
                var options2 = {
                    chart: {
                        type: 'pie',
                        height: 300
                    },
                    series: [
                        <?php 
                        // Consulta SQL para contar o número de registros com Status "Recebida" e tipo_servico "Reclamação"
                        $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_servico = 'Reclamação'";
                        $resultRecebida = $conn->query($queryRecebida);
                        $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em análise" e tipo_servico "Reclamação"
                        $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_servico = 'Reclamação'";
                        $resultEmAnalise = $conn->query($queryEmAnalise);
                        $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em processo" e tipo_servico = "Reclamação"
                        $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_servico = 'Reclamação'";
                        $resultEmProcesso = $conn->query($queryEmProcesso);
                        $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                        // Exibindo os resultados no gráfico
                        echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                        ?>
                    ],
                    labels: ['Recebida', 'Em análise', 'Em processo'],
                    title: {
                        text: 'Quantidade de Reclamações em aberto',
                        align: 'center'
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                enabled: true,
                                formatter: function (val, opts) {
                                    // Retorna o número da série sem porcentagem
                                    return opts.w.globals.series[opts.seriesIndex];
                                }
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                // Exibe o número no tooltip sem porcentagem
                                return val;
                            }
                        }
                    },
                    colors: ['#FF5722', '#9E9E9E', '#0331f4'] // Laranja escuro, azul escuro, cinza
                };

                // Criação do gráfico
                var chart2 = new ApexCharts(document.querySelector("#piechart2"), options2);
                chart2.render();
            });
        </script>
    </div>
</div>
<div class="charts">
    <div class="charts-card">
        <h5 class="chart-title"><br>
        Quantidade de Serviços por Mês</h5>
        <div id="monthly-chart"></div>
    </div>
    <div class="charts-card">
        <h5 class="chart-title"><br>
        Quantidade de Serviços por Ano</h5>
        <div id="annual-chart"></div>
    </div>
</div>
<div class="charts2">
    <div class="charts-card2">
        <h5 class="chart-title2"><br>
        Quantidade de Serviços por Mês</h5>
        <div id="monthly-chart2"></div>
    </div>
    <div class="charts-card2">
        <h5 class="chart-title2"><br>
        Quantidade de Serviços por Ano</h5>
        <div id="annual-chart2"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
<!-- Custom JS -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados simulados para os meses
    var monthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
            {
                name: 'Denúncias',
                data: [
                    <?php 
                    // Inicializar array para contagem mensal
                    $monthlyDenuncias = array_fill(1, 12, 0);

                    // Consulta SQL para contar registros de "Denúncia" por mês
                    $queryDenuncias = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Denúncia' GROUP BY month";
                    $resultDenuncias = $conn->query($queryDenuncias);

                    if ($resultDenuncias) {
                        while ($row = $resultDenuncias->fetch_assoc()) {
                            $monthlyDenuncias[(int)$row['month']] = $row['count'];
                        }
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $monthlyDenuncias);
                    ?>
                ]
            },
            {
                name: 'Reclamações',
                data: [
                    <?php 
                    // Inicializar array para contagem mensal
                    $monthlyReclamacoes = array_fill(1, 12, 0);

                    // Consulta SQL para contar registros de "Reclamação" por mês
                    $queryReclamacoes = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Reclamação' GROUP BY month";
                    $resultReclamacoes = $conn->query($queryReclamacoes);

                    if ($resultReclamacoes) {
                        while ($row = $resultReclamacoes->fetch_assoc()) {
                            $monthlyReclamacoes[(int)$row['month']] = $row['count'];
                        }
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $monthlyReclamacoes);
                    ?>
                ]
            },
            {
                name: 'Sugestões',
                data: [
                    <?php 
                    // Inicializar array para contagem mensal
                    $monthlySugestoes = array_fill(1, 12, 0);

                    // Consulta SQL para contar registros de "Sugestão" por mês
                    $querySugestoes = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Sugestão' GROUP BY month";
                    $resultSugestoes = $conn->query($querySugestoes);

                    if ($resultSugestoes) {
                        while ($row = $resultSugestoes->fetch_assoc()) {
                            $monthlySugestoes[(int)$row['month']] = $row['count'];
                        }
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $monthlySugestoes);
                    ?>
                ]
            }
        ]
    };

    var startYear = 2024;
    var endYear = startYear + 10; // Gera anos até 2034 (ou ajuste esse valor conforme necessário)
    var years = [];

    for (var year = startYear; year <= endYear; year++) {
        years.push(year.toString());
    }

    var annualData = {
        labels: years,
        series: [
            {
                name: 'Denúncias',
                data: [
                    <?php 
                    // Inicializar array para contagem anual
                    $annualDenuncias = array();

                    // Consulta SQL para contar registros de "Denúncia" por ano
                    $queryDenuncias = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Denúncia' GROUP BY year";
                    $resultDenuncias = $conn->query($queryDenuncias);

                    if ($resultDenuncias) {
                        while ($row = $resultDenuncias->fetch_assoc()) {
                            $year = (int)$row['year'];
                            $annualDenuncias[$year] = $row['count'];
                        }
                    }

                    // Preenchendo os dados para cada ano na sequência
                    $dataDenuncias = [];
                    for ($year = 2024; $year <= 2034; $year++) {
                        $dataDenuncias[] = isset($annualDenuncias[$year]) ? $annualDenuncias[$year] : 0;
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $dataDenuncias);
                    ?>
                ]
            },
            {
                name: 'Reclamações',
                data: [
                    <?php 
                    // Inicializar array para contagem anual
                    $annualReclamacoes = array();

                    // Consulta SQL para contar registros de "Reclamação" por ano
                    $queryReclamacoes = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Reclamação' GROUP BY year";
                    $resultReclamacoes = $conn->query($queryReclamacoes);

                    if ($resultReclamacoes) {
                        while ($row = $resultReclamacoes->fetch_assoc()) {
                            $year = (int)$row['year'];
                            $annualReclamacoes[$year] = $row['count'];
                        }
                    }

                    // Preenchendo os dados para cada ano na sequência
                    $dataReclamacoes = [];
                    for ($year = 2024; $year <= 2034; $year++) {
                        $dataReclamacoes[] = isset($annualReclamacoes[$year]) ? $annualReclamacoes[$year] : 0;
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $dataReclamacoes);
                    ?>
                ]
            },
            {
                name: 'Sugestões',
                data: [
                    <?php 
                    // Inicializar array para contagem anual
                    $annualSugestoes = array();

                    // Consulta SQL para contar registros de "Sugestão" por ano
                    $querySugestoes = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Sugestão' GROUP BY year";
                    $resultSugestoes = $conn->query($querySugestoes);

                    if ($resultSugestoes) {
                        while ($row = $resultSugestoes->fetch_assoc()) {
                            $year = (int)$row['year'];
                            $annualSugestoes[$year] = $row['count'];
                        }
                    }

                    // Preenchendo os dados para cada ano na sequência
                    $dataSugestoes = [];
                    for ($year = 2024; $year <= 2034; $year++) {
                        $dataSugestoes[] = isset($annualSugestoes[$year]) ? $annualSugestoes[$year] : 0;
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $dataSugestoes);
                    ?>
                ]
            }
        ]
    };

    // Gráfico de Quantidade de Serviços por Mês
    var optionsMonthly = {
        series: monthlyData.series,
        chart: {
            type: 'bar',
            height: 400
        },
        xaxis: {
            categories: monthlyData.labels
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#808080', '#FF5722', '#003f5c'] // Cinza para Denúncias, Laranja para Reclamações, Azul para Sugestões
    };
    var chartMonthly = new ApexCharts(document.querySelector("#monthly-chart"), optionsMonthly);
    chartMonthly.render();

    // Gráfico de Quantidade de Serviços por Ano
    var optionsAnnual = {
        series: annualData.series,
        chart: {
            type: 'line',
            height: 400
        },
        xaxis: {
            categories: annualData.labels
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 2
        },
        markers: {
            size: 5
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#808080', '#FF5722', '#003f5c'] // Cinza para Denúncias, Laranja para Reclamações, Azul para Sugestões
    };
    var chartAnnual = new ApexCharts(document.querySelector("#annual-chart"), optionsAnnual);
    chartAnnual.render();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados simulados para os meses
    var monthlyData2 = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
            {
                name: 'Externa',
                data: [
                    <?php 
                    // Inicializar array para contagem mensal
                    $monthlyDenuncias = array_fill(1, 12, 0);

                    // Consulta SQL para contar registros de "Denúncia" por mês
                    $queryDenuncias = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Externa' GROUP BY month";
                    $resultDenuncias = $conn->query($queryDenuncias);

                    if ($resultDenuncias) {
                        while ($row = $resultDenuncias->fetch_assoc()) {
                            $monthlyDenuncias[(int)$row['month']] = $row['count'];
                        }
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $monthlyDenuncias);
                    ?>
                ]
            },
            {
                name: 'Interna',
                data: [
                    <?php 
                    // Inicializar array para contagem mensal
                    $monthlyReclamacoes = array_fill(1, 12, 0);

                    // Consulta SQL para contar registros de "Reclamação" por mês
                    $queryReclamacoes = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Interna' GROUP BY month";
                    $resultReclamacoes = $conn->query($queryReclamacoes);

                    if ($resultReclamacoes) {
                        while ($row = $resultReclamacoes->fetch_assoc()) {
                            $monthlyReclamacoes[(int)$row['month']] = $row['count'];
                        }
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $monthlyReclamacoes);
                    ?>
                ]
            }
        ]
    };

    var startYear = 2024;
    var endYear = startYear + 10; // Gera anos até 2034 (ou ajuste esse valor conforme necessário)
    var years = [];

    for (var year = startYear; year <= endYear; year++) {
        years.push(year.toString());
    }

    var annualData2 = {
        labels: years,
        series: [
            {
                name: 'Externa',
                data: [
                    <?php 
                    // Inicializar array para contagem anual
                    $annualDenuncias = array();

                    // Consulta SQL para contar registros de "Denúncia" por ano
                    $queryDenuncias = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Externa' GROUP BY year";
                    $resultDenuncias = $conn->query($queryDenuncias);

                    if ($resultDenuncias) {
                        while ($row = $resultDenuncias->fetch_assoc()) {
                            $year = (int)$row['year'];
                            $annualDenuncias[$year] = $row['count'];
                        }
                    }

                    // Preenchendo os dados para cada ano na sequência
                    $dataDenuncias = [];
                    for ($year = 2024; $year <= 2034; $year++) {
                        $dataDenuncias[] = isset($annualDenuncias[$year]) ? $annualDenuncias[$year] : 0;
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $dataDenuncias);
                    ?>
                ]
            },
            {
                name: 'Interna',
                data: [
                    <?php 
                    // Inicializar array para contagem anual
                    $annualReclamacoes = array();

                    // Consulta SQL para contar registros de "Reclamação" por ano
                    $queryReclamacoes = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Interna' GROUP BY year";
                    $resultReclamacoes = $conn->query($queryReclamacoes);

                    if ($resultReclamacoes) {
                        while ($row = $resultReclamacoes->fetch_assoc()) {
                            $year = (int)$row['year'];
                            $annualReclamacoes[$year] = $row['count'];
                        }
                    }

                    // Preenchendo os dados para cada ano na sequência
                    $dataReclamacoes = [];
                    for ($year = 2024; $year <= 2034; $year++) {
                        $dataReclamacoes[] = isset($annualReclamacoes[$year]) ? $annualReclamacoes[$year] : 0;
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $dataReclamacoes);
                    ?>
                ]
            }
        ]
    };

    // Gráfico de Quantidade de Serviços por Mês
    var optionsMonthly2 = {
        series: monthlyData2.series,
        chart: {
            type: 'bar',
            height: 400
        },
        xaxis: {
            categories: monthlyData2.labels
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#003f5c', '#5f0176'] // Verde para Externa e Verde Escuro para Interna
    };
    var chartMonthly2 = new ApexCharts(document.querySelector("#monthly-chart2"), optionsMonthly2);
    chartMonthly2.render();

    // Gráfico de Quantidade de Serviços por Ano
    var optionsAnnual2 = {
        series: annualData2.series,
        chart: {
            type: 'line',
            height: 400
        },
        xaxis: {
            categories: annualData2.labels
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 2
        },
        markers: {
            size: 5
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#003f5c', '#5f0176'] // Verde para Externa e Verde Escuro para Interna
    };
    var chartAnnual2 = new ApexCharts(document.querySelector("#annual-chart2"), optionsAnnual2);
    chartAnnual2.render();
});
</script>
</div>
</div>

<div class="collapse" id="collapseExample10" data-parent="#myGroup">
    <p>Reclamações</p>
    <div class="charts7">
        <div class="charts-card7">
            <h5 class="chart-title7"><br> Reclamações</h5>
            
            <!-- Primeiro Gráfico de Pizza -->
            <div id="piechart4" style="width: 500px; height: 300px;"></div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Dados para o gráfico de Reclamações
                    var options4 = {
                        chart: {
                            type: 'pie',
                            height: 300
                        },
                        series: [
                            <?php 
                            // Consultas SQL para contagem de registros
                            $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_servico = 'Reclamação'";
                            $resultRecebida = $conn->query($queryRecebida);
                            $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                            $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_servico = 'Reclamação'";
                            $resultEmAnalise = $conn->query($queryEmAnalise);
                            $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                            $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_servico = 'Reclamação'";
                            $resultEmProcesso = $conn->query($queryEmProcesso);
                            $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                            // Exibindo os resultados no gráfico
                            echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                            ?>
                        ],
                        labels: ['Recebida', 'Em análise', 'Em processo'],
                        title: {
                            text: 'Quantidade de Reclamações em aberto',
                            align: 'center'
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: true,
                                    formatter: function (val, opts) {
                                        return opts.w.globals.series[opts.seriesIndex];
                                    }
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return val;
                                }
                            }
                        },
                        colors: ['#FF5722', '#9E9E9E', '#0331f4'] // Laranja escuro, azul escuro, cinza
                    };

                    var chart4 = new ApexCharts(document.querySelector("#piechart4"), options4);
                    chart4.render();
                });
            </script>
        </div>
    </div>

    <div class="charts">
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Reclamações por Mês</h5>
            <div id="monthly-chart4"></div>
        </div>
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Reclamações por Ano</h5>
            <div id="annual-chart4"></div>
        </div>
    </div>

    <div class="charts8">
        <div class="charts-card8">
            <h5 class="chart-title8">Quantidade de Reclamações</h5>
            <div id="chart-container2"></div>
            <button id="toggle-btn2">Mostrar por Ano</button>
        </div>
    </div>
</div>

<!-- Scripts para gráficos -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados simulados para os meses
    var monthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [{
            name: 'Reclamação',
            data: [
                <?php 
                // Inicializar array para contagem mensal
                $monthlyReclamação = array_fill(1, 12, 0);

                // Consulta SQL para contar registros de "Reclamação" por mês
                $queryReclamação = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Reclamação' GROUP BY month";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $monthlyReclamação[(int)$row['month']] = $row['count'];
                    }
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $monthlyReclamação);
                ?>
            ]
        }]
    };

    var startYear = 2024;
    var endYear = startYear + 10; // Gera anos até 2034 (ou ajuste esse valor conforme necessário)
    var years = [];

    for (var year = startYear; year <= endYear; year++) {
        years.push(year.toString());
    }

    var annualData = {
        labels: years,
        series: [{
            name: 'Reclamação',
            data: [
                <?php 
                // Inicializar array para contagem anual
                $annualReclamacoes = array();

                // Consulta SQL para contar registros de "Reclamação" por ano
                $queryReclamação = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Reclamação' GROUP BY year";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $year = (int)$row['year'];
                        $annualReclamacoes[$year] = $row['count'];
                    }
                }

                // Preenchendo os dados para cada ano na sequência
                $dataReclamação = [];
                for ($year = 2024; $year <= 2034; $year++) {
                    $dataReclamação[] = isset($annualReclamacoes[$year]) ? $annualReclamacoes[$year] : 0;
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $dataReclamação);
                ?>
            ]
        }]
    };

    // Gráfico de Quantidade de Serviços por Mês
    var optionsMonthly4 = {
        series: monthlyData.series,
        chart: {
            type: 'bar',
            height: 400
        },
        xaxis: {
            categories: monthlyData.labels
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartMonthly4 = new ApexCharts(document.querySelector("#monthly-chart4"), optionsMonthly4);
    chartMonthly4.render();

    // Gráfico de Quantidade de Serviços por Ano
    var optionsAnnual4 = {
        series: annualData.series,
        chart: {
            type: 'line',
            height: 400
        },
        xaxis: {
            categories: annualData.labels
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 2
        },
        markers: {
            size: 5
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartAnnual4 = new ApexCharts(document.querySelector("#annual-chart4"), optionsAnnual4);
    chartAnnual4.render();

    // Gráfico de Quantidade de Reclamações com Toggle
    var chartOptions2 = {
        chart: {
                type: 'area', // Gráfico de área
                height: 400
            },
            xaxis: {
                categories: monthlyData.labels
            },
            series: monthlyData.series,
            dataLabels: {
                enabled: true
            },
            stroke: {
                width: 2
            },
            markers: {
                size: 5
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            colors: ['#FF5722', '#4CAF50']
        };

    var chart2 = new ApexCharts(document.querySelector("#chart-container2"), chartOptions2);
    chart2.render();

    var isMonthly = true;
    document.getElementById('toggle-btn2').addEventListener('click', function() {
        var button = this;
        if (isMonthly) {
            chart2.updateOptions({
                xaxis: {
                    categories: annualData.labels
                },
                series: annualData.series
            });
            button.textContent = 'Mostrar por Mês';
        } else {
            chart2.updateOptions({
                xaxis: {
                    categories: monthlyData.labels
                },
                series: monthlyData.series
            });
            button.textContent = 'Mostrar por Ano';
        }
        isMonthly = !isMonthly;
    });
});
</script>
<div class="collapse" id="collapseExample11" data-parent="#myGroup">
    <p>Sugestão</p>
    <div class="charts9">
        <div class="charts-card9">
            <h5 class="chart-title9"><br> Sugestão</h5>
            
            <!-- Primeiro Gráfico de Pizza -->
            <div id="piechart5" style="width: 500px; height: 300px;"></div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Dados para o gráfico de Reclamações
                    var options5 = {
                        chart: {
                            type: 'pie',
                            height: 300
                        },
                        series: [
                            <?php 
                            // Consultas SQL para contagem de registros
                            $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_servico = 'Sugestão'";
                            $resultRecebida = $conn->query($queryRecebida);
                            $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                            $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_servico = 'Sugestão'";
                            $resultEmAnalise = $conn->query($queryEmAnalise);
                            $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                            $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_servico = 'Sugestão'";
                            $resultEmProcesso = $conn->query($queryEmProcesso);
                            $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                            // Exibindo os resultados no gráfico
                            echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                            ?>
                        ],
                        labels: ['Recebida', 'Em análise', 'Em processo'],
                        title: {
                            text: 'Quantidade de Reclamações em aberto',
                            align: 'center'
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: true,
                                    formatter: function (val, opts) {
                                        return opts.w.globals.series[opts.seriesIndex];
                                    }
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return val;
                                }
                            }
                        },
                        colors: ['#FF5722', '#9E9E9E', '#0331f4'] // Laranja escuro, azul escuro, cinza
                    };

                    var chart5 = new ApexCharts(document.querySelector("#piechart5"), options5);
                    chart5.render();
                });
            </script>
        </div>
    </div>

    <div class="charts">
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Sugestão por Mês</h5>
            <div id="monthly-chart5"></div>
        </div>
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Sugestão por Ano</h5>
            <div id="annual-chart5"></div>
        </div>
    </div>

    <div class="charts10">
        <div class="charts-card10">
            <h5 class="chart-title10">Quantidade de Sugestão</h5>
            <div id="chart-container3"></div>
            <button id="toggle-btn3">Mostrar por Ano</button>
        </div>
    </div>
</div>

<!-- Scripts para gráficos -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados simulados para os meses
    var monthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [{
            name: 'Reclamação',
            data: [
                <?php 
                // Inicializar array para contagem mensal
                $monthlyReclamação = array_fill(1, 12, 0);

                // Consulta SQL para contar registros de "Reclamação" por mês
                $queryReclamação = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Sugestão' GROUP BY month";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $monthlyReclamação[(int)$row['month']] = $row['count'];
                    }
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $monthlyReclamação);
                ?>
            ]
        }]
    };

    var startYear = 2024;
    var endYear = startYear + 10; // Gera anos até 2034 (ou ajuste esse valor conforme necessário)
    var years = [];

    for (var year = startYear; year <= endYear; year++) {
        years.push(year.toString());
    }

    var annualData = {
        labels: years,
        series: [{
            name: 'Reclamação',
            data: [
                <?php 
                // Inicializar array para contagem anual
                $annualReclamacoes = array();

                // Consulta SQL para contar registros de "Reclamação" por ano
                $queryReclamação = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Sugestão' GROUP BY year";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $year = (int)$row['year'];
                        $annualReclamacoes[$year] = $row['count'];
                    }
                }

                // Preenchendo os dados para cada ano na sequência
                $dataReclamação = [];
                for ($year = 2024; $year <= 2034; $year++) {
                    $dataReclamação[] = isset($annualReclamacoes[$year]) ? $annualReclamacoes[$year] : 0;
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $dataReclamação);
                ?>
            ]
        }]
    };

    // Gráfico de Quantidade de Serviços por Mês
    var optionsMonthly5 = {
        series: monthlyData.series,
        chart: {
            type: 'bar',
            height: 400
        },
        xaxis: {
            categories: monthlyData.labels
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartMonthly5 = new ApexCharts(document.querySelector("#monthly-chart5"), optionsMonthly5);
    chartMonthly5.render();

    // Gráfico de Quantidade de Serviços por Ano
    var optionsAnnual5 = {
        series: annualData.series,
        chart: {
            type: 'line',
            height: 400
        },
        xaxis: {
            categories: annualData.labels
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 2
        },
        markers: {
            size: 5
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartAnnual5 = new ApexCharts(document.querySelector("#annual-chart5"), optionsAnnual5);
    chartAnnual5.render();

    // Gráfico de Quantidade de Reclamações com Toggle
    var chartOptions3 = {
        chart: {
                type: 'area', // Gráfico de área
                height: 400
            },
            xaxis: {
                categories: monthlyData.labels
            },
            series: monthlyData.series,
            dataLabels: {
                enabled: true
            },
            stroke: {
                width: 2
            },
            markers: {
                size: 5
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            colors: ['#FF5722', '#4CAF50']
        };

    var chart3 = new ApexCharts(document.querySelector("#chart-container3"), chartOptions3);
    chart3.render();

    var isMonthly = true;
    document.getElementById('toggle-btn3').addEventListener('click', function() {
        var button = this;
        if (isMonthly) {
            chart2.updateOptions({
                xaxis: {
                    categories: annualData.labels
                },
                series: annualData.series
            });
            button.textContent = 'Mostrar por Mês';
        } else {
            chart2.updateOptions({
                xaxis: {
                    categories: monthlyData.labels
                },
                series: monthlyData.series
            });
            button.textContent = 'Mostrar por Ano';
        }
        isMonthly = !isMonthly;
    });
});
</script>
<div class="collapse" id="collapseExample12" data-parent="#myGroup">
    <p>Ouvidoria Externa</p>
    <div class="charts11">
        <div class="charts-card11">
            <h5 class="chart-title11"><br> Ouvidoria Externa</h5>
            
            <!-- Primeiro Gráfico de Pizza -->
            <div id="piechart6" style="width: 500px; height: 300px;"></div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Dados para o gráfico de Reclamações
                    var options6 = {
                        chart: {
                            type: 'pie',
                            height: 300
                        },
                        series: [
                            <?php 
                            // Consultas SQL para contagem de registros
                            $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_ouvidoria = 'Externa'";
                            $resultRecebida = $conn->query($queryRecebida);
                            $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                            $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_ouvidoria = 'Externa'";
                            $resultEmAnalise = $conn->query($queryEmAnalise);
                            $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                            $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_ouvidoria = 'Externa'";
                            $resultEmProcesso = $conn->query($queryEmProcesso);
                            $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                            // Exibindo os resultados no gráfico
                            echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                            ?>
                        ],
                        labels: ['Recebida', 'Em análise', 'Em processo'],
                        title: {
                            text: 'Quantidade de Reclamações em aberto',
                            align: 'center'
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: true,
                                    formatter: function (val, opts) {
                                        return opts.w.globals.series[opts.seriesIndex];
                                    }
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return val;
                                }
                            }
                        },
                        colors: ['#FF5722', '#9E9E9E', '#0331f4'] // Laranja escuro, azul escuro, cinza
                    };

                    var chart6 = new ApexCharts(document.querySelector("#piechart6"), options6);
                    chart6.render();
                });
            </script>
        </div>
    </div>

    <div class="charts">
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Ouvidoria Externa por Mês</h5>
            <div id="monthly-chart6"></div>
        </div>
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Ouvidoria Externa por Ano</h5>
            <div id="annual-chart6"></div>
        </div>
    </div>

    <div class="charts12">
        <div class="charts-card12">
            <h5 class="chart-title10">Quantidade de Ouvidoria Externa</h5>
            <div id="chart-container4"></div>
            <button id="toggle-btn4">Mostrar por Ano</button>
        </div>
    </div>
</div>

<!-- Scripts para gráficos -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados simulados para os meses
    var monthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [{
            name: 'Ouvidoria Externa',
            data: [
                <?php 
                // Inicializar array para contagem mensal
                $monthlyReclamação = array_fill(1, 12, 0);

                // Consulta SQL para contar registros de "Reclamação" por mês
                $queryReclamação = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Externa' GROUP BY month";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $monthlyReclamação[(int)$row['month']] = $row['count'];
                    }
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $monthlyReclamação);
                ?>
            ]
        }]
    };

    var startYear = 2024;
    var endYear = startYear + 10; // Gera anos até 2034 (ou ajuste esse valor conforme necessário)
    var years = [];

    for (var year = startYear; year <= endYear; year++) {
        years.push(year.toString());
    }

    var annualData = {
        labels: years,
        series: [{
            name: 'Ouvidoria Externa',
            data: [
                <?php 
                // Inicializar array para contagem anual
                $annualReclamacoes = array();

                // Consulta SQL para contar registros de "Reclamação" por ano
                $queryReclamação = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Externa' GROUP BY year";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $year = (int)$row['year'];
                        $annualReclamacoes[$year] = $row['count'];
                    }
                }

                // Preenchendo os dados para cada ano na sequência
                $dataReclamação = [];
                for ($year = 2024; $year <= 2034; $year++) {
                    $dataReclamação[] = isset($annualReclamacoes[$year]) ? $annualReclamacoes[$year] : 0;
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $dataReclamação);
                ?>
            ]
        }]
    };

    // Gráfico de Quantidade de Serviços por Mês
    var optionsMonthly6 = {
        series: monthlyData.series,
        chart: {
            type: 'bar',
            height: 400
        },
        xaxis: {
            categories: monthlyData.labels
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartMonthly6 = new ApexCharts(document.querySelector("#monthly-chart6"), optionsMonthly6);
    chartMonthly6.render();

    // Gráfico de Quantidade de Serviços por Ano
    var optionsAnnual6 = {
        series: annualData.series,
        chart: {
            type: 'line',
            height: 400
        },
        xaxis: {
            categories: annualData.labels
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 2
        },
        markers: {
            size: 5
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartAnnual6 = new ApexCharts(document.querySelector("#annual-chart6"), optionsAnnual6);
    chartAnnual6.render();

    // Gráfico de Quantidade de Reclamações com Toggle
    var chartOptions4 = {
        chart: {
                type: 'area', // Gráfico de área
                height: 400
            },
            xaxis: {
                categories: monthlyData.labels
            },
            series: monthlyData.series,
            dataLabels: {
                enabled: true
            },
            stroke: {
                width: 2
            },
            markers: {
                size: 5
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            colors: ['#FF5722', '#4CAF50']
        };

    var chart4 = new ApexCharts(document.querySelector("#chart-container4"), chartOptions4);
    chart4.render();

    var isMonthly = true;
    document.getElementById('toggle-btn4').addEventListener('click', function() {
        var button = this;
        if (isMonthly) {
            chart2.updateOptions({
                xaxis: {
                    categories: annualData.labels
                },
                series: annualData.series
            });
            button.textContent = 'Mostrar por Mês';
        } else {
            chart2.updateOptions({
                xaxis: {
                    categories: monthlyData.labels
                },
                series: monthlyData.series
            });
            button.textContent = 'Mostrar por Ano';
        }
        isMonthly = !isMonthly;
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.js"></script>
<!-- Seção de Denúncias -->
<div class="collapse" id="collapseExample13" data-parent="#myGroup">
    <p>Ouvidoria Interna</p>
    <div class="charts13">
        <div class="charts-card13">
            <h5 class="chart-title13"><br> Ouvidoria Interna</h5>
            
            <!-- Primeiro Gráfico de Pizza -->
            <div id="piechart7" style="width: 500px; height: 300px;"></div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Dados para o gráfico de Reclamações
                    var options7 = {
                        chart: {
                            type: 'pie',
                            height: 300
                        },
                        series: [
                            <?php 
                            // Consultas SQL para contagem de registros
                            $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_ouvidoria = 'Interna'";
                            $resultRecebida = $conn->query($queryRecebida);
                            $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                            $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_ouvidoria = 'Interna'";
                            $resultEmAnalise = $conn->query($queryEmAnalise);
                            $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                            $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_ouvidoria = 'Interna'";
                            $resultEmProcesso = $conn->query($queryEmProcesso);
                            $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                            // Exibindo os resultados no gráfico
                            echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                            ?>
                        ],
                        labels: ['Recebida', 'Em análise', 'Em processo'],
                        title: {
                            text: 'Quantidade de Reclamações em aberto',
                            align: 'center'
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: true,
                                    formatter: function (val, opts) {
                                        return opts.w.globals.series[opts.seriesIndex];
                                    }
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return val;
                                }
                            }
                        },
                        colors: ['#FF5722', '#9E9E9E', '#0331f4'] // Laranja escuro, azul escuro, cinza
                    };

                    var chart7 = new ApexCharts(document.querySelector("#piechart7"), options7);
                    chart7.render();
                });
            </script>
        </div>
    </div>

    <div class="charts">
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Ouvidoria Externa por Mês</h5>
            <div id="monthly-chart7"></div>
        </div>
        <div class="charts-card">
            <h5 class="chart-title"><br> Quantidade de Ouvidoria Externa por Ano</h5>
            <div id="annual-chart7"></div>
        </div>
    </div>

    <div class="charts14">
        <div class="charts-card14">
            <h5 class="chart-title10">Quantidade de Ouvidoria Externa</h5>
            <div id="chart-container5"></div>
            <button id="toggle-btn5">Mostrar por Ano</button>
        </div>
    </div>
</div>

<!-- Scripts para gráficos -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados simulados para os meses
    var monthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [{
            name: 'Ouvidoria Interna',
            data: [
                <?php 
                // Inicializar array para contagem mensal
                $monthlyReclamação = array_fill(1, 12, 0);

                // Consulta SQL para contar registros de "Reclamação" por mês
                $queryReclamação = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Interna' GROUP BY month";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $monthlyReclamação[(int)$row['month']] = $row['count'];
                    }
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $monthlyReclamação);
                ?>
            ]
        }]
    };

    var startYear = 2024;
    var endYear = startYear + 10; // Gera anos até 2034 (ou ajuste esse valor conforme necessário)
    var years = [];

    for (var year = startYear; year <= endYear; year++) {
        years.push(year.toString());
    }

    var annualData = {
        labels: years,
        series: [{
            name: 'Ouvidoria Interna',
            data: [
                <?php 
                // Inicializar array para contagem anual
                $annualReclamacoes = array();

                // Consulta SQL para contar registros de "Reclamação" por ano
                $queryReclamação = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_ouvidoria = 'Interna' GROUP BY year";
                $resultReclamação = $conn->query($queryReclamação);

                if ($resultReclamação) {
                    while ($row = $resultReclamação->fetch_assoc()) {
                        $year = (int)$row['year'];
                        $annualReclamacoes[$year] = $row['count'];
                    }
                }

                // Preenchendo os dados para cada ano na sequência
                $dataReclamação = [];
                for ($year = 2024; $year <= 2034; $year++) {
                    $dataReclamação[] = isset($annualReclamacoes[$year]) ? $annualReclamacoes[$year] : 0;
                }

                // Imprimir dados no formato esperado
                echo implode(", ", $dataReclamação);
                ?>
            ]
        }]
    };

    // Gráfico de Quantidade de Serviços por Mês
    var optionsMonthly7 = {
        series: monthlyData.series,
        chart: {
            type: 'bar',
            height: 400
        },
        xaxis: {
            categories: monthlyData.labels
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartMonthly7 = new ApexCharts(document.querySelector("#monthly-chart7"), optionsMonthly7);
    chartMonthly7.render();

    // Gráfico de Quantidade de Serviços por Ano
    var optionsAnnual7 = {
        series: annualData.series,
        chart: {
            type: 'line',
            height: 400
        },
        xaxis: {
            categories: annualData.labels
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 2
        },
        markers: {
            size: 5
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#808080', '#FF5722', '#003f5c']
    };
    var chartAnnual7 = new ApexCharts(document.querySelector("#annual-chart7"), optionsAnnual7);
    chartAnnual7.render();

    // Gráfico de Quantidade de Reclamações com Toggle
    var chartOptions5 = {
        chart: {
                type: 'area', // Gráfico de área
                height: 400
            },
            xaxis: {
                categories: monthlyData.labels
            },
            series: monthlyData.series,
            dataLabels: {
                enabled: true
            },
            stroke: {
                width: 2
            },
            markers: {
                size: 5
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            colors: ['#FF5722', '#4CAF50']
        };

    var chart5 = new ApexCharts(document.querySelector("#chart-container5"), chartOptions5);
    chart5.render();

    var isMonthly = true;
    document.getElementById('toggle-btn5').addEventListener('click', function() {
        var button = this;
        if (isMonthly) {
            chart2.updateOptions({
                xaxis: {
                    categories: annualData.labels
                },
                series: annualData.series
            });
            button.textContent = 'Mostrar por Mês';
        } else {
            chart2.updateOptions({
                xaxis: {
                    categories: monthlyData.labels
                },
                series: monthlyData.series
            });
            button.textContent = 'Mostrar por Ano';
        }
        isMonthly = !isMonthly;
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.js"></script>
<!-- Seção de Denúncias -->
<div class="collapse" id="collapseExample9" data-parent="#myGroup">
<p>Denúncias</p>
<div class="charts5">
    <div class="charts-card5">
        <h5 class="chart-title5"><br> Denúncias</h5>
       
        <!-- Inclua o CSS do ApexCharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.js"></script>
        
        <!-- Primeiro Gráfico de Pizza -->
        <div id="piechart3" style="width: 500px; height: 300px;"></div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Dados para o gráfico de Denúncias
                var options3 = {
                    chart: {
                        type: 'pie',
                        height: 300
                    },
                    series: [
                        <?php 
                        // Consulta SQL para contar o número de registros com Status "Recebida" e tipo_servico "Denúncia"
                        $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_servico = 'Denúncia'";
                        $resultRecebida = $conn->query($queryRecebida);
                        $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em análise" e tipo_servico "Denúncia"
                        $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_servico = 'Denúncia'";
                        $resultEmAnalise = $conn->query($queryEmAnalise);
                        $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em processo" e tipo_servico "Denúncia"
                        $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_servico = 'Denúncia'";
                        $resultEmProcesso = $conn->query($queryEmProcesso);
                        $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                        // Exibindo os resultados no gráfico
                        echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                        ?>
                    ],
                    labels: ['Recebida', 'Em análise', 'Em processo'],
                    title: {
                        text: 'Quantidade de Denúncias em aberto',
                        align: 'center'
                    },
                    plotOptions: {
                        pie: {
                            dataLabels: {
                                enabled: true,
                                formatter: function (val, opts) {
                                    // Retorna o número da série sem porcentagem
                                    return opts.w.globals.series[opts.seriesIndex];
                                }
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                // Exibe o número no tooltip sem porcentagem
                                return val;
                            }
                        }
                    },
                    colors: ['#FF5722', '#9E9E9E', '#0331f4'] // Laranja escuro, azul escuro, cinza
                };

                // Criação do gráfico
                var chart3 = new ApexCharts(document.querySelector("#piechart3"), options3);
                chart3.render();
            });
        </script>
    </div>
</div>

<div class="charts">
    <div class="charts-card">
        <h5 class="chart-title"><br>
        Quantidade de Denúncias por Mês</h5>
        <div id="monthly-chart3"></div>
    </div>
    <div class="charts-card">
        <h5 class="chart-title"><br>
        Quantidade de Denúncias por Ano</h5>
        <div id="annual-chart3"></div>
    </div>
</div>
<div class="charts6">
<div class="charts-card6">
    <h5 class="chart-title6">Quantidade de Denúncias</h5>
    <div id="chart-container"></div>
    <button id="toggle-btn">Mostrar por Ano</button>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
<!-- Custom JS -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dados simulados para os meses
    var monthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
            {
                name: 'Denúncias',
                data: [
                    <?php 
                    // Inicializar array para contagem mensal
                    $monthlyDenuncias = array_fill(1, 12, 0);

                    // Consulta SQL para contar registros de "Denúncia" por mês
                    $queryDenuncias = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Denúncia' GROUP BY month";
                    $resultDenuncias = $conn->query($queryDenuncias);

                    if ($resultDenuncias) {
                        while ($row = $resultDenuncias->fetch_assoc()) {
                            $monthlyDenuncias[(int)$row['month']] = $row['count'];
                        }
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $monthlyDenuncias);
                    ?>
                ]
            },
           
                ]
            }
    

    var startYear = 2024;
    var endYear = startYear + 10; // Gera anos até 2034 (ou ajuste esse valor conforme necessário)
    var years = [];

    for (var year = startYear; year <= endYear; year++) {
        years.push(year.toString());
    }

    var annualData = {
        labels: years,
        series: [
            {
                name: 'Denúncia',
                data: [
                    <?php 
                    // Inicializar array para contagem anual
                    $annualDenuncias = array();

                    // Consulta SQL para contar registros de "Denúncia" por ano
                    $queryDenuncias = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Denúncia' GROUP BY year";
                    $resultDenuncias = $conn->query($queryDenuncias);

                    if ($resultDenuncias) {
                        while ($row = $resultDenuncias->fetch_assoc()) {
                            $year = (int)$row['year'];
                            $annualDenuncias[$year] = $row['count'];
                        }
                    }

                    // Preenchendo os dados para cada ano na sequência
                    $dataDenuncias = [];
                    for ($year = 2024; $year <= 2034; $year++) {
                        $dataDenuncias[] = isset($annualDenuncias[$year]) ? $annualDenuncias[$year] : 0;
                    }

                    // Imprimir dados no formato esperado
                    echo implode(", ", $dataDenuncias);
                    ?>
                ]
            },
           
                ]
            }

    // Gráfico de Quantidade de Serviços por Mês
    var optionsMonthly3 = {
        series: monthlyData.series,
        chart: {
            type: 'bar',
            height: 400
        },
        xaxis: {
            categories: monthlyData.labels
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#808080', '#FF5722', '#003f5c'] // Cinza para Denúncias, Laranja para Reclamações, Azul para Sugestões
    };
    var chartMonthly3 = new ApexCharts(document.querySelector("#monthly-chart3"), optionsMonthly3);
    chartMonthly3.render();

    // Gráfico de Quantidade de Serviços por Ano
    var optionsAnnual3 = {
        series: annualData.series,
        chart: {
            type: 'line',
            height: 400
        },
        xaxis: {
            categories: annualData.labels
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 2
        },
        markers: {
            size: 5
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['#808080', '#FF5722', '#003f5c'] // Cinza para Denúncias, Laranja para Reclamações, Azul para Sugestões
    };
    var chartAnnual3 = new ApexCharts(document.querySelector("#annual-chart3"), optionsAnnual3);
    chartAnnual3.render();
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
<?php
// Consultas SQL para obter a quantidade de denúncias recebidas e resolvidas por mês e ano
$queryMonthly = "SELECT MONTH(data_registro) as month, 
SUM(CASE WHEN status = 'Recebida' THEN 1 ELSE 0 END) as received, 
SUM(CASE WHEN status = 'Concluída' THEN 1 ELSE 0 END) as resolved 
FROM Ouvidoria_registros 
WHERE tipo_servico = 'Denúncia' 
GROUP BY MONTH(data_registro)";
$resultMonthly = $conn->query($queryMonthly);
$monthlyData = array_fill(1, 12, ['received' => 0, 'resolved' => 0]);

while ($row = $resultMonthly->fetch_assoc()) {
$month = (int)$row['month'];
$monthlyData[$month]['received'] = (int)$row['received'];
$monthlyData[$month]['resolved'] = (int)$row['resolved'];
}

$queryAnnual = "SELECT YEAR(data_registro) as year, 
SUM(CASE WHEN status = 'Recebida' THEN 1 ELSE 0 END) as received, 
SUM(CASE WHEN status = 'Concluída' THEN 1 ELSE 0 END) as resolved 
FROM Ouvidoria_registros 
WHERE tipo_servico = 'Denúncia' 
GROUP BY YEAR(data_registro)";
$resultAnnual = $conn->query($queryAnnual);
$annualData = [];
$years = [];
while ($row = $resultAnnual->fetch_assoc()) {
$year = (int)$row['year'];
$annualData[$year] = [
'received' => (int)$row['received'],
'resolved' => (int)$row['resolved']
];
if (!in_array($year, $years)) {
$years[] = $year;
}
}

// Feche a conexão
$conn->close();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var monthlyData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [{
                name: 'Recebidas',
                data: <?php echo json_encode(array_column($monthlyData, 'received')); ?>
            }, {
                name: 'Concluídas',
                data: <?php echo json_encode(array_column($monthlyData, 'resolved')); ?>
            }]
        };

        var annualData = {
            labels: <?php echo json_encode($years); ?>,
            series: [{
                name: 'Recebidas',
                data: <?php echo json_encode(array_column($annualData, 'received')); ?>
            }, {
                name: 'Concluída',
                data: <?php echo json_encode(array_column($annualData, 'resolved')); ?>
            }]
        };

        var chartOptions = {
            chart: {
                type: 'area', // Gráfico de área
                height: 400
            },
            xaxis: {
                categories: monthlyData.labels
            },
            series: monthlyData.series,
            dataLabels: {
                enabled: true
            },
            stroke: {
                width: 2
            },
            markers: {
                size: 5
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            colors: ['#FF5722', '#4CAF50']
        };

        var chart = new ApexCharts(document.querySelector("#chart-container"), chartOptions);
        chart.render();

        var isMonthly = true; // Estado inicial: dados mensais

        document.getElementById('toggle-btn').addEventListener('click', function() {
            var button = this;
            if (isMonthly) {
                chart.updateOptions({
                    xaxis: {
                        categories: annualData.labels
                    },
                    series: annualData.series
                });
                button.textContent = 'Mostrar por Ano';
            } else {
                chart.updateOptions({
                    xaxis: {
                        categories: monthlyData.labels
                    },
                    series: monthlyData.series
                });
                button.textContent = 'Mostrar por Mês';
            }
            isMonthly = !isMonthly; // Alterna o estado
        });
    });
    </script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.js"></script>
<!-- Seção de Denúncias -->

    </script>




    </div>
</div>



</body>
</html>
<style>
   .container2{
    margin-left: 353px;

   }
     
   .main-container {
            padding: 20px;
        }
        
        .main-title {
            margin-bottom: 20px;
        }
        
        .main-cards1 {
    display: flex;
    justify-content: space-between;
    margin-bottom: 66px;
    margin-left: -398px;
    margin-top: 0px;
    gap: 80px;
}
        
        .card1 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 22%;
        }
        
        .card-inner1 {
            margin-bottom: 10px;
        }
        
        .card-inner h3 {
            margin: 0;
        }
        .card2 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 22%;
        }
        
        .card-inner2 {
            margin-bottom: 10px;
        }
        
        .card-inner2 h3 {
            margin: 0;
        }
        .card3 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 22%;
        }
        
        .card-inner3 {
            margin-bottom: 10px;
        }
        
        .card-inner3 h3 {
            margin: 0;}
            .card4 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 22%;
        }
        
        .card-inner4 {
            margin-bottom: 10px;
        }
        
        .card-inner4 h3 {
            margin: 0;}
        


.charts {
    display: flex;
    flex-wrap: nowrap;
    gap: 132px;
    margin-left: -100px;
    padding: 0px;
    flex-direction: row;
}
    .charts-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        
        .chart-title {
            margin-bottom: 20px;
        }
        
        #monthly-chart, #annual-chart {
            height: 400px;
        }

        .charts2 {
    display: flex;
    flex-wrap: nowrap;
    gap: 132px;
    margin-left: -107px;
    padding: 0px;
    flex-direction: row;
    margin-top: 27px;
}
        .charts-card2 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        
        .chart-title2 {
            margin-bottom: 20px;
        }
        
        #monthly-chart2, #annual-chart2 {
            height: 400px;
        }
    
        .charts-card3 {
          
    background: white;
    padding: 0px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 480px;
    top: 5px;
    display: flex;
    flex-direction: column;
        }
        
        .chart-title3 {
            margin-bottom: 20px;
        }
        
        .charts3 {
    display: flex;
    flex-wrap: nowrap;
    gap: 132px;
    margin-left: -107px;
    padding: 40px;
    flex-direction: row;
    margin-top: -457px;
}
.charts-card4 {
          
          background: white;
          padding: 0px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          width: 100%;
          max-width: 480px;
          top: 5px;
          display: flex;
          flex-direction: column;
              }
              
              .chart-title4 {
                  margin-bottom: 20px;
              }
              
              .charts4 {
    display: flex;
    flex-wrap: nowrap;
    gap: 55px;
    margin-left: 525px;
    padding: 40px;
    margin-top: 2px;
    flex-direction: row;
}

      .charts-card5 {
          
          background: white;
          padding: 0px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          width: 100%;
          max-width: 480px;
          top: 5px;
          display: flex;
          flex-direction: column;
              }
              
              .chart-title5 {
                  margin-bottom: 20px;
              }
              
              .charts5 {
    display: flex;
    gap: 132px;
    margin-left: -90px;
    padding: 40px;
    margin-top: 2px;
    flex-direction: row;
    align-content: center;
    justify-content: center;
    flex-wrap: wrap;
}
     

.charts-card6 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .charts6{
    display: flex;
    gap: 132px;
    margin-left: -37px;
    padding: 40px;
    margin-top: 2px;
    flex-direction: row;
    align-content: center;
    justify-content: center;
    flex-wrap: wrap;
}



      .charts-card5 {
          
          background: white;
          padding: 0px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          width: 100%;
          max-width: 480px;
          top: 5px;
          display: flex;
          flex-direction: column;
              }
              
              .chart-title5 {
                  margin-bottom: 20px;
              }
              
              .charts5 {
    display: flex;
    gap: 132px;
    margin-left: -72px;
    padding: 40px;
    margin-top: 2px;
    flex-direction: row;
    align-content: center;
    justify-content: center;
    flex-wrap: wrap;
}
     

.charts-card6 {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .charts6 {
    display: flex;
    gap: 132px;
    margin-left: -72px;
    padding: 40px;
    margin-top: 2px;
    flex-direction: row;
    align-content: center;
    justify-content: center;
    flex-wrap: wrap;
}
.navbar-nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    padding-left: 0;
    margin-bottom: -33px;
    list-style: none;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: space-around;
    margin-left: -491px;
    font-family: sans-serif;
}
p {
    margin-left: 345px;
    margin-top: 11px;
    margin-bottom: 1rem;
    /* font-family: math; */
    font-size: xxx-large;
    font-family: 'Horyzen Headline';
}

    .charts7, .charts8 .charts9, .charts10 ,.charts11,.charts12,.charts13,.charts14{
    margin: 20px;
    padding: 15px;
    border-radius: 8px;
    background-color: #f4f4f4;
    margin-left: 303px;
}
.charts8 {    margin: 20px;
    padding: 15px;
    border-radius: 8px;
    background-color: #f4f4f4;
    margin-left: 303px;}



    .charts9{margin: 20px;
    padding: 15px;
    border-radius: 8px;
    background-color: #f4f4f4;
    margin-left: 303px;}



    .charts11 {    margin: 20px;
    padding: 15px;
    border-radius: 8px;
    background-color: #f4f4f4;
    margin-left: 303px;}

.charts-card7, .charts-card8,.charts-card9,.charts-card10,.charts-card11,.charts-card12,.charts-card13,.charts-card14{
    background: white;
          padding: 0px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          width: 100%;
          max-width: 480px;
          top: 5px;
          display: flex;
          flex-direction: column;
              }
.charts-card, .charts-card8,.charts-card10  {
    padding: 20px;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Estilos para o título dos gráficos */
.chart-title7, .chart-title8 , .chart-title9 , .chart-title10 .chart-title11 .chart-title12 ,.chart-title13 ,.chart-title14{
    font-size: 1.25em;
    margin-bottom: 15px;
    color: #333;
}

/* Estilos para o botão de alternar */
#toggle-btn {
    background-color: #FF5722;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s;
}

#toggle-btn:hover {
    background-color: #e64a19;
}

/* Estilos para os gráficos */
#piechart4, #monthly-chart4, #annual-chart4, #chart-container2 {
    margin: 0 auto;
    max-width: 100%;
}

/* Estilos para o gráfico de pizza */
#piechart4 {
    height: 300px;
}

/* Estilos para os gráficos de linha e barra */
#monthly-chart4, #annual-chart4 {
    height: 400px;
}

/* Responsividade */
@media (max-width: 768px) {
    .charts-card, .charts-card7, .charts-card8 {
        padding: 15px;
    }

    .chart-title7, .chart-title8 {
        font-size: 1.1em;
    }

    #toggle-btn {
        padding: 8px 15px;
        font-size: 0.9em;
    }
}

@media (max-width: 480px) {
    .charts-card, .charts-card7, .charts-card8 {
        padding: 10px;
    }

    .chart-title7, .chart-title8 {
        font-size: 1em;
    }

    #toggle-btn {
        padding: 6px 12px;
        font-size: 0.8em;
    }
}

      </style>
  <script>document.addEventListener('DOMContentLoaded', function () {
    // Seleciona todos os links que acionam os collapses
    const links = document.querySelectorAll('[data-toggle="collapse"]');
    // Seleciona todos os collapses
    const collapses = document.querySelectorAll('.collapse');

    links.forEach((link, index) => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Previne o comportamento padrão do link
            
            // Obtém o colapso correspondente ao índice do link clicado
            const targetCollapse = collapses[index];

            // Fecha todos os collapses que não são o colapso clicado
            collapses.forEach((collapse, idx) => {
                if (collapse !== targetCollapse) {
                    collapse.classList.remove('show');
                }
            });

            // Alterna a visibilidade do colapso clicado
            targetCollapse.classList.toggle('show');
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var collapse = document.getElementById('collapseExample1');
    var collapse30 = document.getElementById('collapseExample8');
    
    // Função para copiar apenas o conteúdo relacionado a "Denúncias"
    function copyDenunciasContent() {
        // Encontrar e copiar o conteúdo relacionado a "Denúncias"
        var denunciasContent = collapse1.querySelector('.main-cards1').innerHTML;
        
        // Limpar o conteúdo atual em collapseExample8
        collapse.innerHTML = '';
        
        // Adicionar o conteúdo de denúncias em collapseExample8
        collapse.innerHTML = denunciasContent;
    }
    
    // Copiar o conteúdo quando o collapseExample1 for exibido
    collapse1.addEventListener('shown.bs.collapse', copyDenunciasContent);
    
    // Opcional: ocultar collapseExample8 quando collapseExample1 for ocultado
    collapse1.addEventListener('hidden.bs.collapse', function () {
        collapse8.innerHTML = ''; // Limpar o conteúdo
    });
});

</script> 
