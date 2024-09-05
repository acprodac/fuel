<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="pt" />
    <meta name="author" content="" />
    <meta name="language" content="portuguese" />
    <meta name="distribution" content="Global" />
    <meta name="rating" content="General" />
    <meta name="geo.country" content="Brasil" />
    <meta name="dc.language" content="pt" />
    <meta name="robots" content="noindex,nofollow" />
	<meta name="baseUrl" content="<?php echo $baseUrl; ?>"/>
	<?php if(isset($urlRedirect)) : ?>
		<meta name="urlRedirect" content="<?= $urlRedirec; ?>"/>
    <?php endif; ?>
    
	<?php echo htmlspecialchars_decode($css); ?>
	
    <link rel="shortcut icon" href="<?php echo $baseUrl; ?>favicon.ico" />
	<link rel="icon" type="image/x-icon" href="<?php echo $baseUrl; ?>favicon.ico" />
</head>
<body id="page-home">

    <div id="wrapper">
        <div class="page-header">
            <h3>Admin</h3>
            <h1><?php echo Asset::img('admin/logo.png', array('alt' => 'PRODAC')); ?></h1>
            <div class="navbar">
                <div class="navbar-inner">
                    <ul id="menuHeader" class="nav">
						<?php if($isSuperAdmin) : ?>
							<li class="<?php echo isset($activeUsuarios) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/usuarios/'); ?>" class="btnLink"><i class="icon-user"></i>Usuários</a></li>
                        <?php endif; ?>
						<li class="<?php echo isset($activeSenha) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/alterar-senha/'); ?>" class="btnLink"><i class="icon-edit"></i>Alterar Senha</a></li>
                        <li class=""><a class="btnLink" href="<?php echo Uri::create('admin/logout/'); ?>"><i class="icon-remove"></i>Sair</a></li>
                    </ul>
                </div>
            </div>            
            <br clear="all" />
        </div>
        <br clear="all" />
        
        <ul id="menuLeft" class="nav navbar-inner nav-list nav-pills">
            <li class="nav-header" style="text-align: center; width: 100%; padding: 0; margin-left: -5px;">Menu</li>
            <li class="<?php echo isset($activeHome) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/'); ?>" class="btnHome"><i class="icon-home"></i>Home</a>
                <ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo isset($activeHomeVitrine) ? 'active': ''; ?>"><a href="<?php echo Uri::create('admin/home/vitrine/'); ?>">Vitrine</a></li>
                    <li class="<?php echo isset($activeHomeImg) ? 'active': ''; ?>"><a href="<?php echo Uri::create('admin/home/imagem-de-fundo/'); ?>">Imagem de fundo</a></li>
                    <li class="<?php echo isset($activeHomeVideo) ? 'active': ''; ?>"><a href="<?php echo Uri::create('admin/home/video/'); ?>">Vídeo</a></li>
                    <li class="divider"></li>
                </ul>
            </li>
            <li class="<?php echo isset($activeOqueFazemos) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/o-que-fazemos/'); ?>"><i class="icon-tags"></i>O que fazemos?</a>
                <ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo isset($activeOqueFazemosMat) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/o-que-fazemos/materias/'); ?>">Matérias</a></li>
                    <li class="nav-header">Gerenciamento</li>
                    <li class="<?php echo isset($activeOqueFazemosOq) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/o-que-fazemos/gerenciamento/o-que-fazemos/'); ?>">O que fazemos</a></li>
                    <li class="<?php echo isset($activeOqueFazemosFrt) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/o-que-fazemos/gerenciamento/frentes/'); ?>">Frentes</a></li>
                    <li class="<?php echo isset($activeOqueFazemosCateg) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/o-que-fazemos/gerenciamento/categorias/'); ?>">Categorias</a></li>
                    <li class="<?php echo isset($activeOqueFazemosSubcateg) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/o-que-fazemos/gerenciamento/subcategorias/'); ?>">Subcategorias</a></li>
                    <li class="<?php echo isset($activeOqueFazemosEspec) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/o-que-fazemos/gerenciamento/especificidades/'); ?>">Especificidades</a></li>
                    <li class="divider"></li>
                </ul>
            </li>
            <li class="<?php echo isset($activeNoticias) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/noticias/'); ?>"><i class="icon-book"></i>Notícias</a>
				<ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo isset($activeNoticiasCateg) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/noticias/categorias/'); ?>">Categorias</a></li>
				</ul>
			</li>
            <li class="<?php echo isset($activeInsti) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/'); ?>"><i class="icon-briefcase"></i>Institucional</a>
                <ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo isset($activeInstiContato) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/contato/'); ?>">Contato</a></li>
                    <li class="<?php echo isset($activeInstiFrases) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/as-8-frases/'); ?>">As 8 frases</a></li>
                    <li class="<?php echo isset($activeInstitHist) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/historia/'); ?>">História</a></li>
					<li class="<?php echo isset($activeInstitMis) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/missao/'); ?>">Missão</a></li>
                    <li class="<?php echo isset($activeInstitEquipe) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/equipe/'); ?>">Equipe</a></li>
                    <li class="<?php echo isset($activeInstitParc) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/parceiros/'); ?>">Parceiros</a></li>
                    <li class="<?php echo isset($activeInstitResult) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/resultados/'); ?>">Resultados</a></li>
                    <li class="<?php echo isset($activeInstitTransp) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/transparencia/'); ?>">Transparência</a></li>
                    <li class="<?php echo isset($activeInstitOport) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/oportunidades/'); ?>">Oportunidades</a></li>
					<li class="<?php echo isset($activeInstiDoacao) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/institucional/doacao/'); ?>">Doação</a></li>
                    <li class="divider"></li>
                </ul>
            </li>
            <li class="<?php echo isset($activeEn) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/'); ?>"><i class="icon-map-marker"></i>English</a>
				<ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo isset($activeEnPeace) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/peace-in-practice/'); ?>">Peace in Practice</a></li>
					<li class="<?php echo isset($activeEnWhat) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/what-we-do/'); ?>">What we do</a></li>
					<li class="<?php echo isset($activeEnTeam) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/team/'); ?>">Team</a></li>
					<li class="<?php echo isset($activeEnPartners) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/partners/'); ?>">Partners</a></li>
					<li class="<?php echo isset($activeEnContact) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/contact/'); ?>">Contact</a></li>
					<li class="<?php echo isset($activeEnResult) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/results/'); ?>">Results</a></li>
					<li class="<?php echo isset($activeEnDonation) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/english/donation/'); ?>">Donation</a></li>
				</ul>			
			</li>
            <li class="<?php echo isset($activeExtrac) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/extracoes/'); ?>"><i class="icon-share-alt"></i>Extrações</a>
				<ul class="nav nav-pills nav-stacked">
                    <li class="<?php echo isset($activeExtracContato) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/extracoes/contato-institucional/'); ?>">Contato Institucional</a></li>
					<li class="<?php echo isset($activeExtracNews) ? 'active' : ''; ?>"><a href="<?php echo Uri::create('admin/extracoes/newsletter/'); ?>">Newsletter</a></li>
				</ul>
			</li>
        </ul>

        <div id="content">