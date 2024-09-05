<?php
class Controller_Admin_Emandamento extends Controller_Admin_Base
{
	public function before()
	{
		parent::before();
		$this->pageData['activeMenu']['emandamento'] = 'active';

		$page = Model_Institucional::get_item('emandamento');
		$this->pageData['vitrineDefault'] = $page->vitrine->id;
		$this->pageData['page'] = $page;
	}

	public function post_index()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if(!Model_Institucional::save_item('emandamento')){
					throw new Exception('save');
				}

				Session::set_flash('msgFeedback', 'Página atualizada com sucesso.');
				$arr['status'] = 'ok';
				
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_cadastrar()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if(!Model_Emandamento::save_item()){
					throw new Exception('save');
				}

				Session::set_flash('msgFeedback', 'Item cadastrado com sucesso.');
				$arr['status'] = 'ok';
				
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_editar($id)
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if(!Model_Emandamento::save_item($id)){
					throw new Exception('save');
				}

				Session::set_flash('msgFeedback', 'Item editado com sucesso.');
				$arr['status'] = 'ok';
				
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_excluir($id)
	{
		$arr = array('status' => 'ok', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if($item = Model_Emandamento::find($id)){
					$item->delete();
				}
				
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_status($id, $tipo)
	{
		$arr = array('status' => 'ok', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				Model_Emandamento::set_status($id, $tipo);

			} catch(Exception $e){
				$arr['status'] = 'error';
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_ordenar()
	{
		$arr = array('status' => 'ok', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if(!Model_Emandamento::ordenar()){
					throw new Exception('save');
				}

				Session::set_flash('msgFeedback', 'Itens reordenados com sucesso.');
				
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_verifyslug()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				$model = new Model_Slug('Model_Emandamento');
				if(!($slug = $model->generateSlug(Input::post('title', false)))){
					throw new Exception('cadastrado');
				}

				$arr['status'] = 'ok';
				$arr['slug'] = $slug;
				
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function action_index()
	{
		$this->pageData['title'] = 'emandamento | ' . $this->pageData['title'];

		$termoBusca = Input::get('s', null);
		$configPag = Config::load('config_pagination');
		$configPag['total_items'] = Model_Emandamento::get_total(false, $termoBusca);
		$pagination = Pagination::forge('pagination', $configPag);

		$this->pageData['itens'] = Model_Emandamento::get_itens($pagination->per_page, $pagination->offset, false, array(), $termoBusca);
		$this->pageData['pagination'] = $pagination;
		$this->pageData['termoBusca'] = $termoBusca;
		$this->pageData['totalBusca'] = $configPag['total_items'];
		
		return $this->forgeViews('emandamento/index');
	}

	public function action_cadastrar()
	{
		$this->pageData['title'] = 'Cadastrar | emandamento | ' . $this->pageData['title'];
		$this->pageData['formCreate'] = true;

		$this->pageData['vitrines'] = Model_Vitrine::get_itens(0, 0);
		$this->pageData['galerias'] = Model_Galeria::get_itens(0, 0);
		
		return $this->forgeViews('emandamento/cadastrar');
	}

	public function action_editar($id)
	{
		$this->pageData['title'] = 'Editar | emandamento | ' . $this->pageData['title'];
		$this->pageData['item'] = Model_Emandamento::get_item($id);

		$this->pageData['vitrines'] = Model_Vitrine::get_itens(0, 0);
		$this->pageData['galerias'] = Model_Galeria::get_itens(0, 0);
		
		return $this->forgeViews('emandamento/editar');
	}

	public function action_ordenar()
	{
		$this->pageData['title'] = 'Ordenar | Produto | ' . $this->pageData['title'];
		$this->pageData['itens'] = Model_Emandamento::get_itens();
		$this->pageData['numItens'] = Model_Emandamento::get_total(true);

		return $this->forgeViews('emandamento/ordenar');
	}
}