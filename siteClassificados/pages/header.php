<?php 
    require('conexao.php');
    require('class/usuarios.class.php');
    $u = new Usuarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificados</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
    <!-- barra de navegaçao no top -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- cabeçalho do nav -->
            <div class="navbar-header">
                <a class="nav-link text-light" href="index.php">Classificados</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <!-- row transforma os li em linha -->
                <div class="row">
                <?php 
                //se existir uma sessao e ela nao estiver vazia
                if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): 
                ?>
                <li><a href="meus-anuncios.php" class="text-light mr-lg-4">Meus Anúncios</a></li>
                <li><a href="" class="text-light mr-lg-4"><?php
                   
                    $nameuser = $u->getNamelogin();
                    echo "Bem vindo(a) ".$nameuser['email'];
                   
                ?></a></li>
                <li><a href="sair.php" class="text-light ml-lg-0">Sair</a></li> 
                <?php 
                //caso contrário
                else: ?>
                <li><a href="cadastre-se.php" class="text-light mr-lg-4">Cadastre-se</a></li>
                <li><a href="login.php" class="text-light ml-lg-0">Login</a></li> 
                </div>
                <?php endif; ?>
                </ul>
        
        </div>
    </nav>
</body>
</html>