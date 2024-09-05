<ul id="menuLeft" class="nav navbar-inner nav-list nav-pills">
    <li class="nav-header" style="text-align: center; width: 100%; padding: 0; margin-left: -5px;">Menu</li>
    <li class="<?php echo Arr::get($activeMenu, 'home', ''); ?>"><a href="<?php echo Uri::create('admin'); ?>"><i class="glyphicon glyphicon-home"></i>Home</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'vitrine', ''); ?>"><a href="<?php echo Uri::create('admin/vitrines'); ?>"><i class="glyphicon glyphicon-th-large"></i>Vitrines</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'prodac', ''); ?>"><a href="<?php echo Uri::create('admin/prodac'); ?>"><i class="glyphicon glyphicon-briefcase"></i>A Prodac</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'servicos', ''); ?>"><a href="<?php echo Uri::create('admin/servicos'); ?>"><i class="glyphicon glyphicon-question-sign"></i>Serviços</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'segmentos', ''); ?>"><a href="<?php echo Uri::create('admin/segmentos'); ?>"><i class="glyphicon glyphicon-certificate"></i>Segmentos</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'premios', ''); ?>"><a href="<?php echo Uri::create('admin/premios'); ?>"><i class="glyphicon glyphicon-cloud"></i>Prêmios</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'parceiros', ''); ?>"><a href="<?php echo Uri::create('admin/parceiros'); ?>"><i class="glyphicon glyphicon-list-alt"></i>Clientes</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'emandamento', ''); ?>"><a href="<?php echo Uri::create('admin/emandamento'); ?>"><i class="glyphicon glyphicon-tree-conifer"></i>Obras em andamento</a></li>
    <li class="<?php echo Arr::get($activeMenu, 'contato', ''); ?>"><a href="<?php echo Uri::create('admin/contato'); ?>"><i class="glyphicon glyphicon-envelope"></i>Contato</a></li>
    <?php /*<li class="divider">&nbsp;</li>
    <li class="<?php echo Arr::get($activeMenu, 'orcamentos', ''); ?>"><a class="btn-sistema" href="<?php echo Uri::create('admin/orcamentos'); ?>"><i class="glyphicon glyphicon-folder-open"></i>Sistema de orçamentos <i class="glyphicon glyphicon-share-alt last"></i></a></li>*/ ?>
</ul>