<?php
require_once('database.php');
class posts{
		
	public function view($condition, $order, $limit){
		
		$database = new database();
		$results = $database->requestQuery("SELECT * FROM posts $condition $order $limit");
				
		return ($results);
	}
	
	public function add($title, $description, $date){
				
		$database = new database();
		$query = "INSERT INTO posts VALUES('', '$title', '$description', '$date')";
		
		$result = $database ->requestQuery($query);
		
	}
	
	public function edit($post_id, $title, $description){
		
		$database = new database();
		$query = "UPDATE posts SET title='$title', description='$description' WHERE post_id = '$post_id'";
		
		$results = $database ->requestQuery($query);
		
	}
	
	public function delete($condition){
		
		$database = new database();
		$query = "DELETE FROM posts $condition";
		$results = $database->requestQuery($query);
			
	}
	
	public function view_content($condition, $order, $limit){
		
		$database = new database();
		$results = $database->requestQuery("SELECT * FROM content $condition $order $limit");
				
		return ($results);
	}
	
	public function add_content($type, $path, $post_id){
				
		$database = new database();
		$query = "INSERT INTO content VALUES('', '$type', '$path', '$post_id')";
		
		$result = $database ->requestQuery($query);
		
	}
	
	public function delete_content($condition, $image){
		
		$database = new database();
		$query = "DELETE FROM content $condition";
		$results = $database->requestQuery($query);
		if (file_exists('../../img/upload/news/'.$image)) {
			unlink('../../img/upload/news/'.$image);
		}
			
	}
	
	public function edit_content($content_id, $path){
		
		$database = new database();
		$query = "UPDATE content SET path='$path' WHERE content_id = '$content_id'";
		
		$results = $database ->requestQuery($query);
		
	}
	
	public function upload($images, $post_id){
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
				$this->add_content(0, $file_name, $post_id);

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
			$newwidth=700;
			$newheight=($height/$width)*$newwidth;
		}
		else{
			$newheight=470;
			$newwidth=($width/$height)*$newheight;
		}
		
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = "../../img/upload/news/". $filename;
	
		imagejpeg($tmp,$filename,100);
		
		imagedestroy($src);
		imagedestroy($tmp);
	}
}
?>