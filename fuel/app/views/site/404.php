<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Página não encontrada - Prodac</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="content-language" content="pt-br" />
    <meta name="title" content="Página não encontrada - Prodac" />
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='<?php echo $baseUrl; ?>assets/css/style.css?_v2' rel='stylesheet' type='text/css' media='screen'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="<?php echo $baseUrl; ?>favicon.ico" />
    <link rel="icon" type="image/x-icon" href="<?php echo $baseUrl; ?>favicon.ico" />
    <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         
          ga('create', 'UA-53797031-1', 'auto');
          ga('send', 'pageview');    
    </script>
</head>
<body class="p404">
    <div id="wrapper">
    	<h1>
			<a href="<?php echo Uri::base(); ?>" title="Prodac"><img src="<?php echo $baseUrl; ?>upload/img/<?php echo $home->fields['logo']; ?>" alt="Prodac" /></a>
		</h1>
		<div class="img">
			<img src="<?php echo Uri::base(); ?>assets/img/404.jpg">
		</div>
		<h2>Página não encontrada.</h2>
		<h3>Tinha uma pedra no meio do caminho.</h3>
		<p><span>Mas nossos especialistas em mineração já estão trabalhando</span>
		<span>para removê-la. Enquanto isso, <a href="<?php echo Uri::base(); ?>">clique aqui para retornar à home</a></span>
		<span>ou busque abaixo o que está procurando.</span></p>

		<div class="busca">
			<form id="formBusca" method="GET" action="<?php echo Uri::create('busca'); ?>">
				<span class="buscaL"></span>
				<input type="text" name="s" id="busca" placeholder="BUSCAR" />
				<input type="image" id="btnSubmit" src="<?php echo $baseUrl; ?>assets/img/bg-input-submit.gif">
			</form>
		</div>
    </div>
</body>
</html>