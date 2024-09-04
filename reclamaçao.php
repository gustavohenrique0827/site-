

    <p>Reclamações</p>
<div class="charts5">
    <div class="charts-card5">
        <h5 class="chart-title5"><br> Reclamação</h5>
       
        <!-- Inclua o CSS do ApexCharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.js"></script>
        
        <!-- Primeiro Gráfico de Pizza -->
        <div id="piechart4" style="width: 500px; height: 300px;"></div>
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
                        $queryRecebida = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Recebida' AND tipo_servico = 'Reclamação'";
                        $resultRecebida = $conn->query($queryRecebida);
                        $countRecebida = $resultRecebida ? $resultRecebida->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em análise" e tipo_servico "Denúncia"
                        $queryEmAnalise = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em analise' AND tipo_servico = 'Reclamação'";
                        $resultEmAnalise = $conn->query($queryEmAnalise);
                        $countEmAnalise = $resultEmAnalise ? $resultEmAnalise->fetch_assoc()['count'] : 0;

                        // Consulta SQL para contar o número de registros com Status "Em processo" e tipo_servico "Denúncia"
                        $queryEmProcesso = "SELECT COUNT(*) as count FROM Ouvidoria_registros WHERE Status = 'Em processo' AND tipo_servico = 'Reclamação'";
                        $resultEmProcesso = $conn->query($queryEmProcesso);
                        $countEmProcesso = $resultEmProcesso ? $resultEmProcesso->fetch_assoc()['count'] : 0;

                        // Exibindo os resultados no gráfico
                        echo $countRecebida . ", " . $countEmAnalise . ", " . $countEmProcesso;
                        ?>
                    ],
                    labels: ['Recebida', 'Em análise', 'Em processo'],
                    title: {
                        text: 'Quantidade de Reclamação em aberto',
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
                var chart4 = new ApexCharts(document.querySelector("#piechart4"), options4);
                chart4.render();
            });
        </script>
    </div>
</div>

<div class="charts">
    <div class="charts-card">
        <h5 class="chart-title"><br>
        Quantidade de Reclamações por Mês</h5>
        <div id="monthly-chart4"></div>
    </div>
    <div class="charts-card">
        <h5 class="chart-title"><br>
        Quantidade de Reclamações por Ano</h5>
        <div id="annual-chart4"></div>
    </div>
</div>
<div class="charts6">
<div class="charts-card6">
    <h5 class="chart-title6">Quantidade de Reclamações</h5>
    <div id="chart-container2"></div>
    <button id="toggle-btn2">Mostrar por Ano</button>
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
                name: 'Reclamações',
                data: [
                    <?php 
                    // Inicializar array para contagem mensal
                    $monthlyDenuncias = array_fill(1, 12, 0);

                    // Consulta SQL para contar registros de "Denúncia" por mês
                    $queryDenuncias = "SELECT MONTH(data_registro) as month, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Reclamação' GROUP BY month";
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
                name: 'Reclamações',
                data: [
                    <?php 
                    // Inicializar array para contagem anual
                    $annualDenuncias = array();

                    // Consulta SQL para contar registros de "Denúncia" por ano
                    $queryDenuncias = "SELECT YEAR(data_registro) as year, COUNT(*) as count FROM Ouvidoria_registros WHERE tipo_servico = 'Reclamação' GROUP BY year";
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
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#808080', '#FF5722', '#003f5c'] // Cinza para Denúncias, Laranja para Reclamações, Azul para Sugestões
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
        colors: ['#808080', '#FF5722', '#003f5c'] // Cinza para Denúncias, Laranja para Reclamações, Azul para Sugestões
    };
    var chartAnnual4 = new ApexCharts(document.querySelector("#annual-chart4"), optionsAnnual4);
    chartAnnual4.render();
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
<?php
// Consultas SQL para obter a quantidade de denúncias recebidas e resolvidas por mês e ano
$queryMonthly = "SELECT MONTH(data_registro) as month, 
SUM(CASE WHEN status = 'Recebida' THEN 1 ELSE 0 END) as received, 
SUM(CASE WHEN status = 'Resolvida' THEN 1 ELSE 0 END) as resolved 
FROM Ouvidoria_registros 
WHERE tipo_servico = 'Reclamação' 
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
SUM(CASE WHEN status = 'Resolvida' THEN 1 ELSE 0 END) as resolved 
FROM Ouvidoria_registros 
WHERE tipo_servico = 'Reclamação' 
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
        var monthlyData2 = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [{
                name: 'Recebidas',
                data: <?php echo json_encode(array_column($monthlyData, 'received')); ?>
            }, {
                name: 'Resolvidas',
                data: <?php echo json_encode(array_column($monthlyData, 'resolved')); ?>
            }]
        };

        var annualData2 = {
            labels: <?php echo json_encode($years); ?>,
            series: [{
                name: 'Recebidas',
                data: <?php echo json_encode(array_column($annualData, 'received')); ?>
            }, {
                name: 'Resolvidas',
                data: <?php echo json_encode(array_column($annualData, 'resolved')); ?>
            }]
        };

        var chartOptions2 = {
            chart2: {
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

        var isMonthly = true; // Estado inicial: dados mensais

        document.getElementById('toggle-btn2').addEventListener('click', function() {
            var button = this;
            if (isMonthly) {
                chart.updateOptions({
                    xaxis: {
                        categories: annualData2.labels
                    },
                    series: annualData2.series
                });
                button.textContent = 'Mostrar por Ano';
            } else {
                chart.updateOptions({
                    xaxis: {
                        categories: monthlyData2.labels
                    },
                    series: monthlyData2.series
                });
                button.textContent = 'Mostrar por Mês';
            }
            isMonthly = !isMonthly; // Alterna o estado
        });
    });
    </script>
    </div>
    </div>