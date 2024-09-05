<div id="header">
	<div class="menu">
		<h1>
			<a href="<?php echo Uri::base(); ?>" title="Prodac"><img src="<?php echo $baseUrl; ?>upload/img/<?php echo $home->fields['logo']; ?>" alt="Prodac" /></a>
		</h1>
		<a id="btnMenu" href="#" title="Menu"><span></span></a>
		<div class="menuContent">
			<div id="nav">
				<!--<?php echo Arr::get($m, 'prodac', ''); ?>-->
				<a class="<?php echo Arr::get($m, 'prodac', ''); ?>" href="<?php echo Uri::create('prodac'); ?>" title="A Prodac"><img src="<?php echo $baseUrl; ?>assets/img/navArrow3.png" alt="" />A Prodac</a>
				<a class="<?php echo Arr::get($m, 'servicos', ''); ?>" href="<?php echo Uri::create('servicos'); ?>" title="Serviços"><img src="<?php echo $baseUrl; ?>assets/img/navArrow3.png" alt="" />Serviços</a>
				<a class="<?php echo Arr::get($m, 'segmentos', ''); ?>" href="<?php echo Uri::create('segmentos'); ?>" title="Segmentos"><img src="<?php echo $baseUrl; ?>assets/img/navArrow3.png" alt="" />Segmentos</a>
				<a class="<?php echo Arr::get($m, 'premios', ''); ?>" href="<?php echo Uri::create('premios'); ?>" title="Prêmios"><img src="<?php echo $baseUrl; ?>assets/img/navArrow3.png" alt="" />Prêmios</a>
				<a class="<?php echo Arr::get($m, 'parceiros', ''); ?>" href="<?php echo Uri::create('clientes'); ?>" title="Parceiros"><img src="<?php echo $baseUrl; ?>assets/img/navArrow3.png" alt="" />Clientes</a>
				<a class="<?php echo Arr::get($m, 'emandamento', ''); ?>" href="<?php echo Uri::create('em-andamento'); ?>" title="Obras em Andamento"><img src="<?php echo $baseUrl; ?>assets/img/navArrow3.png" alt="" />Em Andamento</a>
				<a class="<?php echo Arr::get($m, 'contato', ''); ?>" href="<?php echo Uri::create('contato'); ?>" href="#" title="Contato"><img src="<?php echo $baseUrl; ?>assets/img/navArrow3.png" alt="" />Contato</a>
				
			</div>
			</div>
			<div class="menuBg"></div>
		</div>
	</div>
	
	<div id="header_in"></div>
</div>