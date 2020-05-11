<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_GET['id'])){
	
	$post_id=$_GET['id'];
	try{
		
		require_once("../controller/posts.php");
		$posts = new posts();
		$content_result = $posts->view_content('WHERE post_id='.$post_id, '','');
		if($content_result->num_rows>0){
			while($content = $content_result->fetch_array()){
				$posts->delete_content('WHERE post_id ='.$content['post_id'], $content['path']);
			}
		}
		
		$posts->delete('WHERE post_id='.$post_id);
		$_SESSION['msg'] = "The Post and all it's content was deleted Successfully!";
		$_SESSION['msg_type'] = 'success';
		header('location: ../news');
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