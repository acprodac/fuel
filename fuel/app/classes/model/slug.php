<?php

class Model_Slug extends \Model
{
	protected $model;
	
	public function __construct($model)
	{
		$this->model = $model;
	}
	
	public function generateSlug($tlt)
	{
		if($tlt){
			return Model_Slug::getValidSlug(Inflector::friendly_title($tlt, '-', TRUE));
		}

		return null;
	}
	
	public function getValidSlug($slug, $id = 0)
	{
		settype($id, 'integer');
		$arrWhere = array(array('slug', 'REGEXP', '^' . $slug . '(-[0-9]{1,3})?$'));
		
		if($id){
			$arrWhere[] = array('id', '!=', $id);
		}
		
		$model = $this->model;
		$verifyItem = $model::find('first', array('where' => $arrWhere, 'order_by' => array('slug' => 'desc'), 'limit' => 1));
		
		if(!empty($verifyItem)){
			$results = preg_match('/-([0-9]{1,3})$/', $verifyItem->slug, $matches);
			if(!$results){
				$slug .= '-1';
			} else {
				$test = preg_match('/-([0-9]{1,3})$/', $slug);
				if($test){
					$slug = preg_replace('/-([0-9]{1,3})$/', ('-' . ((integer) $matches[1] + 1)), $slug);
				} else {
					$slug .= ('-' . ((integer) $matches[1] + 1));
				}
			}
		}
		
		return $slug;
	}
}