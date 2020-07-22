<?php require('pages/header.php'); ?>
<?php
     //verificaçao de bloqueio se o usuario está logado para acessar os anuncios
     if(empty($_SESSION['cLogin']))
     {
         ?>
         <script type="text/javascript">window.location.href="login.php"</script>
         <?php
         exit;
     }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
      <div class="container">
       <h1>Meus Anúncios</h1>

       <a href="add-anuncio.php" class="btn btn-primary mb-lg-2">Adicionar Anuncio</a>

       <table class="table table-striped">
           <thead>
               <tr>
                   <th>Foto</th>
                   <th>Título</th>
                   <th>Valor</th>
                   <th>Ações</th>
               </tr>
           </thead>
           <?php
             require('class/anuncios.class.php');
             $a = new Anuncios();
             $anuncios = $a->getMeusAnuncios();

             foreach($anuncios as $anuncio):
           ?>
           <tr>
             <td>
                 <?php if(!empty($anuncio['url'])): ?>
                 <img src="img/anuncios/<?php echo $anuncio['url']; ?>" height="50" border="0" />
                 <?php else: ?>
                    <img src="img/anuncios/sem-foto.jpg" height="50" border="0" />
                 <?php endif; ?>
            </td>
             <td><?php echo $anuncio['titulo']; ?></td>
             <!-- format number formata um valor para decimal o 2 significa que vai ter duas casas decimais apos a virgula -->
             <td>R$ <?php echo number_format($anuncio['valor'], 2); ?></td>
             <td>
                 <a href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-light">Editar</a>
                 <a href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-danger">Excluir</a>
             </td>
             <?php endforeach; ?>
             </tr>
       </table>
      </div>
</body>
</html>


<?php require('pages/footer.php'); ?>