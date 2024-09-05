	<h3>Usuários
		<?php if(Auth::has_access('users.create')) : ?>
			<a class="btnCadastrarNovo btn btn-success" href="<?php echo Uri::create('admin/usuarios/cadastrar'); ?>">Cadastrar novo</a>
		<?php endif; ?>
	</h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">

    	<table class="table table-hover">
            <thead>
                <tr>
                    <th class="first">Nome</th>
                    <?php if(Auth::has_access('users.write')) : ?>
                    	<th class="min center">Ações</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($itens as $item): if(!isset($item->name)) continue; ?>
                    <tr>
                        <td class="name"><?php echo $item->name; ?></td>
                        
                        <?php if(Auth::has_access('users.write')) : ?>
	                        <td class="center">

	                        	<?php if($item->id != Auth::get('id')) : ?>
									<div class="btn-group btnList">
		                                <a href="<?php echo Uri::create('admin/usuarios/edit/' . $item->id . '/'); ?>" class="btn btn-primary btnEditar"><i class="icon-edit icon-white"></i>Editar</a><a href="<?php echo Uri::create('admin/usuarios/delete/' . $item->id . '/'); ?>" class="btn btn-danger btnExcluir" rel="usuário"><i class="icon-remove icon-white"></i>Excluir</a>
		                            </div>
		                            <div class="bgDisabled"></div>
		                            <div class="boxLoading">
		                                <?php echo Asset::img('loading-red-disabled.gif'); ?>
		                            </div>
		                        <?php endif; ?>

	                        </td>
	                    <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php echo htmlspecialchars_decode($pagination); ?>

    </div>