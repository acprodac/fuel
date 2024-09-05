<?php

class Model_Imagemgaleria extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'id_galeria',
		'titulo',
		'texto',
		'thumb',
		'thumb_tamanho',
		'thumb_formato',
		'thumb_peso',
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

	protected static $_table_name = 'imagem_galeria';

	protected static $_conditions = array(
        'order_by' => array('id' => 'asc')
    );

	protected static $_belongs_to = array(
	    'galeria' => array(
	        'key_from' => 'id_galeria',
	        'model_to' => 'Model_Galeria',
	        'key_to' => 'id'
	   	)
	);

}
