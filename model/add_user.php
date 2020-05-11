<?php
require_once('../model/validate.php');
$validate = new validate();
$errors = NULL;

$email = $validate->limparCampos($_POST['email']);
if (!$validate -> existEmail ($email)){
	$errors['email'] = 'Email already in use!';
}

$password = $validate->limparCampos($_POST['password']);
if (!$validate -> verPassword($password)){
	$errors['password'] = 'Invalid password!';
}

$cpassword = $validate->limparCampos($_POST['cpassword']);
if (!$validate -> confPassword($password, $cpassword)){
	$errors['cpassword'] = 'Passwords does not match!';
}

$name = $validate->limparCampos($_POST['name']);
$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
if (!$validate -> verTexto($name) && !$validate -> verTamanho($name, 3, 50)){
	$errors['name'] = 'Invalid name!';
}
?>