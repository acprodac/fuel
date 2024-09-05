<?php
class Controller_Admin_Home_Vitrines extends Controller_Admin_Base
{
	public function before()
	{
		parent::before();
		$this->pageData['title'] = 'Vitrines | Home | ' . $this->pageData['title'];
		$this->pageData['activeMenu']['home'] = 'active';
		$this->pageData['activeMenu']['home-vitrines'] = 'active';
	}


	public function post_cadastrar()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if(!Model_Vitrine::save_item()){
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

				if(!Model_Vitrine::save_item($id)){
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

				if($item = Model_Vitrine::find($id)){
					$item->delete();
				}
				
			} catch(Exception $e){
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

				if(!Model_Vitrine::ordenar()){
					throw new Exception('save');
				}

				Session::set_flash('msgFeedback', 'Itens reordenados com sucesso.');
				
			} catch(Exception $e){
				$arr['status'] = 'error';
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

				Model_Vitrine::set_status($id, $tipo);
				
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function action_index()
	{
		$configPag = Config::load('config_pagination');
		$configPag['total_items'] = Model_Vitrine::count();
		$pagination = Pagination::forge('pagination', $configPag);

		$this->pageData['itens'] = Model_Vitrine::get_itens($pagination->per_page, $pagination->offset);
		$this->pageData['pagination'] = $pagination;

		return $this->forgeViews('home/vitrines');
	}

	public function action_cadastrar()
	{
		$this->pageData['formCreate'] = true;

		return $this->forgeViews('home/vitrines_cadastrar');
	}

	public function action_editar($id)
	{
		$this->pageData['item'] = Model_Vitrine::get_item($id);

		return $this->forgeViews('home/vitrines_editar');
	}

	public function action_ordenar()
	{
		$this->pageData['itens'] = Model_Vitrine::get_itens();
		$this->pageData['numItens'] = Model_Institucional::get_total_home('vitrine');

		return $this->forgeViews('home/vitrines_ordenar');
	}
}