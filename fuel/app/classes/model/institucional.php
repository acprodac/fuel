<?php

class Model_Institucional extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'id_vitrine',
		'id_galeria' => array(),
		'titulo' => array(),
		'titulo_page' => array(),
		'descricao' => array(),
		'descricao_page' => array(),
		'keywords' => array(),
		'slug',
		'fields' => array(
			'data_type' => 'serialize',
		),
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
		'Orm\Observer_Typing' => array(
			'events' => array('before_save', 'after_save', 'after_load'),
		),
	);

	protected static $_table_name = 'institucional';

	protected static $_belongs_to = array(
	    'galeria' => array(
	        'key_from' => 'id_galeria',
	        'model_to' => 'Model_Galeria',
	        'key_to' => 'id'
	   	),
	   	'vitrine' => array(
	        'key_from' => 'id_vitrine',
	        'model_to' => 'Model_Vitrine',
	        'key_to' => 'id'
	   	)
	);

	public static function save_item($slug){

		try {
			$item = Model_Institucional::find('first', array(
				'where' => array(
					array('slug', $slug)
				)
			));

			error_log("PRINT R");
			error_log(print_r($item, true));

			foreach(self::$_properties as $key=>$elem){
				if(is_numeric($key)) continue;

				$val = Input::post($key, false);

				if($val !== false){
					$item->$key = $val;
				}
			}

			return $item->save();

		} catch(Exception $e){
			logger(\Fuel::L_ERROR, '*** Error - Admin - ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());
			return false;
		}
	}

	public static function get_item($slug){
		$item = Model_Institucional::find('first', array(
			'where' => array(
				array('slug', $slug)
			)
		));

		if(is_array($item->fields)){
			foreach($item->fields as $key=>$elem){
				$item->$key = $elem;
			}
		}

		return $item;
	}

}
