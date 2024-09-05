<?php
class Controller_Contato extends Controller_Base
{
	public function post_index()
	{
		
	}

	public function action_index()
	{

		$page = Model_Institucional::get_item('contato');

		$this->pageData['title'] = $page->titulo_page;
		$this->pageData['description'] = $page->descricao_page;
		$this->pageData['keywords'] = $page->keywords;

		$this->pageData['bodyClass'] = 'contato';
		$this->pageData['m']['contato'] = 'mark';

		$this->pageData['vitrine'] = $page->vitrine;
		//$this->pageData['itemGaleria'] = $page->galeria;
		$this->pageData['page'] = $page;

		return $this->forgeViews('contato/index');
	}
}