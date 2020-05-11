<?php
require_once('../model/validate.php');
$validate = new validate();
$errors = NULL;

if($_POST['email']!=$user['email']){
	$email = $validate->limparCampos($_POST['email']);
	if (!$validate -> existEmail ($email)){
		$errors['email'] = 'Email already in use!';
	}
}
else{
	$email = $user['email'];
}

if($_POST['name']!=$user['name']){
	$name = $validate->limparCampos($_POST['name']);
	$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
	
	if (!$validate -> verTexto($name) && !$validate -> verTamanho($name, 3, 50)){
		$errors['name'] = 'Invalid name!';
	}
}
else{
	$name = $user['name'];
}?>