<div id="contHead">
	<h2><span>PRODAC</span><br>
	<strong>SEGMENTOS DE ATUAÇÃO</span></strong> </h2>

	<?php echo htmlspecialchars_decode($page->descricao); ?>
</div>



<?php if(empty($produtos)) : ?>

	<p>Nenhum segmento encontrada.</p>

<?php else : ?>

	<ul>

		<?php foreach($produtos as $produto) : ?>
			<li>
				<a href="<?php echo Uri::create('segmentos/' . $produto->slug); ?>">
					<h3><span>Prodac</span><br>
						<strong><?php echo $produto->titulo; ?></strong>
					</h3>
					<div>
					<img src="<?php echo Uri::create('upload/img/' . $produto->imagem); ?>" alt="" />
					<p>SAIBA MAIS</p>
					</div>
					</a>
				
			</li>
		<?php endforeach; ?>

	</ul>

<?php endif; ?>
