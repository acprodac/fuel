<?php
class Controller_Admin_Servicos extends Controller_Admin_Base
{
	public function post_index()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{

				if(!Model_Institucional::save_item('servicos')){
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

	public function action_index()
	{
		$this->pageData['title'] = 'A Prodac | ' . $this->pageData['title'];
		$this->pageData['activeMenu']['servicos'] = 'active';
		
		$this->pageData['item'] = Model_Institucional::get_item('servicos');

		return $this->forgeViews('servicos/index');
	}

}