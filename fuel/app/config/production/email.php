<?php

return array(
    'defaults' => array(
        'useragent' => 'FuelPHP, PHP 5.3 Framework',
        'driver'    => 'smtp',
        'from' => array(
			'email' => 'suporte@prodac.com.br',
			'name'  => 'Site PRODAC',
		),
        'smtp' => array(
			'host'		=> 'smtp.prodac.com.br',
			'port'		=> 587,
			'username'	=> 'suporte=prodac.com.br',
			'password'	=> 'juka128adi128',
			'timeout'	=> 30,
		)
    )
);