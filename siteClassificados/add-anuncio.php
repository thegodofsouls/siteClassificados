<?php require('pages/header.php'); ?>
<?php
     //verificaçao se o usuario está logado para acessar os anuncios
     if(empty($_SESSION['cLogin']))
     {
         ?>
         <script type="text/javascript">window.location.href="login.php"</script>
         <?php
     }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
      <?php
          require('class/anuncios.class.php');
          $a = new Anuncios();

          //verificaçao se o campo título está preenchido
          if(isset($_POST['titulo']) && !empty($_POST['titulo']))
          {
              $titulo = addslashes($_POST['titulo']);
              $categoria = addslashes($_POST['categoria']);
              $valor = addslashes($_POST['valor']);
              $descricao = addslashes($_POST['descricao']);
              $estado = addslashes($_POST['estado']);

              $a->addAnuncio($titulo, $categoria, $valor, $descricao, $estado);

              ?>
               <div class="alert alert-success">
                   Produto Adicionado com sucesso!
               </div>
              <?php
          }
      
      ?>
      <div class="container">
       <h1>Meus Anúncios - Adicionar Anúncio</h1>

       <form method="post" enctype="multipart/form-data">
            
           <div class="form-group">
               <label for="categoria">Categoria:</label>
               <select name="categoria" id="categoria" class="form-control">
                   <option value="">Selecione uma categoria:</option>
                   <?php
                       require('class/categorias.class.php');
                       $c = new Categorias();
                       $categs = $c->getLista();
                       foreach($categs as $categ):
                   ?>
                   <option value="<?php echo $categ['id']; ?>"><?php echo $categ['nome_categoria']; ?></option>
                       <?php endforeach; ?>
                </select>
           </div>
           <div class="form-group">
               <label for="titulo">Título:</label>
               <input type="text" name="titulo" id="titulo" class="form-control">
           </div>
           <div class="form-group">
               <label for="valor">Valor:</label>
               <input type="text" name="valor" id="valor" class="form-control val">
           </div>
           <div class="form-group">
               <label for="descricao">Descrição:</label>
               <textarea class="form-control" name="descricao"></textarea>
           </div>
           <div class="form-group">
               <label for="estado">Estado de Conservação:</label>
               <select name="estado" id="estado" class="form-control">
                   <option value="">Selecione:</option>
                   <option value="0">Ruim</option>
                   <option value="1">Bom</option>
                   <option value="2">Ótimo</option>
               </select>
           </div>
           <button value="submit" class="btn alert-success">Adicionar</button>
       
       </form>
       
      </div>
</body>
</html>
<?php require('pages/footer.php'); ?>
     

