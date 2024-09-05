<?php
	$total = 1;
 	foreach($page->fields as $item) : 
 		if($total%2 == 1) {
 			echo '<div  class="contCol" id="contCol' . $total . '">';
 		}
 ?>
			<h2><span>Prodac</span><br>
				<strong><?php echo $item['titulo']; ?></strong>
			</h2>
			<div class="content-editor">
				<?php echo htmlspecialchars_decode($item['descricao']); ?>
			</div>

			

		<?php 
			if($total%2 == 0) {
				echo '</div>';
			}
		$total++;
	endforeach; 
?>


<!-- 


			<div  class="contCol" id="contCol1">
				<h2><span>Prodac</span><br>
					<strong>Missão</strong>
				</h2>
				<img src="img/destProdac2.jpg">
				<p>Aplicação de Tecnologia em Sistemas Térmicos para melhoria efetiva dos Processos Produtivos de nossos clientes, Garantindo a Qualidade e preservando o meio ambiente.</p>

				<h2><span>Prodac</span><br>
					<strong>Valores</strong>
				</h2>
				<p>Valorizamos a busca continua da excelência e adotamos os seguintes princípios:<br><br>
				- Parceria com os fornecedores. <br>
				- Respeito aos compromissos assumidos.<br>
				- Orgulho das realizações.<br>
				- Desenvolvimento e atualização dos colaboradores.<br>
				- Alavancar os negócios com eficácia e responsabilidade.<br>
				- Condução das atividades empresariais com ética e honestidade.<br>
				</p>
			</div>
			<div class="contCol" id="contCol2">
				<h2><span>Prodac</span><br />
					<strong>A Prodac</strong>
				</h2>
				<p><strong>História</strong>
				Fundada em 1987 através da associação dos engenheiros Osmar dos Santos Fragata, Luiz Augusto de Arruda Miranda, provenientes de conceituadas empresas instaladoras e projetistas de Sistemas Térmicos.
				</p>
				<p>
				Desde a sua fundação, a PRO DAC AR CONDICIONADO LTDA, vem atuando continuamente com o objetivo de oferecer aos seus clientes o melhor padrão tecnológico disponível nos mercados interno e externo, oferecendo sempre serviços diferenciados, buscando compatibilização e perfeita adequação de suas instalações com as necessidades reais de seus clientes.
				</p>
				
			</div>		


-->