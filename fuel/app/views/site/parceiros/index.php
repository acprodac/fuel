
<div id="contHead">
	<h2><span><?php echo htmlspecialchars_decode($page->fields['destaque'][0]['titulo']); ?></span><br>
	<strong><?php echo $page->fields['destaque'][0]['subtitulo']; ?></span></strong> </h2>

	<?php echo htmlspecialchars_decode($page->fields['destaque'][0]['texto']); ?>
</div>

<?php if(isset($page->fields['imagem']) && !empty($page->fields['imagem'])) : ?>
	<ul>

		<?php foreach($page->fields['imagem'] as $img) : if(empty($img['imagem'])) continue; ?>
			<li>
				<img src="<?php echo $baseUrl; ?>upload/img/<?php echo $img['imagem']; ?>" alt="<?php echo nl2br($img['titulo']); ?>" />
			</li>
		<?php endforeach; ?>

	</ul>

		
	<?php endif; ?>