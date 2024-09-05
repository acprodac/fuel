<?php
class Controller_Premios extends Controller_Base
{

	public function before()
	{
		parent::before();
		
		$page = Model_Institucional::get_item('premios');

		$this->pageData['title'] = $page->titulo_page;
		$this->pageData['description'] = $page->descricao_page;
		$this->pageData['keywords'] = $page->keywords;

		$this->pageData['bodyClass'] = 'premios';
		$this->pageData['m']['premios'] = 'mark';

		$this->pageData['vitrine'] = $page->vitrine;
		$this->pageData['itemGaleria'] = $page->galeria;
		$this->pageData['page'] = $page;
	}

	public function action_index()
	{
		$this->pageData['produtos'] = Model_Premios::get_itens(0, 0, true);

		return $this->forgeViews('premios/index');
	}

	public function action_interna($slug)
	{
		$prod = Model_Premios::get_by_slug($slug);

		if(empty($prod)){
			throw new HttpNotFoundException;
		}

		$this->pageData['title'] = $prod->titulo;

		$this->pageData['produto'] = $prod;
		$this->pageData['vitrine'] = $prod->vitrine;
		$this->pageData['itemGaleria'] = $prod->galeria;

		$this->pageData['bodyClass'] = 'premios_detalhe';

		return $this->forgeViews('premios/interna');
	}
}