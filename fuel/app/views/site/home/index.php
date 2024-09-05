<div id="contHead">
	<h2><?php echo htmlspecialchars_decode($page->fields['destaque'][0]['titulo']); ?><br>
	<strong><?php echo $page->fields['destaque'][0]['subtitulo']; ?></span></strong> </h2>

	<p><?php echo htmlspecialchars_decode($page->fields['destaque'][0]['texto']); ?></p>
</div>

<?php for($i = 1; $i <= 2; $i++) : ?>

	<?php if(empty(${'destaque' . $i})) continue; ?>

		<?php if(!empty($segmentos) && ${'destaque' . $i} == 'segmentos') : ?>
			<div  class="contCol" id="contCol<?php echo $i; ?>">
				<ul>
					<h2><span>Prodac</span><br>
						<strong>Segmentos</strong>
					</h2>
				
					<?php foreach($segmentos as $segmento) : ?>
						<li>
							<div class="imgHome">
								<img style="margin-top: -45px;" src="<?php echo Uri::create('upload/img/' . $segmento->imagem); ?>" alt="" />
							</div>
							<a href="<?php echo Uri::create('segmentos/' . $segmento->slug); ?>" style="padding: 1em 1.8em; padding-top: 18px;">
								<strong style="padding-bottom: 0;"><?php echo $segmento->titulo; ?></strong>
								<?php echo htmlspecialchars_decode($segmento->texto); ?>
								<span>+ Detalhes</span>
							</a>
						</li>
					<?php endforeach; ?>

					<a href="<?php echo Uri::create('segmentos'); ?>" class="btnCinza" title="Ver todas as segmentos"><strong>Ver todos</strong> os segmentos</a>
				</ul>
			</div>
		<?php endif; ?>
		
		<?php if(!empty($obras) && ${'destaque' . $i} == 'obras') : ?>
			<div  class="contCol" id="contCol<?php echo $i; ?>">
				<ul>
					<h2><span>Prodac</span><br>
					<strong style="font-size: 1.2em;">Obras em andamento</strong>
				</h2>
			
				<?php foreach($obras as $obra) : ?>
					<li>
						<div class="imgHome">
							<img src="<?php echo Uri::create('upload/img/' . $obra->imagem); ?>" alt="" />
						</div>
						<div class="content-editor" style="padding: 1.5em 1.8em 1.5em 1.8em;">
							<p><strong><?php echo $obra->titulo; ?></strong></p>
							<?php echo htmlspecialchars_decode($obra->texto); ?>
							<spam class="data-premios"><?php echo $obra->data_publicado; ?></spam>
						</div>
					</li>
				<?php endforeach; ?>

				<a href="<?php echo Uri::create('em-andamento'); ?>" class="btnCinza" title="Ver todas as obras em andamento"><strong>Ver todas</strong> as obras em andamento</a>
				</ul>
			</div>
		<?php endif; ?>

		<?php if(!empty($premios) && ${'destaque' . $i} == 'premios') : ?>
			<div  class="contCol" id="contCol<?php echo $i; ?>">
				<ul>
				<h2><span>Prodac</span><br>
					<strong>Prêmios</strong>
				</h2>
			
				<?php foreach($premios as $premio) : ?>
					<li style="padding-top: 1px; padding-bottom: 15px;">
		

						<a href="<?php echo Uri::create('premios/' . $premio->slug); ?>" style="padding: 1em 1.8em; padding-top: 18px;">
							<strong style="padding-bottom: 0;"><?php echo $premio->titulo; ?></strong>
							<?php 
							/*$trans_tbl = get_html_translation_table(HTML_ENTITIES);
	    					$trans_tbl = array_flip($trans_tbl);
	    					$texto = trim(strip_tags(strtr($produto->texto, $trans_tbl)));
							$totalCaracteres = 0;
	    					$vetorPalavras = explode(" ",$texto);
	        				$novoTexto = "";*/
	        				$texto = trim(strip_tags(htmlspecialchars_decode($premio->texto)));
	        				$totalCaracteres = 0;
	    					$vetorPalavras = explode(" ",$texto);
	        				$novoTexto = "";
					        for($j = 0; $j <count($vetorPalavras); $j++):
					            $totalCaracteres += strlen(" ".$vetorPalavras[$j]);
					            if($totalCaracteres <= 120)
					                $novoTexto .= ' ' . $vetorPalavras[$j];
					            else break;
					        endfor;
							echo $novoTexto."..."; 
							?>
							<span>+ Detalhes</span>
						</a>
					</li>
				<?php endforeach; ?>

				<a style="margin-top: 16px;" href="<?php echo Uri::create('premios'); ?>" class="btnCinza" title="Ver todas as prêmios"><strong>Ver todos</strong> os prêmios</a>
			</ul>
		</div>
	<?php endif; ?>

<?php endfor; ?>