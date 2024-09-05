<?php

class Model_Contato extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nome' => array(
			'validation' => array('required'),
			'tlt_email' => 'Nome'
		),
		'email' => array(
			'validation' => array('required', 'valid_email'),
			'tlt_email' => 'E-mail'
		),
		'mensagem'  => array(
			'tlt_email' => 'Mensagem'
		),
		'ip'  => array(
			'tlt_email' => 'IP'
		),
		'email_enviado',
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
	
	protected static $_table_name = 'contato';

	protected static $_conditions = array(
        'order_by' => array('created_at' => 'desc')
    );

	public static function save_item()
	{
		$val = Validation::forge();
		$val->add_callable('Utility_Rulesvalidation');
		$val->add_model('Model_Contato');

		if(!$val->run()){
			return Utility_Rulesvalidation::return_errors($val);
		}

		$item = new Model_Contato();
		$item->nome = Input::post('nome', null);
		$item->email = Input::post('email', null);
		$item->mensagem = Input::post('mensagem', null);
		$item->ip = $_SERVER['REMOTE_ADDR'];

		if(!$item->save()){
			return false;
		}

		return array('success' => 1, 'id' => $item->id);
	}

	public static function get_itens($limit = 0, $offset = 0){
    	$cond = array('where' => array());

    	if($limit){
			$cond['limit'] = $limit;
		}

		if($offset){
			$cond['offset'] = $offset;
		}

		$data1 = Input::get('data1', false);
		$data2 = Input::get('data2', false);

		if($data1){
			list($dia, $mes, $ano) = explode('-', $data1);
			$data1 = mktime(0, 0, 0, (integer) $mes, (integer) $dia, (integer) $ano);
			$cond['where'][] = array('created_at', '>=', $data1);
		}

		if($data2){
			list($dia, $mes, $ano) = explode('-', $data2);
			$data2 = mktime(0, 0, 0, (integer) $mes, (integer) $dia, (integer) $ano);
			$cond['where'][] = array('created_at', '<=', $data2);
		}

    	return Model_Contato::find('all', $cond);
    }

    public static function get_item($id, $email = false)
    {
    	$item = Model_Contato::find($id);

    	if(empty($item)){
    		return null;
    	}

		if(empty($email)){
    		return $item;	
    	}

    	return Utility_Emailsend::format_item(self::$_properties, $item);
    }

    public static function get_total()
    {
    	$cond = array('where' => array());

    	$data1 = Input::get('data1', false);
		$data2 = Input::get('data2', false);

		if($data1){
			list($dia, $mes, $ano) = explode('-', $data1);
			$data1 = mktime(0, 0, 0, (integer) $mes, (integer) $dia, (integer) $ano);
			$cond['where'][] = array('created_at', '>=', $data1);
		}

		if($data2){
			list($dia, $mes, $ano) = explode('-', $data2);
			$data2 = mktime(0, 0, 0, (integer) $mes, (integer) $dia, (integer) $ano);
			$cond['where'][] = array('created_at', '<=', $data2);
		}

    	$item = Model_Contato::find('all', $cond);

    	return count($item);
    }

}
