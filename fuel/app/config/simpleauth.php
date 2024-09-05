<?php
return array(
	'db_connection' => null,
	'table_name' => 'users',
	'table_columns' => array('*'),
	'guest_login' => false,
	'multiple_logins' => true,
	'remember_me' => array(
		'enabled' => true,
		'cookie_name' => 'proj_rmcookie',
		'expiration' => 86400 * 15,
	),
	'login_hash_salt' => '^hxxhBfeYDA2xi+YTj{_Z7}A`pB-i#DO6(ySV?D*C5<Xu|151(ewsGO(Fgj}(K>O',
	'username_post_key' => 'username',
	'password_post_key' => 'password',
	'groups' => array(
		80 => array('name' => 'Default', 'roles' => array('default')),
		90 => array('name' => 'Admin', 'roles' => array('default', 'admin')),
		100 => array('name' => 'Master', 'roles' => array('default', 'admin', 'master'))
	),
	'roles' => array(
		'default' => array('admin' => array('create', 'read', 'write')),
		'admin' => array('users' => array('create', 'read')),
		'master' => true
	),
);