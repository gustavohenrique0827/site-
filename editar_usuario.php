<?php
session_start();
include('conexao2.php'); // Conectar ao banco de dados

// Verificar se o usuário está logado e é um administrador
if (!isset($_SESSION['user_Perfil']) || $_SESSION['user_Perfil'] !== 'administrador') {
    header('Location: login.php'); // Redirecionar para a página de login se não estiver logado ou não for administrador
    exit();
}

// Verificar se o ID do usuário foi passado via GET
if (!isset($_GET['id'])) {
    header('Location: index.php'); // Redirecionar se não houver ID
    exit();
}

$id = intval($_GET['id']); // Sanear o ID

// Buscar os dados do usuário
$stmt = $conexao->prepare("SELECT * FROM `usuarios da empresa` WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header('Location: index.php'); // Redirecionar se o usuário não for encontrado
    exit();
}

// Processar o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletar e sanitizar os dados do formulário
    $novoNome = trim($_POST['nome']);
    $novoEmail = trim($_POST['email']);
    $novoPerfil = $_POST['perfil'];
    $ativo = isset($_POST['ativo']) ? 1 : 0;
    
    // Verificar se a senha foi fornecida
    $novaSenha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    
    // Inicializar um array para os parâmetros e a query
    $params = [];
    $query = "UPDATE `usuarios da empresa` SET nome = ?, email = ?, Perfil = ?, ativo = ?";
    $params = [$novoNome, $novoEmail, $novoPerfil, $ativo];
    
    // Se uma nova senha foi fornecida, adicionar à query
    if (!empty($novaSenha)) {
        // Hash da nova senha
        $hashSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
        $query .= ", senha = ?";
        $params[] = $hashSenha;
    }
    
    $query .= " WHERE id = ?";
    $params[] = $id;
    
    // Preparar e executar a declaração
    $stmt = $conexao->prepare($query);
    
    try {
        $stmt->execute($params);
        header('Location: index.php'); // Redirecionar após a atualização
        exit();
    } catch (PDOException $e) {
        // Tratar erros, por exemplo, mostrar uma mensagem de erro
        echo "Erro ao atualizar o usuário: " . $e->getMessage();
    }
}
?>

<?php include 'cabeçarioadm.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário - Dineng Administrativo</title>
    <link rel="stylesheet" href="sugest.css">
    
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    value="<?php echo htmlspecialchars($usuario['nome']); ?>" 
                    required
                >
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="<?php echo htmlspecialchars($usuario['email']); ?>" 
                    required
                >
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input 
                    type="password" 
                    id="senha" 
                    name="senha" 
                    placeholder="Deixe em branco para não alterar"
                >
            </div>
            <div class="form-group">
                <label for="perfil">Perfil:</label>
                <select id="perfil" name="perfil" class="form-control" required>
                    <option value="usuario" <?php echo $usuario['Perfil'] === 'usuario' ? 'selected' : ''; ?>>Usuário</option>
                    <option value="administrador" <?php echo $usuario['Perfil'] === 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ativo">Ativo:</label>
                <input 
                    type="checkbox" 
                    id="ativo" 
                    name="ativo" 
                    <?php echo $usuario['ativo'] ? 'checked' : ''; ?>
                >
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="Adiministrativo.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
