
<?php
$servername = "dinsis.mysql.uhserver.com";
$username = "dineng";
$password = "Dineng@2024";  // Insira a senha correta
$dbname = "dinsis";

// Conectar ao banco de dados
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verifica a conexão
    if ($conn->connect_error) {
        throw new Exception("Falha na conexão: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
