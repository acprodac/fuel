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

	<link href='<?php echo $baseUrl; ?>assets/css/style.css' rel='stylesheet' type='text/css' media='screen'>
	<link href='<?php echo $baseUrl; ?>assets/css/tablet.css' rel='stylesheet' type='text/css' media='(max-width: 1024px)'>
	<link href='<?php echo $baseUrl; ?>assets/css/mobile.css?_v1' rel='stylesheet' type='text/css' media='(max-width: 825px)'>
	<link href='<?php echo $baseUrl; ?>assets/css/mobile2.css' rel='stylesheet' type='text/css' media='(max-width: 480px)'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
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
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/jquery.jcarousel.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>assets/js/rules.js"></script>
</body>
</html>