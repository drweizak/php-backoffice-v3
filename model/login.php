<?php
$page = NULL;
require_once('model/validate.php');
$email = $_POST['email'];
$password = $_POST['password'];

$errors = NULL;

$validate = new validate();

$email = $validate->limparCampos($email);
$password = $validate->limparCampos($password);

$email = $validate->limparCampos($email);
$password = $validate->limparCampos($password);
?>