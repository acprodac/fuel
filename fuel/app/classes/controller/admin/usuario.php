<?php
class Controller_Admin_Usuario extends Controller_Admin_Base
{
	public function post_alterar_senha()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{
				$val = Validation::forge();
				$val->add_field('senhaNova', 'Nova Senha', 'required|min_length[4]');

				if(!Session::get('resetPasswd', false)){
					$val->add_field('senha', 'Senha', 'required|min_length[4]');
				}

				if($val->run()){
					$verify = TRUE;

					if(!Session::get('resetPasswd', false)){
						$usrEmail = Auth::get_email();
						$usrSenha = Input::post('senha');

						if(!Auth::validate_user($usrEmail, $usrSenha)){
							$verify = FALSE;
						}
					}

					if($verify){
						$oldPasswd = Auth::reset_password(Auth::get_email());
						Auth::change_password($oldPasswd, Input::post('senhaNova'));
						Session::delete('resetPasswd');
						$arr['status'] = 'ok';
						$arr['info'] = 'senha-alterada';

						Session::set_flash('msgFeedback', 'Senha alterada com sucesso.');
					} else {
						$arr['info'] = 'invalid-user';
					}
				} else {
					$arr['info'] = $val->error();
				}

			} catch(\Exception $e){
				$arr['info'] = $e->getMessage();
				logger(\Fuel::L_ERROR, '*** Error - Alterar Senha - Usuário - ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());
			}
		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_verifyemail()
	{
		$arr = array('status' => 'ok', 'cadastrado' => '0', 'token' => Security::fetch_token());

		if(Input::is_ajax()){
			if($user = Model_Usuario::find_by_email(Input::post('email'))){
				$arr['cadastrado'] = '1';
			}
		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}


	public function post_cadastrar()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			try{
				$val = Validation::forge();
				$val->add_field('nome', 'Nome', 'required');
				$val->add_field('senha', 'Senha', 'required|min_length[4]');
				$val->add_field('email', 'E-mail', 'required|valid_email');

				if($val->run()){
					$usrEmail = Input::post('email');
					$usrSenha = Input::post('senha');
					$usrNome = Input::post('nome');

					if($id = Auth::create_user($usrEmail, $usrSenha, $usrEmail, 90, array('name' => $usrNome))){
						$itemUser = Model_Usuario::find($id);
						$itemUser->name = $usrNome;
						$itemUser->save();

						$emailData = array('userName' => $usrNome, 'userEmail' => $usrEmail, 'userPasswd' => $usrSenha, 'urlAdmin' => Uri::create('admin/login/'), 'baseUrl' => Uri::base());

						require_once(PKGPATH . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'PHPMailerAutoload.php');

			            Config::load('email', 'email');
			            
			            $mail = new PHPMailer();
			            $mail->isSMTP();
			            $mail->SMTPDebug = 0;
			            $mail->Debugoutput = 'html';
			            $mail->Host = Config::get('email.defaults.smtp.host');
			            $mail->Port = Config::get('email.defaults.smtp.port');
			            $mail->SMTPAuth = true;
			            $mail->Username = Config::get('email.defaults.smtp.username');
			            $mail->Password = Config::get('email.defaults.smtp.password');
			            $mail->CharSet = 'UTF-8';

			            $from = Config::get('email.defaults.from');

			            $mail->setFrom($from['email'], $from['name']);            
			            $mail->addReplyTo($from['email'], $from['name']);

			            $mail->addAddress($usrEmail, $usrNome);

			            $mail->Subject = 'Prodac - Acesso ao admin';
            			$mail->msgHTML(View::forge('email/novo-usuario', $emailData));

						$mail->send();
						$arr['status'] = 'ok';
						$arr['info'] = $id;

						Session::set_flash('msgFeedback', 'Usuário cadastrado com sucesso.');

					} else {
						$arr['info'] = 'error-create';
					}
				} else {
					$arr['info'] = $val->error();
				}

			} catch(\Exception $e){
				$arr['info'] = $e->getMessage();
			}
		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_edit($id){
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax() && (integer) $id > 0){

			try {
				$usrNome = Input::post('nome');
				$usrSenha = Input::post('senha');
				
				if($user = Model_Usuario::find_by_id((integer) $id)){
					$user->name = $usrNome;
					$user->save();

					$val = array(
						'name' => $usrNome
					);

					if(!empty($usrSenha)){
						$val['password'] = $usrSenha;
						$val['old_password'] = Auth::reset_password($user->username);
					}

					if(Auth::update_user($val, $user->username)){
						$arr['status'] = 'ok';
						$arr['info'] = 'ok';

						Session::set_flash('msgFeedback', 'Usuário editado com sucesso.');
					} else {
						$arr['info'] = 'error-user';
					}
				} else {
					$arr['info'] = 'invalid-user';
				}

			} catch(\Exception $e){
				$arr['info'] = $e->getMessage();
			}
		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_delete($id)
	{
		$arr = array('status' => 'ok', 'cadastrado' => '0', 'token' => Security::fetch_token());

		if(Input::is_ajax() && (integer) $id > 0){

			try {
				if($user = Model_Usuario::find_by_id($id)){
					Auth::delete_user($user->username);
					$arr['status'] = 'ok';
					$arr['info'] = 'ok';
				} else {
					$arr['info'] = 'invalid-user';
				}

			} catch(\Exception $e){
				$arr['info'] = $e->getMessage();
			}
		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_meus_dados()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){
			try {
				$nome = Input::post('nome', null);
				$senha = Input::post('senhaAtual', null);
				$novaSenha = Input::post('novaSenha', null);
				$confirmNovaSenha = Input::post('novaSenhaConfirm', null);

				if(empty($nome)){
					throw new Exception('dados-nome');
				}

				$arrAuth = array('name' => $nome);
				
				if(Auth::member(50) || Auth::member(10)){
					$arrAuth['nome_contato'] = Input::post('nome_contato', '');
				}

				if(!empty($senha) && !empty($novaSenha) && !empty($confirmNovaSenha)){
					if(!Auth::validate_user(Auth::get('email'), $senha)){
						throw new Exception('senha-invalida');
					}

					if($novaSenha != $confirmNovaSenha || strlen($novaSenha) < 5){
						throw new Exception('senha-confirm');
					}

					$arrAuth['password'] = $novaSenha;
					$arrAuth['old_password'] = $senha;
				}

				Auth::update_user($arrAuth);

				$arr['status'] = 'ok';

			} catch(\Exception $e){
				$arr['info'] = $e->getMessage();
				logger(\Fuel::L_ERROR, '*** Error - Meus Dados - Usuário - ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());
			}
		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function action_index()
	{
		$configPag = Config::load('config_pagination');
		$configPag['total_items'] = Model_Usuario::count();
		$pagination = Pagination::forge('pagination', $configPag);

		$this->pageData['title'] = 'Usuários - ' . $this->pageData['title'];
		$this->pageData['activeUsuarios'] = true;
		$this->pageData['itens'] = Model_Usuario::find('all', array(
			'order_by' => array('name' => 'desc'),
			'limit' => $pagination->per_page,
			'offset' => $pagination->offset
		));
		$this->pageData['pagination'] = $pagination;

		return $this->forgeViews('usuario/index');
	}

	public function action_alterar_senha()
	{
		$this->pageData['title'] = 'Alterar Senha - ' . $this->pageData['title'];
		$this->pageData['activeSenha'] = true;
		$this->pageData['resetPasswd'] = Session::get('resetPasswd', false);
		$this->pageData['menu'] = array('meus-dados' => 'active');
		
		$cadastro = Input::get('cadastro', false);
		
		if($cadastro){
			$this->pageData['tltHeader'] = 'Cadastro de senha';
			$this->pageData['classTltHeader'] = 'areaMeusDados';
			$this->pageData['descHeader'] = 'Cadastre uma senha para acessar o sistema';
		} else {
			$this->pageData['tltHeader'] = 'Alterar senha';
			$this->pageData['classTltHeader'] = 'areaMeusDados';
			$this->pageData['descHeader'] = 'Cadastre uma nova senha para acessar o sistema';
		}

		return $this->forgeViews('usuario/alterar_senha');
	}

	public function action_cadastrar()
	{
		$this->pageData['title'] = 'Novo Usuário - ' . $this->pageData['title'];
		$this->pageData['activeUsuarios'] = true;
		$this->pageData['formCreate'] = true;
		$this->pageData['item'] = false;

		return $this->forgeViews('usuario/cadastrar');
	}

	public function action_edit($id)
	{
		$this->pageData['title'] = 'Editar Usuário - ' . $this->pageData['title'];
		$this->pageData['activeUsuarios'] = true;
		$this->pageData['formCreate'] = false;
		$this->pageData['item'] = Model_Usuario::find_by_id((integer) $id);

		return $this->forgeViews('usuario/editar');
	}

	public function action_meus_dados()
	{
		$this->pageData['title'] = 'Meus dados - ' . $this->pageData['title'];
		$this->pageData['tltHeader'] = 'Meus Dados';
		$this->pageData['classTltHeader'] = 'areaMeusDados';
		$this->pageData['descHeader'] = 'Edição dos dados de cadastro';
		$this->pageData['menu'] = array('meus-dados' => 'active');

		return View::forge('template', $this->forgeViews('usuario/meus_dados', $this->pageData));
	}
}