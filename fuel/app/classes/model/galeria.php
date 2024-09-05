<?php

class Model_Galeria extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'titulo' => array(
			'validation' => array('required')
		),
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
        'order_by' => array('titulo' => 'asc')
    );

	protected static $_table_name = 'galeria';

	protected static $_has_many = array(
	    'imagens' => array(
	   		'key_from' => 'id',
	        'model_to' => 'Model_Imagemgaleria',
	        'key_to' => 'id_galeria'
	   	),
	   	'institucional' => array(
	        'key_from' => 'id',
	        'model_to' => 'Model_Institucional',
	        'key_to' => 'id_galeria'
	   	),
	);

	public static function save_item($id = 0)
    {
    	$returnArr = array();

    	$val = Validation::forge();
		$val->add_callable('Utility_Rulesvalidation');
		$val->add_model('Model_Galeria');

		try{
			DB::start_transaction();

			if(!$val->run()){
				throw new Exception('validate');
			}

			settype($id, 'integer');

			if($id){
				$item = Model_Galeria::find($id);
				if(empty($item)){
					throw new Exception('nao-encontrado');
				}
			} else {
				$item = new Model_Galeria();
			}

			$item->titulo = Input::post('titulo', null);

			if($id && !empty($item->imagens)){
				foreach($item->imagens as $itlFotos){
					$itlFotos->delete();
				}
			}

			$item->imagens = array();

			$imagens = Input::post('imagem', null);

			if(!empty($imagens) && is_array($imagens)){
				foreach($imagens as $keyI=>$itemDoc){
					if(empty($itemDoc['imagem'])) continue;

					$pathImg = DOCROOT . 'upload' . DS . 'img' . DS . $itemDoc['imagem'];
					if(file_exists($pathImg) && !is_dir($pathImg)){
						$itemImg = new Model_Imagemgaleria();
						$itemImg->titulo = $itemDoc['titulo'];
						$itemImg->texto = $itemDoc['texto'];
						$itemImg->imagem = $itemDoc['imagem'];
						$itemImg->imagem_formato = $itemDoc['imagem_formato'];
						$itemImg->imagem_peso = $itemDoc['imagem_peso'];
						$itemImg->imagem_tamanho = $itemDoc['imagem_tamanho'];
						$itemImg->status = 1;

						$item->imagens[] = $itemImg;
					}
				}
			}

			if(!$id){
				$item->status = 1;
			}

			if(!$item->save()){
				throw new Exception('save');
			}

			DB::commit_transaction();
			
			return $item->id;

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

    		$item = Model_Galeria::find($id);

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

    public static function get_itens($limit = 0, $offset = 0, $ativo = false, array $order = array(), $termo = null)
    {
    	$query = Model_Galeria::query();
		
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

    public static function get_item($id, $status = false)
    {	
    	if(!$status){
    		$item = Model_Galeria::find($id);
    	} else {
    		$cond = array('where' => array(
    			array('id', $id),
    			array('status', 1)
    		));

    		$item = Model_Galeria::find('first', $cond);
    	}

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

    	$item = Model_Galeria::find('all', $cond);

    	return count($item);
    }

}
