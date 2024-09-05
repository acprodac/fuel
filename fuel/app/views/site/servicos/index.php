<ul>
<?php
	$total = 1;
 	foreach($page->fields as $item) : 
 		
 ?>
	<li>
		<h2><span>Prodac</span><br>
				<strong><?php echo $item['titulo']; ?></strong>
			</h2>
			<?php echo stripslashes(htmlspecialchars_decode($item['descricao'])); ?>
	</li>
	

		<?php 
		$total++;
	endforeach; 
?>

</ul>


<?php
/*
<ul>
	<li>
		<h3><span>Prodac</span><br>
			<strong>Engenharia</strong>
		</h3>
		<img src="img/servicos1.jpg" alt="" />
		<p>Nossas equipes de engenharia, adequam seu projeto às suas necessidades. Elevado conhecimento de instalações e das normas que as regulamentam, viabilizamos seus negócios ou empreendimentos, com a aplicação das mais modernas soluções técnicas, atendendo também às certificações de obras sustentáveis (LEED, ACQUA, PROCEL). </p>
	</li>
	<li>
		<h3><span>Prodac</span><br>
			<strong>Instalação</strong>
		</h3>
		<img src="img/servicos2.jpg" alt="" />
		<p>	Somos especialistas em sistemas de ar condicionado e ventilação mecânica, para obras novas ou retrofit’s. Desenvolvemos projeto executivo e montagem completa de instalações com expansão direta e indireta, automação, condicionamento de ar refrigerado, ventilação mecânica, extração de fumaça e pressurização de escadas de emergência. </p>
	</li>
	<!--<li>
		<h3><span>Prodac</span><br>
			<strong>Manutenção</strong>
		</h3>
		<img src="img/servicos3.jpg" alt="" />
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
	</li>
	<li>
		<h3><span>Prodac</span><br>
			<strong>Assistência</strong>
		</h3>
		<img src="img/servicos4.jpg" alt="" />
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
	</li>-->
</ul>

*/
?>