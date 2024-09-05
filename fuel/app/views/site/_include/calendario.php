<?php if(isset($calendario) && !empty($calendario)) : ?>

	<div class="notiFilter">
		<div class="filter_in">
			<h2>Mês de <strong><?php echo $calendario['mes']; ?></strong> <?php echo $calendario['ano']; ?></h2>
			<div class="navFilter">
				<a class="<?php echo $calendario['prev_time'] < $minTime ? 'disabled' : ''; ?>" href="<?php echo $calendario['baseUrl'] . date('Y/m', $calendario['prev_time']); ?>" id="btnAnt">Anterior</a>
				<a class="<?php echo $calendario['next_time'] > $maxTime ? 'disabled' : ''; ?>" href="<?php echo $calendario['baseUrl'] . date('Y/m', $calendario['next_time']); ?>" id="btnProx">Próximo</a>
			</div>
			<a href="#" class="prev prev-noticias"></a>
	    	<a href="#" class="next next-noticias"></a>

	    	<?php /*
			<div id="notiCalendar" class="jcarousel">
				<ul>

					<?php foreach($calendario['dias'] as $dia) :
						$class = '';

						if($dia['dia_semana'] == 'sab' || $dia['dia_semana'] == 'dom'){
							$class .= ' fds';
						}

						if(!in_array($dia['dia'], $diasNoticia)){
							$class .= ' disabled';
							$link = '#';
						} else {
							$link = Uri::create($calendario['baseUrl'] . $calendario['ano'] . '/' . $calendario['mes_num'] . '/' . $dia['dia']);
						}

						if(isset($diaAtivo) && $diaAtivo == $dia['dia']){
							$class .= ' mark';
						}
					 ?>

						<li><a href="<?php echo $link; ?>" class="<?php echo ($dia['dia_semana'] == 'sab' || $dia['dia_semana'] == 'dom') ? 'fds' : ''; ?>"><?php echo ucfirst($dia['dia_semana']); ?><br><?php echo $dia['dia']; ?></a></li>

					<?php endforeach; ?>

				</ul>
			</div>
			*/ ?>

		</div>
	</div>

<?php endif; ?>