<?php
return array(
	'default' => array(
        'wrapper'                 => "<div class=\"btn-toolbar\"><div class=\"btn-group btn-groupPaginate\">\n\t{pagination}\n</div></div>\n",

		'first'                   => "{link}\n",
		'first-marker'            => "&laquo;&laquo;",
		'first-link'              => "\t\t<button class=\"btn btn-pag-first btnLink\" data-uri=\"{uri}\" title=\"Ir para a primeira página\">{page}</button>\n",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "{link}\n",
		'previous-marker'         => "&laquo;",
		'previous-link'           => "\t\t<button class=\"btn btn-pag-first btnLink\" data-uri=\"{uri}\" rel=\"prev\" title=\"Ir para a página anterior\">{page}</button>\n",

		'previous-inactive'       => "{link}\n",
		'previous-inactive-link'  => "\t\t<button class=\"btn btn-pag-first disabled\" data-uri=\"#\" rel=\"prev\">{page}</button>\n",

		'regular'                 => "{link}\n",
		'regular-link'            => "\t\t<button class=\"btn btnLink\" data-uri=\"{uri}\" title=\"Página {page}\">{page}</button>\n",

		'active'                  => "{link}\n",
		'active-link'             => "\t\t<button class=\"btn active\" data-uri=\"#\">{page}</button>\n",

		'next'                    => "{link}\n",
		'next-marker'            => "&raquo;",
		'next-link'               => "\t\t<button class=\"btn btn-pag-last btnLink\" data-uri=\"{uri}\" rel=\"next\" title=\"Ir para a próxima página\">{page}</button>\n",

		'next-inactive'           => "{link}\n",
		'next-inactive-link'      => "\t\t<button class=\"btn btn-pag-last disabled\" data-uri=\"next\">{page}</button>\n",

		'last'                    => "{link}\n",
		'last-marker'             => "&raquo;&raquo;",
		'last-link'               => "\t\t<button class=\"btn btn-pag-last btnLink\" data-uri=\"{uri}\" title=\"Ir para a última página\">{page}</button>\n",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),
	'site' => array(
        'wrapper' 				=> '<div class="paginação">{pagination}</div>',
        'first'					=> '',
        'first-marker'			=> '',
        'first-link'			=> '',
		'first-inactive'       	=> '',
		'first-inactive-link'  	=> '',

		'previous'              => '{link}',
		'previous-marker'       => '',
		'previous-link'			=> '<a href="{uri}" class="btnCinza" title="Anterior"><strong>Anterior</strong></a>' . PHP_EOL,	

		'previous-inactive'       => '{link}',
		'previous-inactive-link'  => '<a href="#" class="btnCinza disabled" title="Anterior"><strong>Anterior</strong></a>' . PHP_EOL,

		'regular'                 => '{link}',
		'regular-link'			=> '<a href="{uri}" class="btnCinza" title="{page}"><strong>{page}</strong></a>' . PHP_EOL,

		'active'                  => '{link}',
		'active-link'             => '<a href="{uri}" class="btnCinza mark" title="{page}"><strong>{page}</strong></a>' . PHP_EOL,

		'next'                    => '{link}',
		'next-marker'            => '',
		'next-link'               => '<a href="{uri}" class="btnCinza" title="Próximo"><strong>Próximo</strong></a>' . PHP_EOL,

		'next-inactive'           => '{link}',
		'next-inactive-link'      => '<a href="{uri}" class="btnCinza disabled" title="Próximo"><strong>Próximo</strong></a> ' . PHP_EOL,

		'last'                    => '',
		'last-marker'             => '',
		'last-link'               => '',

		'last-inactive'           => '',
		'last-inactive-link'      => '',
	)
);
