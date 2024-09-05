<?php
class Controller_Home extends Controller_Base
{
	public function action_index()
	{
		$this->pageData['vitrine'] = $this->pageData['home']->vitrine;


		$this->pageData['m']['home'] = 'mark';
		$this->pageData['classDestaque'] = 'destHome';

		$this->pageData['segmentos'] = Model_Segmentos::get_itens(2, 0, true, array(), null, true,'segmentos');
		$this->pageData['premios'] = Model_Premios::get_itens(3, 0, true, array(), null, true,'premios');
		$this->pageData['obras'] = Model_Emandamento::get_itens(2, 0, true, array(), null, true);

		$this->pageData['destaque1'] = $this->pageData['home']->fields['destaque'][1];
		$this->pageData['destaque2'] = $this->pageData['home']->fields['destaque'][2];
		
		$this->pageData['page'] = Model_Institucional::get_item('home');

		return $this->forgeViews('home/index');
	}

	public function action_404()
	{
		$this->pageData['title'] = '404 - Página Não Encontrada';
		$this->pageData['hideFooter'] = true;
		$this->pageData['classBody'] = 'page-404';
		
		return View::forge('site/404', $this->pageData);
	}

}