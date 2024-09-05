<div id="contHead">
	<h2><span><?php echo htmlspecialchars_decode($page->fields['destaque'][0]['titulo']); ?></span><br>
	<strong><?php echo $page->fields['destaque'][0]['subtitulo']; ?></span></strong> </h2>

	<?php echo htmlspecialchars_decode($page->descricao); ?>
</div>


<?php if(empty($produtos)) : ?>

	<p>Nenhuma obra encontrada.</p>

<?php else : ?>

	<ul>

		<?php foreach($produtos as $produto) : ?>
			<li>
				<img src="<?php echo Uri::create('upload/img/' . $produto->imagem); ?>" alt="" />
				<span class="data-premios"><?php echo $produto->data_publicado; ?></span>
				<p><strong><?php echo $produto->titulo; ?></strong></p>
				<div class="content-editor">
					<?php echo htmlspecialchars_decode($produto->texto); ?><br>
				</div>
			</li>
		<?php endforeach; ?>

	</ul>

<?php endif; ?>



