<?php
class Controller_Produtos extends Controller_Base
{

	public function before()
	{
		parent::before();
		
		$page = Model_Institucional::get_item('produtos');

		$this->pageData['title'] = $page->titulo_page;
		$this->pageData['description'] = $page->descricao_page;
		$this->pageData['keywords'] = $page->keywords;

		$this->pageData['bodyClass'] = 'produtos';
		$this->pageData['m']['produtos'] = 'mark';

		$this->pageData['vitrine'] = $page->vitrine;
		$this->pageData['itemGaleria'] = $page->galeria;
		$this->pageData['page'] = $page;

		$this->pageData['set'] = array();
		$this->pageData['ap'] = array();
	}

	public function action_index($setor, $aplicacao)
	{
		$arrSetor = array();
		$arrAplicacao = array();

		if($setor == 'todos'){
			$arrSetor = Model_Produto::get_itens(0, 0, true);
		}
		if($aplicacao == 'todos'){
			$arrAplicacao = Model_Produto::get_itens(0, 0, true);
		}

		$set = Model_Setor::get_by_slug($setor);
		$ap = Model_Aplicacao::get_by_slug($aplicacao);
		$idSet = 0;
		$idAp = 0;

		if(!empty($set)){
			$idSet = $set->id;
			$arrSetor = Model_Setor::get_by_slug($setor, true);
		}

		if(!empty($ap)){
			$idAp = $ap->id;
			$arrAplicacao = Model_Aplicacao::get_by_slug($aplicacao, true);
		}

		$set = empty($set) ? 'todos' : $set->slug;
		$ap = empty($ap) ? 'todos' : $ap->slug;

		$this->pageData['slugSetor'] = $set;
		$this->pageData['slugAplicacao'] = $ap;
		$this->pageData['set'][$set] = 'mark';
		$this->pageData['ap'][$ap] = 'mark';

		$this->pageData['aplicacoes'] = Model_Aplicacao::get_itens(0, 0, true);
		$this->pageData['setores'] = Model_Setor::get_itens(0, 0, true);
		$this->pageData['produtos'] = array_intersect_key($arrSetor, $arrAplicacao);

		return $this->forgeViews('produtos/index');
	}

	public function action_interna($slug)
	{
		$prod = Model_Produto::get_by_slug($slug);

		if(empty($prod)){
			throw new HttpNotFoundException;
		}

		$this->pageData['title'] = $prod->titulo;

		$this->pageData['produto'] = $prod;
		$this->pageData['vitrine'] = $prod->vitrine;
		$this->pageData['itemGaleria'] = $prod->galeria;

		$this->pageData['bodyClass'] = 'produtos_detalhe';

		return $this->forgeViews('produtos/interna');
	}
}