<?php
class Controller_Auth extends Controller_Admin_Base
{
	public function post_login()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		Auth::dont_remember_me();
		Auth::logout();

		if(Input::is_ajax()){

			try{
				if(Auth::login(Input::post('email', ''), Input::post('password', ''))){
	                
                    if(Input::post('remember', false)){
                        Auth::remember_me();
                    } else {
                        Auth::dont_remember_me();
                    }
    
                    $arr['status'] = 'ok';
                    $arr['info'] = 'logged';
	                
				} else {
					$arr['info'] = 'invalid-user';
				}
			} catch(Exception $e){
				$arr['info'] = $e->getMessage();
			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function post_senha()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());

		if(Input::is_ajax()){

			if($email = Input::post('email', false)){
				if($user = Model_Usuario::find_by_email($email)){
					$cad = Input::post(Crypt::encode('cadastro'), false);
                   
                    $hash = str_replace('/', '-', Auth::instance()->hash_password(Str::random()).$user->id);

                    $user->lostpassword_hash = $hash;
                    $user->lostpassword_created = time();
                    $user->lostpassword_type = $cad ? 'cadastro' : 'reset';
                    $user->save();

                    $emailData = array('userName' => $user->name, 'urlReset' => Uri::create('admin/login/senha/' . $hash), 'baseUrl' => Uri::base());

                    if($cad){
                        $titulo = '[PRODAC] Novo cadastro';
                        $view = 'cadastro-senha';
                    } else {
                        $titulo = '[PRODAC] Recuperar senha';
                        $view = 'reset-senha';
                    }

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

		            $mail->addAddress($user->email, $user->name);

		            $mail->Subject = $titulo;
        			$mail->msgHTML(View::forge('email/' . $view, $emailData));

                    /*Package::load('email');
                    $email = Email::forge();
                    $email->html_body(View::forge('email/' . $view, $emailData));
                    $email->subject($titulo);

                    $from = Config::get('email.defaults.from');
                    $email->from($from['email'], $from['name']);
                    $email->to($user->email, $user->name);*/

                    try{
                        $mail->send();
                        $arr['status'] = 'ok';
                        $arr['info'] = $user->email;
                    }
                    catch(\EmailValidationFailedException $e){
                        $arr['info'] = 'invalid-email';
                    }
                    catch(\Exception $e){
                        logger(\Fuel::L_ERROR, '*** Error sending email ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());
                        $arr['info'] = 'error-sending-email';
                    }
                    
				} else {
					$arr['info'] = 'invalid-email';
				}

			}

		}

		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	public function action_login()
	{
		//Auth::create_user('andreforweb@gmail.com', '123#trocar', 'andreforweb@gmail.com', 100, array('name' => 'André Santos'));
		//Auth::create_user('thallesfreitas@yahoo.com.br', 'teste', 'thallesfreitas@yahoo.com.br', 100, array('name' => 'Thalles Freitas'));

		$this->pageData['title'] = 'Login | ' . $this->pageData['title'];
		return $this->forgeViews('home/login', 'admin_login');
	}

	public function action_logout()
	{
		Auth::dont_remember_me();
		Auth::logout();

		return Response::redirect('admin/login');
	}

	public function action_senha($hash = null)
	{
		if($hash !== null){
			$user = substr($hash, 44);

			if($user = Model_Usuario::find_by_id($user)){
				$time = $user->lostpassword_type == 'cadastro' ? 324000 : 86400;

				if(isset($user->lostpassword_hash) and $user->lostpassword_hash == $hash and time() - $user->lostpassword_created < $time){
					$user->lostpassword_hash = null;
					$user->lostpassword_created = null;
					$user->lostpassword_type = null;
					$user->save();

					if(Auth::force_login($user->id)){
						Session::set('resetPasswd', $user->id);
                        $cadastro = Input::get('cadastro', false);
						Response::redirect('admin/alterar-senha' . ($cadastro ? '?cadastro=1' : ''));
					}
				}
			}
		}

		Response::redirect('admin/login');
	}
}