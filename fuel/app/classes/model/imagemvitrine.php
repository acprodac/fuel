<?php

class Model_Imagemvitrine extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'id_vitrine',
		'titulo',
		'descricao',
		'link',
		'link_titulo',
		'link_target',
		'imagem',
		'imagem_tamanho',
		'imagem_formato',
		'imagem_peso',
		'status',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'imagem_vitrine';

	protected static $_belongs_to = array(
	    'vitrine' => array(
	        'key_from' => 'id_vitrine',
	        'model_to' => 'Model_Vitrine',
	        'key_to' => 'id'
	   	)
	);

}
