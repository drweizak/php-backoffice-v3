<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_GET['id'])){
	
	$slide_id=$_GET['id'];
	try{
		
		require_once("../controller/slides.php");
		$slides = new slides();
		
		$slide_result = $slides->view('WHERE slide_id='.$slide_id,'','');
		$slide = $slide_result->fetch_array();
		
		$slides->delete('WHERE slide_id='.$slide_id, $slide['path']);
		$_SESSION['msg'] = "The Slide and all it's content was deleted Successfully!";
		$_SESSION['msg_type'] = 'success';
		header('location: ../slides');
	}

	catch(Exception $e){
		$_SESSION['msg'] = "An error occurred! Please, try again.";
		$_SESSION['msg_type'] = 'danger';
		header('location: '.$_SERVER['HTTP_REFERER']);
	}
}
else{
	$_SESSION['msg'] = "You don't have permissions to access this page!";
	$_SESSION['msg_type'] = 'danger';
	header('location: '.$_SERVER['HTTP_REFERER']);
}
?>