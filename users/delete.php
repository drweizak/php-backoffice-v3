<?php
session_start();
if($_SESSION['level'] == 1 && $_GET['id'] != $_SESSION['user_id']){
	
	$id_user=$_GET['id'];
	try{
		require_once("../controller/users.php");
		
		$users = new users();
		$users->delete($id_user);
		$_SESSION['msg'] = 'The account was deleted with success!';
		$_SESSION['msg_type'] = 'success';
		header('location: ../users/');
	}

	catch(Exception $e){
		$_SESSION['msg'] = "An error occorred! Please, try again.";
		$_SESSION['msg_type'] = 'danger';
		header('location: ../users/view?id='.$_GET['id']);
	}
}
else{
	$_SESSION['msg'] = "You don't have permission to do this operation.";
	$_SESSION['msg_type'] = 'danger';
	header('location: ../users/');
}
?>