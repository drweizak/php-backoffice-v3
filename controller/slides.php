<?php
require_once('database.php');
class slides{
	
	public function view($condition, $order, $limit){
		
		$database = new database();
		$results = $database->requestQuery("SELECT * FROM slides $condition $order $limit");
		
		return ($results);
	}
	
	public function add($path){
				
		$database = new database();
		$query = "INSERT INTO slides VALUES('', '$path')";
		
		$result = $database ->requestQuery($query);
		
	}
	
	public function upload($images){
		$extension=array("jpeg","jpg","png","gif");
		foreach($images["tmp_name"] as $key=>$tmp_name)
		{
			$file_name=$images["name"][$key];
			$file_tmp=$images["tmp_name"][$key];

			$file_size=$images['size'][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);

			if(in_array($ext,$extension) && $file_size<=2000000 && $images['error'][$key] === UPLOAD_ERR_OK)
			{
				
				$temp = explode(".",$file_name);
				$utf8 = array(
					'á' => 'a',
					'à' => 'a',
					'ã' => 'a',
					'â' => 'a',
					'é' => 'e',
					'ê' => 'e',
					'í' => 'i',
					'ó' => 'o',
					'ô' => 'o',
					'õ' => 'o',
					'ú' => 'u',
					'ü' => 'u',
					'ç' => 'c',
					'Á' => 'A',
					'À' => 'A',
					'Ã' => 'A',
					'Â' => 'A',
					'É' => 'E',
					'Ê' => 'E',
					'Í' => 'I',
					'Ó' => 'O',
					'Ô' => 'O',
					'Õ' => 'O',
					'Ú' => 'U',
					'Ü' => 'U',
					'Ç' => 'C',
					'-' => '',
					'(' => '',
					')' => ''
				);
				$name = strtr($temp[0], $utf8);
				$name = preg_replace('/\s+/', '', $name);
				$name=trim($name);
				$name=strip_tags($name);
				$name=stripslashes($name);
				$name = strtolower($name);
				  
				$file_name = $name.time(). '.' .end($temp);
				
				$this->createthumbnail($file_name, $ext, $file_tmp);
				$this->add($file_name);

				$_SESSION['msg'][$key]['text']="The $file_name was uploaded with success!";
				$_SESSION['msg'][$key]['msg_type']="success";
			}
			else
			{
				$_SESSION['msg'][$key]="An error ocoured uploading $file_name.<br/>Max file size 2Mb & .jpeg .jpg .png .gif file extension allowed.";
				$_SESSION['msg'][$key]['msg_type']="danger";
			}
		}
		header('location: '.$_SERVER['HTTP_REFERER']);
	}
	public function createthumbnail($filename, $extension, $uploadedfile){
		
		$filename = stripslashes($filename);
		
		
		
		if($extension=="jpg" || $extension=="jpeg" )
		{
			$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($extension=="png")
		{
			
			$src = imagecreatefrompng($uploadedfile);
		}
		else 
		{
			$src = imagecreatefromgif($uploadedfile);
		}
		
		list($width,$height)=getimagesize($uploadedfile);
		
		if($width > $height){
			$newwidth=1900;
			$newheight=($height/$width)*$newwidth;
		}
		else{
			$newheight=400;
			$newwidth=($width/$height)*$newheight;
		}
		
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = "../../img/upload/slides/". $filename;
	
		imagejpeg($tmp,$filename,100);
		
		imagedestroy($src);
		imagedestroy($tmp);
	}

	public function delete($condition, $image){
		
		$database = new database();
		$query = "DELETE FROM slides $condition";
		$results = $database->requestQuery($query);
		if (file_exists('../../img/upload/slides/'.$image)) {
			unlink('../../img/upload/slides/'.$image);
		}
			
	}

}
?>