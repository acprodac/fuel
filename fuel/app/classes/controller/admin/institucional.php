<?php
class Controller_Admin_Institucional extends Controller_Admin_Base
{
	public function action_index()
	{
		$this->pageData['title'] = 'Institucional | ' . $this->pageData['title'];
		$this->pageData['activeMenu']['institucional'] = 'active';

		return $this->forgeViews('institucional/index');
	}
}