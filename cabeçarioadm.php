<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fala Dineng</title>
    <!-- CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Adiministrativo.css">
    <link rel="stylesheet" href="cabeçarioadm.css">
  
</head>
<body>
    <!-- Cabeçalho -->
    <header2 class="header text-center py-3 d-flex align-items-center justify-content-between">
           
        </a>
        <h1 class="dineng1"></h1>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <a class="dropdown-item" href="cadastro.php">Cadastro</a>
                            <a class="dropdown-item" href="sair.php">Sair</a>
                        </div>
                    </li>
                    <!-- Outros links -->
                    <li class="nav-item"><a class="nav-link" href="Quem Somos.php">Quem somos</a></li>
                    <li class="nav-item"><a class="nav-link" href="rastreamento.php">Solicitações</a></li>
                    <li class="nav-item"><a class="nav-link" href="RQ. 45 - Código de Ética.pdf">Código de Ética</a></li>
                </ul>
            </div>
        </nav>
        <div class="user-profile d-flex align-items-center">
            <img src="imagens botoes/User_icon_2.svg.png" alt="Foto do Usuário" style="height: 50px;">
            <div class="user-info text-left">
                <h2 id="user-name" style="margin: 0; font-size: 1.2rem;"><?= $_SESSION['nome']; ?></h2>
                <p id="user-Perfil" style="margin: 0; font-size: 1rem;"><?= $_SESSION['user_Perfil'];?></p>
            </div>
        </div>
    </header2>

    <!-- Conteúdo Principal -->
    <div class="content">
        <!-- Conteúdo da página aqui -->
    </div>

    <!-- Rodapé -->
    <footer class="footer text-center py-2 text-white">
        <img src="imagens botoes/Dineng_Logo_02.png" alt="Logo" style="height: 20px;">
        &copy; 2024 Dineng Ouvidoria. Todos os direitos reservados.
    </footer>

    <!-- Scripts do Bootstrap e JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
