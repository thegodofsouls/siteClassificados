<?php
     require('pages/header.php');
     require('pages/footer.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
      <div class="container">
          <h1>Cadastre-se</h1>
          <?php
           //se esta preenchino e nao vazio
           if(isset($_POST['nome']) && !empty($_POST['nome']))
           {      
                  $nome = addslashes($_POST['nome']);
                  $email = addslashes($_POST['email']);
                  $senha = $_POST['senha'];
                  $telefone = addslashes($_POST['telefone']);
      
                //verificaçao se os campos foram preenchidos após cadastrar
                if(!empty($nome) && !empty($email) && !empty($senha))
                {
                     if($u->cadastrar($nome, $email, $senha, $telefone))
                     {
                         ?>
                           <div class="alert alert-success">
                               <strong>Parabéns!</strong>Cadastrado com sucesso. <a href="login.php" class="alert-link">Faça o login agora</a>
                           </div>
                         <?php
                     }
                     else
                     {
                        ?>
                          <div class="alert alert-warning">
                               Este usuário já existe!<a href="login.php" class="alert-link">Faça o login agora</a>
                           </div>
                        <?php
                     }
                }
                else
                { 
                     ?>
                          <div class="alert alert-warning">
                               Preencha todos os campos!
                           </div>
                    <?php
                  
                }
           }

          ?>

          <form method="post">
              <div class="form-group">
                 <label for="nome">Nome:</label>
                 <input type="text" name="nome" id="nome" class="form-control" placeholder="seu nome por favor..." />
              </div>
              <div class="form-group">
                 <label for="email">E-mail:</label>
                 <input type="email" name="email" id="email" class="form-control" placeholder="seu e-mail por favor..." />
              </div>
              <div class="form-group">
                 <label for="senha">Senha:</label>
                 <input type="password" name="senha" id="senha" class="form-control" placeholder="sua senha por favor..." />
              </div>
              <div class="form-group">
                 <label for="telefone">Telefone:</label>
                 <input type="text" name="telefone" id="telefone" class="form-control" onkeyup="mascaraCampo()" onkeypress="return somenteNumeros(event)" placeholder="seu telefone por favor..." />
              </div>

              <button type="submit"class="btn btn-primary">Cadastrar</button>
          </form>
      </div>
</body>
</html>