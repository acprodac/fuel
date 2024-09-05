<div id="footer">

			<div id="footer_in">
				
				<div class="divLeft">
					<img src="<?php echo $baseUrl; ?>assets/img/footLogo.png" alt="Prodac" /><br>
					<a href="<?php echo Uri::create('prodac'); ?>" title="Prodac">• A Prodac</a>
					<a href="<?php echo Uri::create('servicos'); ?>" title="Serviços">• Serviços</a>
					<a href="<?php echo Uri::create('segmentos'); ?>" title="Segmentos">• Segmentos</a>
					<a href="<?php echo Uri::create('premios'); ?>" title="Prêmios">• Prêmios</a>
					<a href="<?php echo Uri::create('parceiros'); ?>" title="Parceiros">• Parceiros</a>
					<a href="<?php echo Uri::create('em-andamento'); ?>" title="Obras em Andamento">• Em Andamento</a>
					<a href="<?php echo Uri::create('contato'); ?>" title="Contato">• Contato</a>
				</div>
				<div class="divRight">
					<p><img src="<?php echo $baseUrl; ?>assets/img/iconFone.jpg"><?php echo $home->fields['central_vendas']; ?></p>
					<p><img src="<?php echo $baseUrl; ?>assets/img/iconMail.jpg"><?php echo $home->fields['email']; ?></p>
					<p><img src="<?php echo $baseUrl; ?>assets/img/iconWeb.jpg"><a href="<?php echo Uri::create('contato'); ?>"><?php echo $home->fields['enderendo_contato']; ?></a></p>
				</div>

				
				<p><?php echo $home->fields['texto_footer']; ?></p>
			</div>

</div>