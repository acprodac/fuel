<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="content-language" content="pt-br" />
	<meta name="title" content="<?php echo $title; ?>" />
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="robots" content="index,follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href='<?php echo $baseUrl; ?>assets/css/jquery.fancybox.css' rel='stylesheet' type='text/css'>
	<link href='<?php echo $baseUrl; ?>assets/css/style.css?_<?php echo time(); ?>' rel='stylesheet' type='text/css' media='screen'>
	<link href='<?php echo $baseUrl; ?>assets/css/tablet.css' rel='stylesheet' type='text/css' media='(max-width: 1024px)'>
	<link href='<?php echo $baseUrl; ?>assets/css/mobile.css?_v1' rel='stylesheet' type='text/css' media='(max-width: 825px)'>
	<link href='<?php echo $baseUrl; ?>assets/css/mobile2.css' rel='stylesheet' type='text/css' media='(max-width: 480px)'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

	<link rel="shortcut icon" href="<?php echo $baseUrl; ?>favicon.ico" />
	<link rel="icon" type="image/x-icon" href="<?php echo $baseUrl; ?>favicon.ico" />
	<script>
		  /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		 
		  ga('create', 'UA-53797031-1', 'auto');
		  ga('send', 'pageview');	 */
	</script>
</head>
<body class="<?php echo $bodyClass; ?>">
	<div id="master">

		<?php echo $header; ?>
		
		<?php echo $vitrine; ?>

		<div class="content">
			
			<?php echo $content; ?>

		</div>
	</div>
	
	<?php echo $footer; ?>




	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jcarousel.connected-carousels.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery.placeholder.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery.validate.js"></script>
	
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/rules.js?_<?php echo time(); ?>"></script>

	<script type="text/javascript">
		Menu();
	</script>
	

	
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

	
	<script type="text/javascript">
		$(document).ready(function(){
			
			// var m = "https://www.google.com.br/maps/place/Pro+Dac+Ar+Condicionado/@-23.65573,-46.657865,17z/data=!3m1!4b1!4m2!3m1!1s0x94ce5abc7a955757:0x753c3249913e4e41";
			var m = "<?php echo $mapa; ?>";
			m = m.split("@")[1].split(",");
			window.initialize("map", Number(m[0]), Number(m[1]), 'Rua Belford Duarte, 716 - Vila Santa Catarina<br>Telefone: (11) 5566-6556');
		});
	</script>
</body>
</html>