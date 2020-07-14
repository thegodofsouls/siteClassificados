<?php
     require('pages/header.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
      <div class="container">
     <?php
      //se existe o email para logar
     if(isset($_POST['email']) && !empty($_POST['email']))
       {      
          $email = addslashes($_POST['email']);
          $senha = $_POST['senha'];

          if($u->login($email, $senha))
          {
              ?>
               <script type="text/javascript">window.location.href="./";</script>
              <?php
          }
          else
          {
               ?>
                  <div class="alert alert-danger">
                    Usuário e/ou Senha errados!
                  </div>
               <?php
          }
       }
?>
       <form method="post">
       <div class="form-group">
         <label for="email">seu Email:</label>
         <input type="email" class="form-control" name="email" placeholder="Entre com o email" required>
       </div>
       <div class="form-group">
         <label for="senha">sua senha:</label>
         <input type="password" class="form-control" name="senha" placeholder="Entre com a sua senha" required id="senha">
         <img src="img/eye-hide.png" class="hand" width="50" height="50" onclick="mostrarSenha()">
       </div>

      <button type="submit" class="btn btn-success">Fazer Login</button> 
   </form>
   <?php
       require('pages/footer.php');
   ?>
   </div>
</body>
</html>
       
       


   



    