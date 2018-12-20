<?php
namespace Lea\PrestaBundle\Models;
class Download
{
	public $title = "document";
	
	public function get($filePath,$params){
		if(file_exists($filePath)){
			header('Content-type: application/msword');
			header('Content-Disposition: inline, filename='.$this->title.'.doc');
			$fp=fopen($filePath, 'r');
			$output=fread($fp, filesize($filePath));
			fclose($fp);
			
			foreach ($params as $id => $row):
				$output = str_replace("<<".$id.">>", utf8_decode($row), $output);
			endforeach;
		
			
			echo $output;
		}else{
			echo'Fichier '.$filePath.' inexistant...';
		}
	}
	
	public function setTitle($title)
	{
		$this->title = utf8_encode($title);
	}



}