<?php

class Controller_Admin_Upload extends Controller_Admin_Base
{
	protected $config;
	
	public function before()
	{
		$this->config = Config::load('upload', true);
	}
	
	public function post_img($w = null, $h = null)
	{
		$this->config['ext_whitelist'] = array('jpg', 'jpeg', 'gif', 'png', 'tiff');
		$this->config['path'] .= (DIRECTORY_SEPARATOR . 'img');
		$this->config['min_width'] = $w;
		$this->config['min_height'] = $h;
		return $this->fileUpload('img');
	}
	
	public function post_pdf()
	{
		$this->config['ext_whitelist'] = array('pdf');
		$this->config['path'] .= (DIRECTORY_SEPARATOR . 'pdf');
		return $this->fileUpload('pdf');
	}
	
	public function post_doc()
	{
		$this->config['ext_whitelist'] = array('doc', 'docx', 'rtf', 'odt');
		$this->config['path'] .= (DIRECTORY_SEPARATOR . 'doc');
		return $this->fileUpload('doc');
	}
	
	public function post_xls()
	{
		$this->config['ext_whitelist'] = array('xls', 'xlsx', 'xml', 'csv', 'ods');
		$this->config['path'] .= (DIRECTORY_SEPARATOR . 'xls');
		return $this->fileUpload('xls');
	}
	
	public function post_ppt()
	{
		$this->config['ext_whitelist'] = array('ppt', 'pptx', 'pps', 'ppsx', 'odp');
		$this->config['path'] .= (DIRECTORY_SEPARATOR . 'ppt');
		return $this->fileUpload('ppt');
	}
	
	public function post_file()
	{
		$this->config['ext_whitelist'] = array('pdf', 'ppt', 'pptx', 'pps', 'ppsx', 'odp', 'xls', 'xlsx', 'xml', 'csv', 'ods', 'doc', 'docx', 'rtf', 'odt', 'jpg', 'jpeg', 'gif', 'png', 'tiff');
		$this->config['path'] .= (DIRECTORY_SEPARATOR . 'file');
		return $this->fileUpload('file');
	}
	
	public function post_delete()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());
		
		if(Input::is_ajax()){
			$file = Input::post('file');
			$type = Input::post('type');
			$base = $this->config['path'] . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR;
			
			if(file_exists($base . $file)){
				unlink($base . $file);
			}
			
			if($type == 'img'){
				if(file_exists($base . 'thumb_' . $file)){
					unlink($base . 'thumb_' . $file);
				}
				if(file_exists($base . '100x100_' . $file)){
					unlink($base . '100x100_' . $file);
				}
				if(file_exists($base . '250x250_' . $file)){
					unlink($base . '250x250_' . $file);
				}
				if(file_exists($base . '153x120_' . $file)){
					unlink($base . '153x120_' . $file);
				}
			}
			
			if(file_exists($base . 'fbshare_' . $file)){
				unlink($base . 'fbshare_' . $file);
			}
			
			$arr['status'] = 'ok';
		}
		
		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}
	
	public function post_crop()
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());
		
		$x = Input::post('x', 0);
		$y = Input::post('y', 0);
		$x2 = Input::post('x2', 0);
		$y2 = Input::post('y2', 0);
		$w = Input::post('w', 0);
		$h = Input::post('h', 0);
		$ratio = Input::post('ratio', 0);
		$img = Input::post('img', 0);
		$w_base = Input::post('w_base', 0);
		$h_base = Input::post('h_base', 0);
		
		$pathImg = $this->config['path'] . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $img;
		$basePathImg = $this->config['path'] . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;

		Image::load($pathImg)
			->save($basePathImg . 'nocrop_' . $img);

		Image::load($pathImg)
			->crop(abs(round($x / $ratio)), abs(round($y / $ratio)), abs(round($x2 / $ratio)), abs(round($y2 / $ratio)))
			->resize($w_base, $h_base, false)
			->save($pathImg);

		Image::load($pathImg)
    			->crop_resize(160, 90)
    			->save($basePathImg . '160x90_' . $img);

		if($w_base > 250){
			
    		Image::load($pathImg)
    			->crop_resize(250, 250)
    			->save($basePathImg . '250x250_' . $img);
    		
    		Image::load($pathImg)
    			->crop_resize(161, 121)
    			->save($basePathImg . '161x121_' . $img);

    		Image::load($pathImg)
    			->crop_resize(153, 120)
    			->save($basePathImg . '153x120_' . $img);

    		$imgThumb = '160x90_' . $img;
    	}

    	$imgInfos = Utility_Filesize::getImageInfos($pathImg);
		$arr['img'] = isset($imgThumb) ? $imgThumb : $imgInfos['img'];
		$arr['tamanho'] = $imgInfos['tamanho'];
		$arr['formato'] = $imgInfos['formato'];
		$arr['peso'] = $imgInfos['peso'];
		$arr['status'] = 'ok';
		
		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'application/json'));
	}

	protected function fileUpload($type)
	{
		$arr = array('status' => 'error', 'info' => 'request', 'token' => Security::fetch_token());
		
		Upload::process($this->config);
		
		if(Upload::is_valid()){
			Upload::save();
			$fileInfos = Upload::get_files(0);
			
			$arr['status'] = 'ok';
			
			if($type == 'img'){
				$imgSize = getimagesize($fileInfos['saved_to'] . $fileInfos['saved_as']);

				$arr['img'] = $fileInfos['saved_as'];
				$arr['tamanho'] = $imgSize[0] .  'x' . $imgSize[1] . 'px';
				$arr['img_w'] = $imgSize[0];
				$arr['img_h'] = $imgSize[1];
				$arr['base_w'] = $this->config['min_width'];
				$arr['base_h'] = $this->config['min_height'];
				
				//Image::load($fileInfos['saved_to'] . $fileInfos['saved_as'])->resize(160, 90)->save_pa('thumb_');
				
			} else {
				$arr['nome'] = $fileInfos['saved_as'];
			}
			
			$arr['formato'] = $fileInfos['type'];
			$arr['peso'] = Utility_Filesize::bytesToSize($fileInfos['size'], 1);
			$arr['uploadType'] = $type;

			if($type == 'img' && $this->config['min_width'] && $this->config['min_height'] && ($imgSize[0] < $this->config['min_width'] || $imgSize[1] < $this->config['min_height'])){
				$arr['status'] = 'error';
				$arr['info'] = 'A imagem pecisa ter no mínimo ' . $this->config['min_width'] . 'x' . $this->config['min_height'] . 'px.';
			}

		} else {
			$arr['info'] = array();
			
			foreach (Upload::get_errors() as $file){
				$arr['info'][] = $file['errors'];
			}
		}
		
		return Response::forge(json_encode($arr), 200, array('Content-Type' => 'text/html'));
	}
}
