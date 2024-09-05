<?php
class Controller_Servicos extends Controller_Base
{

	public function action_index()
	{
		
		$page = Model_Institucional::get_item('servicos');

		$this->pageData['title'] = $page->titulo_page;
		$this->pageData['description'] = $page->descricao_page;
		$this->pageData['keywords'] = $page->keywords;

		$this->pageData['bodyClass'] = 'home servicos';
		$this->pageData['m']['servicos'] = 'mark';

		$this->pageData['vitrine'] = $page->vitrine;
		// $this->pageData['itemGaleria'] = $page->galeria;
		$this->pageData['page'] = $page;

		return $this->forgeViews('servicos/index');
	}
}

