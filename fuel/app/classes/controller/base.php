<?php
class Controller_Base extends Controller
{
	protected $pageData;

	public function before()
	{
		$home = Model_Institucional::get_item('home');
		$contato = Model_Institucional::get_item('contato');
		
		$this->pageData = array(
			'title' => $home->titulo_page,
            'description' => $home->descricao_page,
            'keywords' => $home->keywords,
            'baseUrl' => Uri::base(),
            'm' => array(),
            'bodyClass' => 'home',
            'home' => $home,
            'contato' => $contato
		);

	}

	protected function forgeViews($content, $tpl = 'site')
	{
		$tpl = 'site/_template/' . $tpl;
		$content = 'site/' . $content;

		// error_log($contato->fields['mapa']);
		
		$this->pageData['header'] = View::forge('site/_include/header', $this->pageData);
		$this->pageData['vitrine'] = View::forge('site/_include/vitrine', $this->pageData);
		$this->pageData['galeria'] = View::forge('site/_include/galeria', $this->pageData);
		$this->pageData['calendario'] = View::forge('site/_include/calendario', $this->pageData);
		$this->pageData['footer'] = View::forge('site/_include/footer', $this->pageData);
		$this->pageData['content'] = View::forge($content, $this->pageData);
		$this->pageData['mapa'] = $this->pageData['contato']['mapa'];

		return View::forge($tpl, $this->pageData);
	}
}