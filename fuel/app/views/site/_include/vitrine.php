<div id="destaque" class="<?php echo isset($classDestaque) ? $classDestaque : ''; ?>">
	
	<?php 

	if(isset($vitrine) && (boolean) $vitrine->status && !empty($vitrine->imagens)) : ?>
		<div id="destaque_in" class="jcarousel">
			<ul>

				<?php foreach($vitrine->imagens as $img) : ?>

					<li>

						<?php if(!empty($img->link)) : ?>
							<a href="<?php echo $img->link; ?>" title="<?php echo $img->titulo; ?>"<?php echo $img->link_target == 2 ? ' target="_blank"' : ''; ?>>
						<?php endif; ?>
							
							<?php if(!empty($img->titulo) || !empty($img->descricao)) { ?>
								<p>
								<?php 


								if(!empty($img->titulo)) { ?>
									<strong><?php echo $img->titulo; ?></strong>
								<?php } ?>
								<?php 
								if(!empty($img->descricao)) { 
									echo $img->descricao;
								} ?>
							
							<br><span>Saiba mais</span>
							
							<?php if(isset($img->titulo) || isset($img->descricao)) { ?>
								</p>
							<?php }
							}
							?>
							
							

							<img src="<?php echo Uri::create('upload/img/' . $img->imagem); ?>" alt="<?php echo $img->titulo; ?>" data-size="<?php echo $img->imagem_tamanho; ?>" />

						<?php if(!empty($img->link)) : ?>
							</a>
						<?php endif; ?>
						
					</li>

				<?php endforeach; ?>

			</ul>
		</div>

		<?php if(count($vitrine->imagens) > 1) : ?>
			<p class="jcarousel-pagination"></p>
		<?php endif; ?>
	<?php endif; ?>

</div>