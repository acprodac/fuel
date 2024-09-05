    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="pt" />
    <meta name="revisit-after" content="3 days" />
    <meta name="author" content="Tboom Interactive - http://www.tboom.net" />
    <meta name="language" content="portuguese" />
    <meta name="distribution" content="Global" />
    <meta name="rating" content="General" />
    <meta name="geo.country" content="Brasil" />
    <meta name="dc.language" content="pt" />
    <meta name="robots" content="noindex,nofollow" />
	<meta name="baseUrl" content="<?php echo $baseUrl; ?>"/>
	<?php if($urlRedirect) : ?>
		<meta name="urlRedirect" content="<?php echo $urlRedirect; ?>"/>
    <?php endif; ?>
    
	<?php echo Asset::render('css'); ?>
	
    <link rel="shortcut icon" href="<?php echo $baseUrl; ?>favicon.png" />
	<link rel="icon" type="image/x-icon" href="<?php echo $baseUrl; ?>favicon.ico" />