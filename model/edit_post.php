<?php
require_once('../model/validate.php');
$validate = new validate();
$errors = NULL;

if($_POST['title']!=$work['title']){
	$title = $validate->limparCampos($_POST['title']);
	if (!$validate -> verTexto($title) && !$validate -> verTamanho($title, 3, 100)){
		$errors['title'] = 'Invalid Title!';
	}
}
else{
	$title = $work['title'];
}

$description = $_POST['description'];

if(!empty($description)){
	$description = str_replace('<div>', '<br/>', $description);
	$description = str_replace('</div>', '', $description);
}

if(!empty($description)){
	$description = $validate->naoEscapar($description);
}

if($description != $work['description'] || !empty($description)){
	if (!$validate -> verTamanho ($description, 3)){
	$errors['description']= "Invalid text!";
	}
	if (!$validate -> verTexto ($description)){
	$errors['description']= "Invalid text!";
	}
}
else{
	$description = $work['description'];
}

?>