<?php
class Controller_Admin_Galeria extends Controller_Admin_Base
{
	public function before()
	{
		parent::before();
		$this->pageData['activeMenu']['galeria'] = 'active';
	}

	public function post_cadastrar()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if(!($id = Model_Galeria::save_item())){
					throw new Exception('save');
				}

				Session::set_flash('msgFeedback', 'Item cadastrado com sucesso.');
				$arr['status'] = 'ok';
				$arr['id'] = $id;
				
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

				if(!Model_Galeria::save_item($id)){
					throw new Exception('save');
				}

				Session::set_flash('msgFeedback', 'Item editado com sucesso.');
				$arr['status'] = 'ok';
				$arr['id'] = $id;
				
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

				if($item = Model_Galeria::find($id)){
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

				Model_Galeria::set_status($id, $tipo);

			} catch(Exception $e){
				$arr['status'] = 'error';
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function action_index()
	{
		$this->pageData['title'] = 'Galerias | ' . $this->pageData['title'];

		$termoBusca = Input::get('s', null);
		$configPag = Config::load('config_pagination');
		$configPag['total_items'] = Model_Galeria::get_total(false, $termoBusca);
		$pagination = Pagination::forge('pagination', $configPag);

		$this->pageData['itens'] = Model_Galeria::get_itens($pagination->per_page, $pagination->offset, false, array(), $termoBusca);
		$this->pageData['pagination'] = $pagination;
		$this->pageData['termoBusca'] = $termoBusca;
		$this->pageData['totalBusca'] = $configPag['total_items'];
		
		return $this->forgeViews('galerias/index');
	}

	public function action_cadastrar()
	{
		$this->pageData['title'] = 'Cadastrar | Galerias | ' . $this->pageData['title'];
		$this->pageData['formCreate'] = true;
		$this->pageData['imgW'] = 2000;
		$this->pageData['imgH'] = 320;
		$this->pageData['tltArea'] = Input::get('tlt', false);

		$this->pageData['itemTitulo'] = urldecode(Input::get('titulo', null));
		
		return $this->forgeViews('galerias/cadastrar');
	}

	public function action_editar($id)
	{
		$this->pageData['title'] = 'Editar | Galerias | ' . $this->pageData['title'];
		$this->pageData['item'] = Model_Galeria::get_item($id);
		$this->pageData['imgW'] = 2000;
		$this->pageData['tltArea'] = Input::get('tlt', false);

		if($id == 1){
			$this->pageData['imgH'] = 450;
		} else {
			$this->pageData['imgH'] = 320;
		}
		
		return $this->forgeViews('galerias/editar');
	}
}