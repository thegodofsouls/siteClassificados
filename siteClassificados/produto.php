<?php require('pages/header.php'); ?>
<?php 
require('class/anuncios.class.php');

$a = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id']))
{
    $id = addslashes($_GET['id']);
}
else
{
    ?>
    <script type="text/javascript">window.location.href="index.php"</script>
    <?php
    exit;
}

$info = $a->getAnuncio($id);
?>

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-8">
       
       <div class="carousel slide" data-ride="carousel" id="meuCarousel">
          <div class="carousel-inner" role="listbox">
              <?php foreach($info['fotos'] as $chave => $foto): ?>
               <div class="carousel-item <?php echo ($chave == '0')?'active':''; ?>">
                 <img class="img-fluid img-thumbnail" src="img/anuncios/<?php echo $foto['url']; ?>" />
               </div>
              <?php endforeach; ?>
          </div>
          <a class="carousel-control-prev" href="#meuCarousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
          <a class="carousel-control-next" href="#meuCarousel" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span></a>
       </div> 
       </div>
       <div class="col-sm-7 float-right">
         <h1><?php echo $info['titulo']; ?></h1>
         <h4><?php echo $info['categoria']; ?></h4>
         <p><?php echo $info['descricao']; ?></p>
         
         <h3>R$: <?php echo number_format($info['valor'], 2); ?></h3>
         <h4>Telefone: <?php echo $info['telefone']; ?></h4>
       </div>    
    </div>
</div>
<?php require('pages/footer.php'); ?>