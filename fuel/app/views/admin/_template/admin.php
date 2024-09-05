<!DOCTYPE html>
<html lang="pt_BR">
<head>
	<?php echo $head; ?>

</head>
<body id="page-home" class="<?php echo $bodyClass; ?>">
	<div id="wrapper">
		<?php echo $pageHeader; ?>
		<br clear="all" />
		<?php echo $menu; ?>
		<div id="content">
			<?php echo $content; ?>
		</div>
		<br clear="all" />
		<?php echo $footer; ?>
	</div>
	<div id="boxPageLoading">&nbsp;</div>
    <div id="boxPageLoadingImg"></div>	
    <script type="text/javascript" src="<?php echo $baseUrl; ?>assets/_admin/js/spin.min.js"></script>
    <?php echo Asset::render('js'); ?>
</body>
</html>