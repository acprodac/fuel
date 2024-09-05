
<?php if(isset($itemGaleria) && (boolean) $itemGaleria->status && !empty($itemGaleria->imagens)) : ?>
<div class="galeria">
	<p id="legenda_galeria"><strong></strong> - Prodac.</p>

		<?php if(count($itemGaleria->imagens) > 1) : ?>
			<a href="#" class="prev prev-stage"></a>
			<a href="#" class="next next-stage"></a>
		<?php endif; ?>

		<div class="jcarousel carousel-stage">
			<ul>
				<?php foreach($itemGaleria->imagens as $img) :
					if(!file_exists(DOCROOT . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $img->imagem)){
						continue;
					}
				 ?>
					<li>
						<a rel="galeria" href="<?php echo Uri::create('upload/img/nocrop_' . $img->imagem); ?>">
							<div class="hover">
								<p><?php echo $img->texto; ?></p>
							</div>
							<img src="<?php echo Uri::create('upload/img/' . $img->imagem); ?>" alt="<?php echo $img->titulo; ?>" />
						</a>
					</li>
				<?php endforeach; ?>

			</ul>
		</div>

		<?php if(count($itemGaleria->imagens) > 1) : ?>
			<p class="pagination-stage"></p>
		<?php endif; ?>

	<?php echo count($itemGaleria->imagens) < 6 ? '<div class="hide-thumbs-galeria">' : ''; ?>
		<a href="#" class="prev prev-navigation"></a>
		<a href="#" class="next next-navigation"></a>
	    <div class="jcarousel carousel-navigation">
			<ul>
				
				<?php foreach($itemGaleria->imagens as $img) :
					if(!file_exists(DOCROOT . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $img->imagem)){
					continue;
				}
				?>
					<li><img src="<?php echo Uri::create('upload/img/161x121_' . $img->imagem); ?>" alt="<?php echo $img->titulo; ?>" /></li>
				<?php endforeach; ?>

			</ul>
		</div>
	<?php echo count($itemGaleria->imagens) < 6 ? '</div>' : ''; ?>
</div>
<?php endif; ?>

