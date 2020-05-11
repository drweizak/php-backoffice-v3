<?php
if($page == 'dashboard' || !isset($page) || $page == ''){
	require_once('controller/database.php');
}
else{
	require_once('../controller/database.php');
}

class validate{

	public function limparCampos($campo){
		$campo=trim($campo);
		$campo=strip_tags($campo);
		$campo=stripslashes($campo);
		return($campo);
	}
	
	public function naoEscapar($campo){
		$campo = mysql_escape_string($campo);

		return($campo);
	}
	
	public function removerEspacos($campo){
		$campo=str_replace(' ', '',$campo);
		return($campo);
	}
	
	public function verVazio($campo){
	
		if (empty($campo)){
			return (false);	
		}
		else {
			return (true);				
		}
	}
	
	public function verTamanho($campo,$min){
	
		if (strlen($campo)< $min){
			return (false);	
		}
		else {
			return (true);				
		}
	}

	public function verTexto ($campo){
		
		if(!is_numeric($campo)){
			return (true);
		}
		else{
			return (false);
		}
	}
	
	public function verNumero ($campo){
		
		if(is_numeric($campo)){
			return (true);
		}
		else{
			return (false);
		}
	}
	
	public function verPassword ($campo){
		if (preg_match('/[A-Za-z]/', $campo) || preg_match('/[0-9]/', $campo) ) {
			return (true);
		}
		else{
			return (false);
		}
	}
		
	public function confPassword ($campo, $confcampo){
	
		if ($campo == $confcampo){
			return (true);
		}
		else{
			return (false);
		}
	}
	
	public function verEmail ($campo){
		
		if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $campo)){
				return(false);
		}
		else{
			return(true);
		}
	}

	public function existEmail ($campo){
		
		$database = new database();
		
		$query = "SELECT * FROM users WHERE email='$campo'";
		$resultado = $database->requestQuery($query);
		
		if($resultado->num_rows!=0){
			return(false);
		}
		else{
			return(true);
		}
	}	
	
	public function verImagem ($imagem){
			
		if (!empty($imagem) && $imagem["error"] <= 0 && $imagem["size"] <= 1048576 && (($imagem["type"] == "image/gif") || ($imagem["type"] == "image/jpeg") || ($imagem["type"] == "image/jpg") || ($imagem["type"] == "image/png") || ($imagem["type"] == "image/pjpeg"))  ){
			return (true);
		}else{
			return (false);
		}
	}
}
?>