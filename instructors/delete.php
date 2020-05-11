<?php
session_start();
if(isset($_GET)){
	$instructor_id=$_GET['id'];
	try{
		require_once("../controller/instructors.php");
		
		$instructors = new instructors();
		$instructors->delete($instructor_id);
		$_SESSION['msg'] = 'The Instructor was deleted with success!';
		$_SESSION['msg_type'] = 'success';
		header('location: ../instructors/');
	}

	catch(Exception $e){
		$_SESSION['msg'] = "An error occorred! Please, try again.";
		$_SESSION['msg_type'] = 'danger';
		header('location: ../instructors/view?id='.$_GET['id']);
	}
}
else{
	$_SESSION['msg'] = "You don't have permission to do this operation.";
	$_SESSION['msg_type'] = 'danger';
	header('location: ../instructors/');
}
?>