<?php
    require('pages/header.php');
    require('class/anuncios.class.php');
    require('class/categorias.class.php');
    //require('class/usuarios.class.php');
    //$u = new Usuarios();
    $a = new Anuncios();
    $c = new Categorias();

    $filtros = array(
        'categoria' => '',
        'preco' => '',
        'estado' => ''
    );
    if(isset($_GET['filtros']))
    {
        $filtros = $_GET['filtros'];
    }
   
    $total_anuncios = $a->getTotalAnuncios($filtros);
    $total_usuarios = $u->getTotalUsuarios();

    $p = 1;
    if(isset($_GET['p']) && !empty($_GET['p'])){
         $p = addslashes($_GET['p']);
    }
    
    $por_pagina = 2;
    //ceil vai arredondar valores quebrados para cima
    $total_paginas = ceil($total_anuncios / $por_pagina);

    $anuncios = $a->getUltimosAnuncios($p, $por_pagina, $filtros);
    $categorias = $c->getLista();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <!-- container-fluid pega de ponta a ponta -->
    <div class="container-fluid">
        <div class="jumbotron">
            <!-- verificaçao se existir somente um anuncio cadastrado -->
            <?php if($total_anuncios == 1): ?>
            <h2>Nós temos hoje <?php echo $total_anuncios; ?> anúncio.</h2>
            <?php else: ?>
            <h2>Nós temos hoje <?php echo $total_anuncios; ?> anúncios.</h2>
            <?php endif; ?>
            
            <!-- verificaçao se existir somente um usuário cadastrado -->
            <?php if($total_usuarios == 1): ?>
            <p>Somente <?php echo $total_usuarios; ?> usuário cadastrado.</p>
            <?php else: ?>
            <p>E mais de <?php echo $total_usuarios; ?> usuários cadastrados.</p>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <h4>Pesquisa Avançada</h4>
                <form action="" method="get">
                    <div class="form-group">
                     <label for="categoria">Categoria:</label>
                      <select name="filtros[categoria]" id="categoria" class="form-control">
                         <option value="">Selecione...</option>
                         <?php foreach($categorias as $categoria): ?>
                         <option value="<?php echo $categoria['id']; ?>" <?php echo($categoria['id'] == $filtros['categoria']) ?'selected="selected"':''; ?>><?php echo $categoria['nome_categoria']; ?></option>
                         <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="form-group">
                     <label for="preco">Preço:</label>
                      <select name="filtros[preco]" id="preco" class="form-control">
                        <option value="">Selecione...</option>
                        <option value="0-50" <?php echo($filtros['preco'] == '0-50') ?'selected="selected"':''; ?>>R$ 0 - 50</option>
                        <option value="51-100" <?php echo($filtros['preco'] == '51-100') ?'selected="selected"':''; ?>>R$ 51 - 100</option>
                        <option value="101-200" <?php echo($filtros['preco'] == '101-200') ?'selected="selected"':''; ?>>R$ 101 - 200</option>
                        <option value="201-500"  <?php echo($filtros['preco'] == '201-500') ?'selected="selected"':''; ?> >R$ 201 - 500</option>
                      </select>
                    </div>

                    <div class="form-group">
                     <label for="estado">Estado de conservação:</label>
                      <select name="filtros[estado]" id="estado" class="form-control">
                        <option value="">Selecione...</option>
                        <option value="0" <?php echo($filtros['estado'] == '0') ?'selected="selected"':''; ?>>Ruim</option>
                        <option value="1" <?php echo($filtros['estado'] == '1') ?'selected="selected"':''; ?>>Bom</option>
                        <option value="2" <?php echo($filtros['estado'] == '2') ?'selected="selected"':''; ?>>Ótimo</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-9">
                <h4>Últimos Anúncios</h4>
                <table class="table table-hover">
                <tbody>
                    <?php 
              
                    foreach($anuncios as $anuncio): ?>
                     <tr>
                         <td>
                         <?php if(!empty($anuncio['url'])): ?>
                         <img src="img/anuncios/<?php echo $anuncio['url']; ?>" height="50" border="0" />
                         <?php else: ?>
                         <img src="img/anuncios/sem-foto.jpg" height="50" border="0" />
                         <?php endif; ?>
                         </td>
                         <td><a href="produto.php?id=<?php echo $anuncio['id']; ?>"><?php echo $anuncio['titulo']; ?></a><br>
                         <?php echo $anuncio['categoria']; ?>
                        </td>
                         <td>
                             R$:<?php echo number_format($anuncio['valor'], 2); ?>
                         </td>
                     </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <ul class="pagination"> 
                <?php for($q = 0; $q < $total_paginas; $q++): ?>
                <li class="page-item"><a class="page-link" href="index.php?<?php $w = $_GET; $w['p'] = $q + 1; echo http_build_query($w); ?>"><?php echo ($q + 1); ?></a></li>
                <?php endfor; ?>
                </ul>
            </div>
        </div>
   </div>
<?php
     require('pages/footer.php');
?>
</body>
</html>