<?php
session_start();
$page = NULL;
$page = basename($_SERVER['PHP_SELF'], ".php");
if(!isset($_SESSION["user_id"])){
	$_SESSION['msg'] = "You don't have permissions to access this page!";
	if($page == 'dashboard'){
		header('location: ../acp/');
	}else{
		header('location: ../../acp/');
	}
	
}
else{
	
	if($page == 'dashboard'){
		require_once('controller/users.php');
	}
	else{
		require_once('../controller/users.php');
	}
	$users = new users();
	$user_result = $users->view('WHERE user_id='.$_SESSION['user_id'],'','');
	$user = $user_result->fetch_array();
}
?>