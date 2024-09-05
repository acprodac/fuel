<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */


return array(
	'profiling'  => true,
	
	'default_timezone'  	=> 'America/Sao_Paulo',
    'log_threshold'     	=> Fuel::L_ERROR,
    'language'           	=> 'pt_BR',
	'language_fallback'		=> 'en',
	'locale'            	=> 'pt_BR.UTF-8',

	'security' => array(
        'uri_filter'    => array('htmlentities'),
        'output_filter' => array('Security::htmlentities'),
        'whitelisted_classes' => array(
			'Fuel\\Core\\Response',
			'Fuel\\Core\\View',
			'Fuel\\Core\\ViewModel',
			'Closure',
		),
        'csrf_autoload' => false,
        'csrf_token_key' => 'proj_csrf_token',
		'csrf_expiration' => 3600,
        'token_salt' => '+klSZ]et{Hxy@.,S.Sy6>(QO~+{$~IHq7gz3p_/m$xe7h8.pt6aXq):&%Kl-`+oT'
    ),

	'package_paths' => array(
		PKGPATH
	),

	'always_load' => array(
        'packages'  => array(
            'orm', 'auth'
        )
    )

);
