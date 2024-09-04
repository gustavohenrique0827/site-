<?php
session_start();

// Verifica se o usuário já está logado e redireciona para a página administrativa
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header('Location: Adiministrativo.php');
    exit;
}

// Verifica se o formulário foi enviado
if (isset($_POST['entrar'])) {
    
include 'conexao2.php'; // Inclui a conexão com o banco de dados

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Salva o usuário em um cookie
    setcookie('usuario', $usuario, time() + (86400 * 30), "/"); // Cookie expira em 30 dias

    // Verifica se as credenciais correspondem ao usuário e senha fixos para acesso administrativo
    if ($usuario === 'admin' && $senha === 'admin') {
        $_SESSION['logado'] = true;
        $_SESSION['nome'] = 'Administrador';
        $_SESSION['user_Perfil'] = 'Administrador'; // Define o perfil como Administrador
        header('Location: Adiministrativo.php');
        exit;
    }

    // Consulta no banco de dados para verificar o usuário
    $dados = $conexao->prepare("SELECT id, senha, nome, Perfil FROM `usuarios da empresa` WHERE usuario = :usuario");
    $dados->bindValue(':usuario', $usuario);
    $dados->execute();


    // Se o usuário foi encontrado
    if ($dados->rowCount() > 0) {
        $user = $dados->fetch(PDO::FETCH_OBJ);

        // Verifica a senha com o hash armazenado no banco de dados
        if (password_verify($senha, $user->senha)) {
            $_SESSION['logado'] = true;
            $_SESSION['nome'] = $user->nome;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_Perfil'] = $user->Perfil; // Armazena o perfil do usuário na sessão
            header('Location: Adiministrativo.php');
            exit;
        } else {
            $mensagemErro = "Usuário e/ou senha incorretos!";
        }
    } else {
        $mensagemErro = "Usuário e/ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include 'cabeçario2.html'?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dineng Ouvidoria</title>
  <link rel="stylesheet" href="login.css">
    <script src="denuncia.js" defer></script>
    
</head>
<body>
   
    <h1 class="dineng1">Login</h1>

    <div class="container container-login">
        <form action="" method="POST">
            <h3>Login</h3>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Digite seu usuário..." value="<?php if (isset($_COOKIE['usuario'])) { echo htmlspecialchars($_COOKIE['usuario']); } ?>" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha..." required>
            </div>
            <?php
            // Exibe a mensagem de erro, se houver
            if (isset($mensagemErro)) {
                echo "<div id='aviso' class='alert'>$mensagemErro</div>";
            }
            ?>
            <button type="submit" name="entrar" class="btn-primary">Entrar</button>
        </form>
    </div>
</body>
</html>
