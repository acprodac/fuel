<?php
class Controller_Emandamento extends Controller_Base
{
	public function before()
	{
		parent::before();
		
		$page = Model_Institucional::get_item('emandamento');

		$this->pageData['title'] = $page->titulo_page;
		$this->pageData['description'] = $page->descricao_page;
		$this->pageData['keywords'] = $page->keywords;

		$this->pageData['bodyClass'] = 'emandamento';
		$this->pageData['m']['emandamento'] = 'mark';

		$this->pageData['vitrine'] = $page->vitrine;
		$this->pageData['itemGaleria'] = $page->galeria;
		$this->pageData['page'] = $page;
	}

	public function action_index()
	{
		$this->pageData['produtos'] = Model_emandamento::get_itens(0, 0, true);

		return $this->forgeViews('emandamento/index');
	}

}