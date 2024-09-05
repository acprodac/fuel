	<h3>Premios <span>&gt; Editar</span></h3>
    <?php echo $boxFeedback; ?>
    
    <div id="containner">
    	<a href="<?php echo Uri::create('admin/premios'); ?>" class="btnLink" class="btnLink"><i class="icon-chevron-left"></i>Voltar</a>
    	
    	<?php if(empty($item)) : ?>

    		<h4>Item não encontrado.</h4>

    	<?php else : ?>

    		<?php include('_form.php'); ?>

		<?php endif; ?>
    </div>