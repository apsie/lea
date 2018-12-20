<?php
class download
{
	public $title = "document";
	
	
	public function get($filePath,$params)
	{
		if(file_exists($filePath))
		{
			// ini_set('output_buffering', 1); 
			// ini_set('default_charset', 'WINDOWS-1252');
			// ini_set('mbstring.internal_encoding', 'ISO-8859-1'); 
			
			header('Content-Description: File Transfer');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
	    	header('Cache-Control: must-revalidate');
	    	header('Pragma: public');
			// header('Content-Type: text/plain; charset=ISO-8859-1');
			// header('Content-Type: text/plain; charset=UTF-8');

			header('Content-type: application/msword; charset=WINDOWS-1252');
			header('Content-Disposition: inline, filename='.$this->title.'.doc');
			
			
			$fp = fopen($filePath, 'r');
			$output = fread($fp, filesize($filePath));
			
			// SPIREA - Création du fichier temporaire
			$temp_path = '/tmp/'.$this->title.'.doc';
			$temp_file = fopen($temp_path,'a');
			
			fclose($fp);
			
			foreach ($params as $id => $row):
				// $output = str_replace("<<".$id.">>", utf8_decode($row), $output);
				$output = str_replace("<<".$id.">>", $row, $output);
			endforeach;
		
			// SPIREA - Mise des infos dans le fichier temporaire
			fputs($temp_file, $output);
			readfile ($temp_path);

			// echo $output;
		}
		else
		{
			echo'Fichier inexistant...';
		}
		

 

	}
	
	public function setTitle($title)
	{
		// $this->title = utf8_encode($title);
		$this->title = $title;
	}



}
