<?php
class Controller_Admin_Base extends Controller
{
	protected $pageData;

	public function before()
	{
		$this->pageData = array(
			'title' => 'PRODAC',
            'description' => 'Admin - PRODAC',
            'keywords' => '',
            'baseUrl' => Uri::base(),
            'urlRedirect' => Session::get_flash('urlRedirect', false),
            'msgFeedback' => Session::get_flash('msgFeedback', false),
            'idFeedback' => Session::get_flash('idFeedback', false),
            'activeMenu' => array(),
            'bodyClass' => Input::get('_c', '')
		);

		Asset::remove_path('assets/css/', 'css');
		Asset::remove_path('assets/js/', 'js');
		Asset::remove_path('assets/img/', 'img');

		Asset::add_path('assets/_admin/css/', 'css');
		Asset::add_path('assets/_admin/js/', 'js');
		Asset::add_path('assets/_admin/img/', 'img');

		Asset::css(array('jquery-ui-1.10.3.custom.min.css', 'bootstrap.min.css', 'jquery.fancybox.css', 'style.admin.css'), array(), 'css');
		Asset::js(array('require.js'), array('data-main' => Uri::base() . 'assets/_admin/js/rules.admin.js?_' . time()), 'js');

		$uri = Uri::segments();

		if(!isset($uri[1]) || (isset($uri[1]) && $uri[1] != 'login')){
			if(!Auth::check() && !Input::is_ajax()){
				Session::set_flash('urlRedirect', Uri::current());
                Response::redirect('admin/login');
          	}
			if(Session::get('resetPasswd', false) && (!isset($uri[1]) || (isset($uri[1]) && $uri[1] != 'alterar-senha'))){
				Response::redirect('admin/alterar-senha');
			}
		}
	}

	public function after($response)
	{
        $uri = Uri::segments();
        if((!isset($uri[1]) || (isset($uri[1]) && $uri[1] != 'login')) && !Auth::check() && Input::is_ajax()){
            $arr = array('status' => 'error', 'info' => 'login', 'token' => Security::fetch_token());
            return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
        }
        
		return Response::forge($response, 200, array(
			'Cache-Control' => 'no-cache, max-age=0, must-revalidate',
			'Expires' => 'Mon, 01 Jul 1988 05:00:00 GMT',
			'Pragma' => 'no-cache'
		));
	}

	protected function forgeViews($content, $tpl = 'admin')
	{
		$tpl = 'admin/_template/' . $tpl;
		$content = 'admin/' . $content;

		$this->pageData['head'] = View::forge('admin/_include/head', $this->pageData);
		$this->pageData['pageHeader'] = View::forge('admin/_include/page-header', $this->pageData);
		$this->pageData['boxFeedback'] = View::forge('admin/_include/box-feedback', $this->pageData);
		$this->pageData['menu'] = View::forge('admin/_include/menu', $this->pageData);
		$this->pageData['footer'] = View::forge('admin/_include/footer', $this->pageData);
		$this->pageData['content'] = View::forge($content, $this->pageData);

		return View::forge($tpl, $this->pageData);
	}
}