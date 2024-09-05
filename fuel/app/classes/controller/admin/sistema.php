<?php
class Controller_Admin_Sistema extends Controller_Admin_Base
{
	public function action_index()
	{
		//Utility_Planilha::get_tab(DOCROOT . '_teste' . DIRECTORY_SEPARATOR . 'Estudo_4718.xlsx');
		Utility_Planilha::get_word(DOCROOT . '_teste' . DIRECTORY_SEPARATOR . 'E-4769-001-14.doc');
	}
}