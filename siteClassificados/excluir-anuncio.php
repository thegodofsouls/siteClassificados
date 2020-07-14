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
     $a->deleteAnuncio($_GET['id']);
}

?>
<script type="text/javascript">window.location.href="meus-anuncios.php";</script>
