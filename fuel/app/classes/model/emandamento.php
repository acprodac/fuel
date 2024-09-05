<?php

class Model_Emandamento extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'id_vitrine' => array(),
		'titulo' => array(
			'validation' => array('required')
		),
		'texto' => array(
			'validation' => array('required')
		),
		'data_publicado' => array(),
		'imagem' => array(),
		'imagem_peso' => array(),
		'imagem_formato' => array(),
		'imagem_tamanho' => array(),
		'ordem',
		'exibir_home' => array(),
		'data_exibir_home',
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

	protected static $_conditions = array(
        'order_by' => array('ordem' => 'asc')
    );

	protected static $_table_name = 'emandamento';

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

	public static function save_item($id = 0)
    {

    	$returnArr = array();

    	$val = Validation::forge();
		$val->add_callable('Utility_Rulesvalidation');
		$val->add_model('Model_Emandamento');

		try{
			DB::start_transaction();

			if(!$val->run()){
				throw new Exception('validate');
			}

			settype($id, 'integer');

			if($id){
				$item = Model_Emandamento::find($id);
				if(empty($item)){
					throw new Exception('nao-encontrado');
				}
			} else {
				$item = new Model_Emandamento();
				Model_Emandamento::increment_ordem();
				$item->ordem = 1;
			}

			foreach(self::$_properties as $key=>$elem){
				if(is_numeric($key)) continue;

				if($key == 'exibir_home'){
					$exibir = Input::post($key, null);
					if(!empty($exibir) && !$item->$key){
						$item->data_exibir_home = time();
					}
				}

				$item->$key = Input::post($key, null);
			}

			if(!$id){
				$item->status = 1;
			}

			if(!$item->save()){
				throw new Exception('save');
			}

			DB::commit_transaction();
			
			return true;

		} catch(Exception $e){
			if(DB::in_transaction()){
				DB::rollback_transaction();
			}

			$returnArr['status'] = 'error';
			$returnArr['info'] = $e->getMessage();

			if($e->getMessage() == 'validate'){
				$returnArr['fields'] = Utility_Rulesvalidation::return_errors($val);
				logger(\Fuel::L_ERROR, '*** Error - Admin - ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());
				return false;
			}
		}
    }

    public static function set_status($id, $status)
    {
    	$returnArr = array();
    	try {
    		settype($id, 'integer');
    		settype($status, 'integer');

    		$item = Model_Emandamento::find($id);

	    	if(empty($item)){
	    		throw new Exception('nao-encontrado');
	    	}

	    	$item->status = (int) $status === 1;

	    	if(!$item->save()){
	    		throw new Exception('save');
	    	}

	    	$returnArr['status'] = 'ok';
    	} catch(Exception $e){
    		$returnArr['status'] = 'error';
    		$returnArr['info'] = array($e->getMessage());
    	}

    	return $returnArr;
    }

    public static function get_itens($limit = 0, $offset = 0, $ativo = false, array $order = array(), $termo = null, $home = false)
    {
    	$query = Model_Emandamento::query();

    	if($home){
			$query->where('exibir_home', 1);
			$query->order_by('ordem', 'ASC');
		}
		
    	if($limit){
    		$query->limit($limit);
		}

		if($offset){
			$query->offset($offset);
		}

		if($ativo){
			$query->where('status', 1);
		}

		if(!empty($termo)){
			$query->where('titulo', 'LIKE', '%' . $termo . '%');
			$order = DB::expr("IF( titulo LIKE '$termo%',0, IF(titulo LIKE '%$termo', 1, 2 ))");
		}
		
		if($order){
			$query->order_by($order);
		}

		return $query->get();
    }

    public static function get_item($id)
    {	
    	if(is_numeric($id)){
    		$item = Model_Emandamento::find($id);
    	} else {
    		$cond = array('where' => array(
    			array('slug', $id),
    			array('status', 1)
    		));

    		$item = Model_Emandamento::find('first', $cond);
    	}

    	if(empty($item)){
    		return null;
    	}

		return $item;
    }

    public static function get_by_slug($slug)
    {
    	$cond = array('where' => array(
			array('slug', $slug),
			array('status', 1)
		));

		$item = Model_Emandamento::find('first', $cond);

    	if(empty($item)){
    		return null;
    	}

		return $item;
    }

    public static function get_total($ativo = false, $termo = null)
    {
    	$cond = array('where' => array());

    	if($ativo){
    		$cond['where'][] = array('status', 1);
    	}

    	if(!empty($termo)){
			$cond['where'][] = array('titulo', 'LIKE', '%' . $termo . '%');
		}

    	$item = Model_Emandamento::find('all', $cond);

    	return count($item);
    }

    protected static function increment_ordem()
    {
    	DB::query('UPDATE `' . self::$_table_name . '` SET `ordem` = `ordem` + 1 WHERE `ordem` IS NOT NULL AND `ordem` > 0')->execute();
    }

    public static function ordenar()
    {
    	$data = Input::post('ordem', array());

    	DB::start_transaction();

    	foreach($data as $pos=>$key){
    		$item = Model_Emandamento::find($key);

    		if(!empty($item)){
    			$item->ordem = $pos + 1;
    			if(!$item->save()){
    				DB::rollback_transaction();
    				return false;
    			}
    		}
    	}

    	DB::commit_transaction();
    	return true;
    }

}
