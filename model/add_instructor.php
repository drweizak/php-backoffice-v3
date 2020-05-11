<?php
require_once('../model/validate.php');
$validate = new validate();
$errors = NULL;

$name = $validate->limparCampos($_POST['name']);
	
if (!$validate -> verTexto($name) && !$validate -> verTamanho($name, 3, 50)){
	$errors['name'] = 'Invalid name!';
}

$short_description = $validate->limparCampos($_POST['short_description']);
if (!$validate -> verTexto($short_description) && !$validate -> verTamanho($short_description, 3, 100)){
	$errors['short_description'] = 'Invalid Information!';
}

?>