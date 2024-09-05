	<h3>
		<a class="btnCadastrarNovo btn btn-success btnLink" href="<?php echo Uri::create('admin/premios/cadastrar'); ?>">Cadastrar nova premios</a>
		Premios <span>&gt; Ordenar</span></h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">
    	<a href="<?php echo Uri::create('admin/premios'); ?>" class="btnLink" class="btnLink"><i class="icon-chevron-left"></i>Voltar</a>
        <p><br />Clique e arraste os itens para reordenar.</p>
        <?php if(empty($itens)) : ?>
        
            <h4>Item não encontrado.</h4>
        
        <?php else : ?>
        
            <form id="formSave" class="well well-large form-page formVitrineOrdenar" action="<?php echo Uri::current(); ?>" method="POST" accept-charset="utf-8" data-redirect="<?php echo Uri::create('admin/premios'); ?>">
                <div class="boxOrdernar">
                    <ul class="sortable">
                        <?php $count = 1; foreach($itens as $item) : ?>
                            <li class="ui-state-default<?php echo ($count <= $numItens && $item->status === '1') ? ' ui-state-hover' : ''; ?><?php echo empty($item->status) ? ' inativo' : ''; ?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $item->titulo . (empty($item->status) ? ' <em class="inativo">(inativo)</em>' : ''); ?><input type="hidden" id="ordemVitrine<?php echo $count; ?>" class="ordemVitrine" name="ordem[]" value="<?php echo $item->id; ?>" /></li>
                        <?php
                        	if($count > $numItens || empty($item->status)){
                        		$count++;
                        	}
                       	endforeach; ?>
                    </ul>
                </div>
                <input type="submit" id="inputSubmitForm" class="btn btn-primary btn-large btnSubmit disabled" value="Salvar Ordem" />
                <div class="boxMsg boxMsgForm">
                    <p class="error">Preencha corretamente os campos em vermelho.</p>
                    <p class="boxErrorServer errorServerLogin">Ocorreu um erro. Tente novamente.</p>
                    <div class="boxLoading boxLoadingBlue"><?php echo Asset::img('loading-blue-disabled.gif'); ?></div>
                </div>
                <br clear="all" />
                <input type="hidden" id="numItens" value="<?php echo $numItens; ?>" />
                <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token(), array('class' => 'inputToken')); ?>
            </form>
            
        <?php endif; ?>
    </div>