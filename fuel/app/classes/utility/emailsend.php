<?php
class Utility_Emailsend
{
	public static function format_item(array $fields, $item)
	{
		$arr = array(
    		array(
    			'titulo' => 'ID',
    			'valor' => $item->id
    		),
    		array(
    			'titulo' => 'Cadastrado em',
    			'valor' => date('d/m/Y - H:i', $item->created_at)
    		)
    	);

    	foreach($fields as $key=>$prop){
			if(is_array($prop) && isset($prop['tlt_email'])){
                $itemArr = &$arr[];

                $itemArr = array(
                    'titulo' => $prop['tlt_email'],
                    'valor' => !empty($item->$key) ? $item->$key : '(não informado)'
                );

                if($key == 'receber_newsletter'){
                    $itemArr['valor'] = !empty($item->$key) ? 'Sim' : 'Não';
                }
				
			}
    	}

    	return $arr;
	}

	public static function send_formularios($item, $tipo, $tipoConf, array $emailCC = array())
	{
        try {

    		$emailData = array(
    			'baseUrl' => Uri::base(),
    			'tipoForm' => $tipo,
    			'inputForm' => $item
    		);

            $titulo = '[PRODAC] Novo cadastro pelo formulário de ' . $tipo;
            $view = 'formularios-site';

            require(PKGPATH . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'PHPMailerAutoload.php');

            Config::load('email', 'email');
            Config::load('config_email', 'email_dest');

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

            if($tipo != 'contato'){
                $dest = Config::get('email_dest.' . $tipoConf);
            } else {
                $emailContato = Model_Institucional::get_item('contato');
                $emailContato = $emailContato->fields['email_to'];

                $dest['to'] = array_shift($emailContato);

                $nameTo = explode('@', $dest['to']);
                $nameTo = $nameTo[0];

                $dest['to'] = array(
                    'name' => $nameTo,
                    'email' => $dest['to']
                );
                
                if(!empty($emailContato)){
                    $emailCC = array();
                    foreach($emailContato as $itemSend){
                        if(empty($itemSend)) continue;

                        $nameTo = explode('@', $itemSend);
                        $nameTo = $nameTo[0];

                        $emailCC[$itemSend] = $nameTo;
                    }
                }
            }

            if(!isset($dest['to']) || (isset($dest['to']) && empty($dest['to']))){
                throw new Exception('destinatario-email');
            }

            if(!isset($dest['cc']) || (isset($dest['cc']) && !is_array($dest['cc']))){
                $dest['cc'] = array();
            }

            if(!empty($emailCC)){
                foreach($emailCC as $keyE=>$itemE){
                    $dest['cc'][$keyE] = $itemE;
                }
            }

            $mail->addAddress($dest['to']['email'], $dest['to']['name']);

            if(!empty($dest['cc'])){
                foreach($dest['cc'] as $keyE=>$valE){
                    $mail->addCC($keyE, $valE);
                }
            }

            if(isset($dest['bcc']) && is_array($dest['bcc']) && !empty($dest['bcc'])){
                foreach($dest['bcc'] as $keyE=>$valE){
                    $mail->addBCC($keyE, $valE);
                }
            }            

            $mail->Subject = $titulo;
            $mail->msgHTML(View::forge('email/' . $view, $emailData));

            return $mail->send();

        } catch(Exception $e){
            echo $e->getMessage();
        }
	}

}