<?php
return array(
	'_root_'  => 'home/index',
    '_404_'   => 'home/404',

    'contato'   =>  'contato/index',
    'andamento'   =>  'emandamento/index',
    'parceiros' =>  'parceiros/index',
    'premios'   =>  'premios/index',
    'prodac'    =>  'prodac/index',
    'segmentos' =>  'segmentos/index',
    'servicos'  =>  'servicos/index',
    
    'premios/(:any)' => 'premios/interna/$1',    
    'segmentos/(:any)' => 'segmentos/interna/$1',    
    
    'clientes' => 'parceiros',
    'em-andamento' => 'emandamento',

    'embu/frota-especializada' => 'embu/frota',
    'embu/obras-realizadas' => 'embu/obras',

    'por-que-embu' => 'porque/index',

    'produto/(:any)' => 'produtos/interna/$1',
    'produtos/(:any)/(:any)' => 'produtos/index/$1/$2',
    'produtos/(:any)' => 'produtos/index/$1/todos',
    'produtos' => 'produtos/index/todos/todos',

    'pedreira/(:any)' => 'pedreiras/interna/$1',
    

    'noticia/(:any)' => 'noticias/interna/$1',
    'noticias/(:num)/(:num)/(:num)' => 'noticias/index/$1/$2/$3',
    'noticias/(:num)/(:num)' => 'noticias/index/$1/$2',
    'noticias/(:num)' => 'noticias/index/$1',

    'sustentabilidade/noticias' => 'sustentabilidade/novidades/',
    'sustentabilidade/noticia/(:any)' => 'sustentabilidade/novidades/interna/$1',
    'sustentabilidade/noticias/(:num)/(:num)/(:num)' => 'sustentabilidade/novidades/index/$1/$2/$3',
    'sustentabilidade/noticias/(:num)/(:num)' => 'sustentabilidade/novidades/index/$1/$2',
    
    'sustentabilidade/projeto/(:any)' => 'sustentabilidade/projetos/interna/$1',
    
    'wikipedra/historia-da-pedra' => 'wikipedra/historia',
    'wikipedra/tipos-de-agregados' => 'wikipedra/agregados',
    'wikipedra/valor-do-minerio' => 'wikipedra/minerio',
    'wikipedra/a-z' => 'wikipedra/az',
    
    /* ADMIN */
	'admin' => 'admin/home/index',

	'admin/login' => 'auth/login',
    'admin/login/senha' => 'auth/senha',
    'admin/login/senha/(:any)' => 'auth/senha/$1',
    'admin/logout' => 'auth/logout',
    'admin/alterar-senha' => 'admin/usuario/alterar_senha',

    'admin/meus-dados' => 'admin/usuario/meus_dados',
    'admin/usuarios/(:any)/(:any)' => 'admin/usuario/$1/$2',
    'admin/usuarios/(:any)' => 'admin/usuario/$1',
    'admin/usuarios' => 'admin/usuario',

    'admin/vitrines/(:any)' => 'admin/vitrine/$1',
    'admin/vitrines' => 'admin/vitrine',

    'admin/galerias/(:any)' => 'admin/galeria/$1',
    'admin/galerias' => 'admin/galeria',

    /*'admin/produtos/(:any)/(:any)/(:any)' => 'admin/produto/$1/$2/$3',
    'admin/produtos/(:any)/(:any)' => 'admin/produto/$1/$2',
    'admin/produtos/(:any)' => 'admin/produto/$1',*/

    'admin/produtos/cadastrar' => 'admin/produto/cadastrar',
    'admin/produtos/editar/(:num)' => 'admin/produto/editar/$1',
    'admin/produtos/status/(:num)/(:num)' => 'admin/produto/status/$1/$2',
    'admin/produtos/ordenar' => 'admin/produto/ordenar',
    'admin/produtos/cadastrar/verifyslug' => 'admin/produto/verifyslug',
    'admin/produtos/editar/(:num)/verifyslug' => 'admin/produto/verifyslug',
    'admin/produtos/excluir/(:num)' => 'admin/produto/excluir/$1',


    'admin/produtos/(:any)/cadastrar/verifyslug' => 'admin/produtos/$1/verifyslug',
    'admin/produtos/(:any)/editar/(:num)/verifyslug' => 'admin/produtos/$1/verifyslug',

    'admin/pedreiras/cadastrar' => 'admin/pedreira/cadastrar',
    'admin/pedreiras/editar/(:num)' => 'admin/pedreira/editar/$1',
    'admin/pedreiras/status/(:num)/(:num)' => 'admin/pedreira/status/$1/$2',
    'admin/pedreiras/ordenar' => 'admin/pedreira/ordenar',
    'admin/pedreiras/cadastrar/verifyslug' => 'admin/pedreira/verifyslug',
    'admin/pedreiras/editar/(:num)/verifyslug' => 'admin/pedreira/verifyslug',
    'admin/pedreiras/(:any)' => 'admin/pedreira/$1',
    'admin/pedreiras' => 'admin/pedreira',

    
    'admin/produtos' => 'admin/produto',


    'admin/noticias/cadastrar/verifyslug' => 'admin/noticias/verifyslug',
    'admin/noticias/editar/(:num)/verifyslug' => 'admin/noticias/verifyslug',

    'admin/segmentos/cadastrar/verifyslug' => 'admin/segmentos/verifyslug',
    'admin/segmentos/editar/(:num)/verifyslug' => 'admin/segmentos/verifyslug',

    'admin/sustentabilidade/(:any)/cadastrar/verifyslug' => 'admin/sustentabilidade/$1/verifyslug',
    'admin/sustentabilidade/(:any)/editar/(:num)/verifyslug' => 'admin/sustentabilidade/$1/verifyslug',


);