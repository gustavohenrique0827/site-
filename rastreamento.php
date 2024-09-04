<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <?php include "cabeçario.html" ?>
    <title>Solicitações</title>
    <link rel="stylesheet" href="chat.css"> <!-- Referência ao CSS do chatbot padronizado -->
    <link rel="stylesheet" href="ouvidoria_interna.css">
    <link rel="stylesheet" href="rastreio2.css">
    <link rel="stylesheet" href="ra.css">
    <script src="chat.js" defer></script> <!-- Referência ao JavaScript do chatbot -->
    <script src="rastear.js" defer></script> <!-- Referência ao JavaScript da página de rastreamento -->
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <h1 class="dineng1">Rastrear Solicitação</h1>
    </header>

    <!-- Navegação -->
    <nav>
        <!-- Navegação aqui -->
    </nav>

    <main class="container mt-4">
        <?php
            include "conexao.php";
            mysqli_set_charset($conn, "utf8");

            $classeResultado = ""; // Classe vazia inicialmente

            function consultarRegistro($conn, $codigoRastreamento) {
                $sql = "SELECT * FROM Ouvidoria_registros WHERE Codigo = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $codigoRastreamento);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result;
            }

            function consultarRegistro2($conn, $codigoRastreamento) {
                $sql = "SELECT * FROM Ouvidoria_observacoes WHERE codigo = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $codigoRastreamento);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result;
            }

            if (isset($_GET['codigo_rastreamento'])) {
                $codigoRastreamento = $_GET['codigo_rastreamento'];
                $result = consultarRegistro($conn, $codigoRastreamento);
                if ($result->num_rows > 0) {
                    $classeResultado = "result-found"; // Adiciona a classe quando houver resultados
                }
            }
        ?>

        <div class="tracking-content <?php echo $classeResultado; ?>">
            <section class="search-container">
                <h2>Código de Rastreamento:</h2>
                <form class="form-inline" method="get" action="">
                    <input type="text" id="codigo_rastreamento" name="codigo_rastreamento" class="form-control" required>
                    <button type="submit" class="btn btn-primary">Rastrear</button>
                </form>
            </section>

            <!-- Seção de Resultados -->
            <section class="results-container">
                <?php
                    if (isset($_GET['codigo_rastreamento'])) {
                        $codigoRastreamento = $_GET['codigo_rastreamento'];
                        $result = consultarRegistro($conn, $codigoRastreamento);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<h2>Resultado da Busca:</h2>";
                                echo "<p>Código de Rastreamento: " . htmlspecialchars($row['codigo']) . "</p>";
                                echo "<p>Data de Abertura: " . (new DateTime($row['data_registro']))->format('d/m/Y') . "</p>";
                                echo "<p>Status: " . htmlspecialchars($row['status']) . "</p>";
                                echo "<p>Descrição: " . htmlspecialchars($row['descricao_status']) . "</p>";
                            }
                        } else {
                            echo "<h2>Nenhum resultado encontrado.</h2>";
                        }
                    }
                ?>
            </section>

            <!-- Seção de Linha do Tempo -->
            <section class="timeline-container">
                <h2>Linha do Tempo:</h2>
                <ul class="timeline">
                    <?php
                        if (isset($_GET['codigo_rastreamento'])) {
                            $codigoRastreamento = $_GET['codigo_rastreamento'];
                            $result = consultarRegistro2($conn, $codigoRastreamento);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<li class='timeline-item'>";
                                    echo "<span class='timeline-date'>" . (new DateTime($row['Data1']))->format('d/m/Y H:i:s') . "</span>";
                                    echo "<div class='timeline-content'>";
                                    
                                    // Verifica se existe 'historico_status' ou 'observacao'
                                    if (!empty($row['historico_status']) && empty($row['observacao'])) {
                                        echo "<p>Status: " . htmlspecialchars($row['historico_status']) . "</p>";
                                    } elseif (empty($row['historico_status']) && !empty($row['observacao'])) {
                                        echo "<p>Observação: " . htmlspecialchars($row['observacao']) . "</p>";
                                    } elseif (!empty($row['historico_status']) && !empty($row['observacao'])) {
                                        echo "<p>Status: " . htmlspecialchars($row['historico_status']) . "</p>";
                                        echo "<p>Observação: " . htmlspecialchars($row['observacao']) . "</p>";
                                    } else {
                                        echo "<p>Sem informações disponíveis.</p>";
                                    }
                                    
                                    echo "</div>";
                                    echo "</li>";
                                }
                            } else {
                                echo "<p>Nenhuma observação encontrada para este código.</p>";
                            }
                        }
                    ?>
                </ul>
            </section>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <!-- Rodapé aqui -->
    </footer>
</body>
</html>
