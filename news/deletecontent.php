<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_GET['id'])){
	
	$content_id=$_GET['id'];
	require_once("../controller/posts.php");
	
	$posts = new posts();
	$content_result = $posts->view_content('WHERE content_id='.$content_id, '','');
	$content = $content_result->fetch_array();
	
	$posts->delete_content('WHERE content_id ='.$content_id, $content['path']);
	
	$_SESSION['msg'] = "The Content was deleted Successfully!";
	$_SESSION['msg_type'] = 'success';
	header('location: '.$_SERVER['HTTP_REFERER']);

}
else{
	$_SESSION['msg'] = "You don't have permission to access this page!";
	$_SESSION['msg_type'] = 'danger';
	header('location: '.$_SERVER['HTTP_REFERER']);
}
?>