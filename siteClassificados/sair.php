<?php
     session_start();
     unset($_SESSION['cLogin']);
     //outra forma de destruir uma sessao $_SESSION['cLogin'] = session_destroy();
    /* $logado = $_SESSION['cLogin'];
     $logado = session_destroy(); */
     echo '<script language="JavaScript">location.href="./"</script>';
   

