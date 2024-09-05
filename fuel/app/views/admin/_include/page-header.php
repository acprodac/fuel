<div class="page-header">
    <h3>Admin</h3>
    <h1><a href="<?php echo Uri::create('admin'); ?>"><?php echo Asset::img('logo.png', array('alt' => 'PRODAC')); ?></a></h1>
    <div class="navbar">
        <div class="navbar-inner">
            <ul id="menuHeader" class="nav">
				<?php if(Auth::has_access('users.read')) : ?>
					<li class="<?php echo isset($activeUsuarios) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/usuarios/'); ?>" class="btnLink"><i class="glyphicon glyphicon-user"></i>Usuários</a></li>
                <?php endif; ?>
				<li class="<?php echo isset($activeSenha) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/alterar-senha/'); ?>" class="btnLink"><i class="glyphicon glyphicon-edit"></i>Alterar Senha</a></li>
                <li class=""><a class="btnLink" href="<?php echo Uri::create('admin/logout/'); ?>"><i class="glyphicon glyphicon-remove"></i>Sair</a></li>
            </ul>
        </div>
    </div>            
    <br clear="all" />
</div>