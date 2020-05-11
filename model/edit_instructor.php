<?php
require_once('../model/validate.php');
$validate = new validate();
$errors = NULL;

if($_POST['name']!=$instructor['name']){
	$name = $validate->limparCampos($_POST['name']);
		
	if (!$validate -> verTexto($name) && !$validate -> verTamanho($name, 3, 50)){
		$errors['name'] = 'Invalid name!';
	}
}
else{
	$name = $instructor['name'];
}

if($_POST['short_description']!=$instructor['short_description']){
	$short_description = $validate->limparCampos($_POST['short_description']);
	if (!$validate -> verTexto($short_description) && !$validate -> verTamanho($short_description, 3, 100)){
		$errors['short_description'] = 'Invalid Information!';
	}
}

else{
	$short_description = $instructor['short_description'];
}

if(isset($_POST['long_description1'])){
	
	$long_description1 = $_POST['long_description1'];
	$long_description2 = $_POST['long_description2'];
	
	if(!empty($long_description1)){
		$long_description1 = str_replace('<div>', '<br/>', $long_description1);
		$long_description1 = str_replace('</div>', '', $long_description1);
		$long_description1 = $validate->naoEscapar($long_description1);
	}
	if(!empty($long_description2)){
		$long_description2 = str_replace('<div>', '<br/>', $long_description2);
		$long_description2 = str_replace('</div>', '', $long_description2);
		$long_description2 = $validate->naoEscapar($long_description2);
	}
	
	if($long_description1 != $instructor['long_description1'] || !empty($long_description1)){
		if (!$validate -> verTamanho ($long_description1, 3)){
		$errors['long_description1']= "Invalid text!";
		}
		if (!$validate -> verTexto ($long_description1)){
		$errors['long_description']= "Invalid text!";
		}
	}
	else{
		$long_description1 = $instructor['long_description1'];
	}
	
	if($long_description2 != $instructor['long_description2'] || !empty($long_description2)){
		if (!$validate -> verTamanho ($long_description2, 3)){
		$errors['long_description2']= "Invalid text!";
		}
		if (!$validate -> verTexto ($long_description2)){
		$errors['long_description2']= "Invalid text!";
		}
	}
	else{
		$long_description2 = $instructor['long_description2'];
	}
}
else{
	$long_description1 = NULL;
	$long_description2 = NULL;
}

?>