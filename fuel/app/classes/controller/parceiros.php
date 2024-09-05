<?php
class Controller_Parceiros extends Controller_Base
{

	public function action_index()
	{
		
		$page = Model_Institucional::get_item('parceiros');

		$this->pageData['title'] = $page->titulo_page;
		$this->pageData['description'] = $page->descricao_page;
		$this->pageData['keywords'] = $page->keywords;

		$this->pageData['bodyClass'] = 'home parceiros';
		$this->pageData['m']['parceiros'] = 'mark';

		$this->pageData['vitrine'] = $page->vitrine;
		// $this->pageData['itemGaleria'] = $page->galeria;
		$this->pageData['page'] = $page;

		return $this->forgeViews('parceiros/index');
	}
}