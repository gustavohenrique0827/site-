<?php 

try {
    $conexao = new PDO('mysql:host=dinsis.mysql.uhserver.com;dbname=dinsis', 'dineng', 'Dineng@2024');
    // Defina o modo de erro do PDO para exceções
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    // Captura o erro e exibe a mensagem de erro e o código do erro
    echo "Erro de conexão: " . $erro->getMessage();
    echo "<br>Código do erro: " . $erro->getCode();
}
?>
