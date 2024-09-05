<?php

return array(
    'defaults' => array(
        'useragent' => 'FuelPHP, PHP 5.3 Framework',
        'driver'    => 'smtp',
        'from' => array(
			'email' => 'atendimento@embusa.com.br',
			'name'  => 'Atendimento EMBU SA',
		),
        'smtp' => array(
			'host'		=> 'mail.embusa.com.br',
			'port'		=> 587,
			'username'	=> 'atendimento',
			'password'	=> 'S1te@Embu',
			'timeout'	=> 30,
		)
    )
);