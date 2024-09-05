<?php
class Model_Usuario extends \Orm\Model
{
	protected static $_table_name = 'users';

	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields' => array(
			'data_type' => 'serialize',
		),
		'lostpassword_hash',
		'lostpassword_created',
		'lostpassword_type',
		'name',
		'created_at',
		'updated_at',
	);

	protected static $_to_array_exclude = array(
        'password', 'login_hash'
    );

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_Typing' => array(
			'events' => array('before_save', 'after_save', 'after_load'),
		),
	);

	protected static $_conditions = array(
        'order_by' => array('name' => 'asc')
    );

	public function get_name()
	{
		return $this->profile_fields['name'];
	}
}