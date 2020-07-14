<?php
require('pages/header.php');

if(empty($_SESSION['cLogin']))
     {
         ?>
         <script type="text/javascript">window.location.href="login.php"</script>
         <?php
     }

require('class/anuncios.class.php');
$a = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id']))
{
     $id_anuncio = $a->deletePhoto($_GET['id']);
}
if(isset($id_anuncio))
{
   
    header("Location: editar-anuncio.php?id=".$id_anuncio);
   
}
else
{
    ?>
    <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
    <?php
}




