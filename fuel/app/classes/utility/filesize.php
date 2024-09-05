<?php
class Utility_Filesize
{
	public static function getImageInfos($img)
	{
		if(!file_exists($img) || (file_exists($img) && is_dir($img))){
			return array();
		}
		
		$imgSize = getimagesize($img);	

		$imgArr = explode(DIRECTORY_SEPARATOR, $img);

		$arr = array();
		
		if(!$imgSize){
			$arr['nome'] = array_pop($imgArr);
			$arr['formato'] = mime_content_type($img);
			$arr['peso'] = Utility_Filesize::bytesToSize(filesize($img), 1);
			$ext = explode('.', $arr['nome']);
		} else {
			$arr['img'] = array_pop($imgArr);
			$arr['tamanho'] = $imgSize[0] .  'x' . $imgSize['1'] . 'px';
			$arr['formato'] = $imgSize['mime'];
			$arr['peso'] = Utility_Filesize::bytesToSize(filesize($img), 1);
			$ext = explode('.', $arr['img']);
		}
		$arr['extensao'] = array_pop($ext);

		return $arr;
	}
	
	public static function bytesToSize($bytes, $precision = 2)
	{
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;
        $terabyte = $gigabyte * 1024;
       
        if (($bytes >= 0) && ($bytes < $kilobyte)) {
            return $bytes . 'b';
     
        } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
            return round($bytes / $kilobyte, $precision) . 'kb';
     
        } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
            return round($bytes / $megabyte, $precision) . 'mb';
     
        } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
            return round($bytes / $gigabyte, $precision) . 'gb';
     
        } elseif ($bytes >= $terabyte) {
            return round($bytes / $terabyte, $precision) . 'tb';
        } else {
            return $bytes . 'b';
        }
    }
}