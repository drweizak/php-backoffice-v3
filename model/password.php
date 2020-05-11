<?php
require_once('../model/validate.php');
$validate = new validate();
$errors = NULL;

if($_POST['password']!=$user['password']){
	$password = $validate->limparCampos($_POST['password']);
	if (!$validate -> verPassword($password)){
		$errors['password'] = 'Invalid password!';
	}
	$cpassword = $validate->limparCampos($_POST['cpassword']);
	if (!$validate -> confPassword($password, $cpassword)){
		$errors['cpassword'] = 'Passwords does not match!';
	}
}
else{
	$password = $user['password'];
}

$password = md5($password);
?>