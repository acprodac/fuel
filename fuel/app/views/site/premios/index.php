<div id="contHead">
	<h2><span>PRODAC</span><br>
	<strong>PRÊMIOS</span></strong> </h2>

	<?php echo htmlspecialchars_decode($page->descricao); ?>
</div>



<?php if(empty($produtos)) : ?>

	<p>Nenhum prêmio encontrada.</p>

<?php else : ?>

	<ul>

		<?php foreach($produtos as $produto) : ?>
			<li>
				<a href="<?php echo Uri::create('premios/' . $produto->slug); ?>">
					<img src="<?php echo Uri::create('upload/img/' . $produto->imagem); ?>" alt="" />
					<span class="data-premios"><?php echo $produto->data_publicado; ?></span>

					<p><strong><?php echo $produto->titulo; ?></strong></p>
					
					<p>
						<?php 
						/*$trans_tbl = get_html_translation_table(HTML_ENTITIES);
    					$trans_tbl = array_flip($trans_tbl);
    					$texto = trim(strip_tags(strtr($produto->texto, $trans_tbl)));
						$totalCaracteres = 0;
    					$vetorPalavras = explode(" ",$texto);
        				$novoTexto = "";*/
        				$texto = trim(strip_tags(htmlspecialchars_decode($produto->texto)));
        				$totalCaracteres = 0;
    					$vetorPalavras = explode(" ",$texto);
        				$novoTexto = "";

				        for($i = 0; $i <count($vetorPalavras); $i++):
				            $totalCaracteres += strlen(" ".$vetorPalavras[$i]);
				            if($totalCaracteres <= 120)
				                $novoTexto .= ' ' . $vetorPalavras[$i];
				            else break;
				        endfor;
						echo $novoTexto."..."; 
						?>
						</p>

					<p><strong>Veja Mais</strong></p>

					</a>
				
			</li>
		<?php endforeach; ?>

	</ul>

<?php endif; ?>