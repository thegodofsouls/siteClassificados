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
              
              //verificaçao se a foto foi selecionada
              if(isset($_FILES['fotos'])):
              
                 $fotos = $_FILES['fotos'];
              else:
                 $fotos = array();
              endif;

              $a->editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);

              ?>
               <div class="alert alert-success">
                   Produto editado com sucesso!
               </div>
              <?php
          }

          if(isset($_GET['id']) && !empty($_GET['id']))
          {
              $info = $a->getAnuncio($_GET['id']);
          }
          else
          {
              ?>
                 <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
              <?php
          } 
      
      ?>
<div class="container">
<h1>Meus Anúncios - Editar Anúncio</h1>

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
            <option value="<?php echo $categ['id']; ?>" <?php echo ($info['id_categoria'] == $categ['id'])?'selected="selected"':''; ?>><?php echo $categ['nome_categoria']; ?></option>
            <?php endforeach; ?>
          </select>
           </div>
           <div class="form-group">
               <label for="titulo">Título:</label>
               <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>" />
           </div>
           <div class="form-group">
               <label for="valor">Valor:</label>
               <input type="text" name="valor" id="valor" class="form-control val" value="<?php echo $info['valor']; ?>" />
           </div>
           <div class="form-group">
               <label for="descricao">Descrição:</label>
               <textarea class="form-control" name="descricao"><?php echo $info['descricao'];?></textarea>
           </div>
           <div class="form-group">
               <label for="estado">Estado de Conservação:</label>
               <select name="estado" id="estado" class="form-control">
                   <option value="">Selecione:</option>
                   <option value="0" <?php echo ($info['estado'] == '0')? 'selected="selected"':''; ?>>Ruim</option>
                   <option value="1" <?php echo ($info['estado'] == '1')? 'selected="selected"':''; ?>>Bom</option>
                   <option value="2" <?php echo ($info['estado'] == '2')? 'selected="selected"':''; ?>>Ótimo</option>
               </select>
           </div>

           <div class="form-group">
           <label for="add_foto">Fotos do anúncio:</label>
           <input type="file" name="fotos[]" multiple><br><!-- multiple aceita várias fotos de uma vez -->

              <div class="panel panel-default">
                 <div class="panel-heading"><strong class="text text-info">Fotos do Anúncio:</strong></div>
                 <div class="panel-body">
                   <?php foreach($info['fotos'] as $foto): ?>
                    <div class="foto_item">
                        <img src="img/anuncios/<?php echo $foto['url']; ?>" class="img-thumbnail" border="0" /><br>
                        <a href="excluir-foto.php?id=<?php echo $foto['id']; ?>" class="btn btn-light">Excluir Imagem</a>
                    </div>
                   <?php endforeach; ?>
                 </div>
               </div>
           </div>
           <button value="submit" class="btn alert-success">Salvar</button>
           
</form>
</div>
</body>
</html>
<?php require('pages/footer.php'); ?>
