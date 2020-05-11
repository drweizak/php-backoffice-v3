<?php require_once('../blocks/restrict.php');
if(!isset($_GET['t']) && $_GET['t'] != 0  || !isset($_GET['t']) && $_GET['t'] != 1 || !isset($_GET['t']) && $_GET['t'] != 2 ){
	$_SESSION['msg'] = "You don't have permission to do this operation.";
	$_SESSION['msg_type'] = "danger";
	header('location: ./');
	die();
}
if(isset($_POST['form']) && $_POST['form']=='add'){
	
	require_once('../controller/posts.php');
	$posts = new posts();
	
	require_once('../model/add_post.php');	
	if(!$errors){
		try{
			$date = date('Y-m-d');
			$posts->add($title, $description, $date);
			$post_result = $posts->view('', 'ORDER BY post_id DESC', 'LIMIT 1');
			$post = $post_result->fetch_array();
			
			if($_POST['type']==0){
				$image = $posts->upload($_FILES['path'], $post['post_id']);
			}
			if($_POST['type']==1){
				$posts->add_content($_POST['type'], $path, $post['post_id']);
			}
			
			$_SESSION['msg'] = 'Post was created with success!';
			$_SESSION['msg_type'] = 'success';
			header('location: ./');
			die();
		}
		catch(Exception $e){
			$_SESSION['msg'] = 'An error occurred! Please, try again.';
			$_SESSION['msg_type'] = 'danger';
			
			header('location: ./');
			die();
		}
	}
}
?>
<?php require_once('../blocks/head.php'); ?>
<body>
    <div id="wrapper" class="col-md-12">
		<div>
       		<?php require_once('../blocks/menu.php');?>
            <div id="page-wrapper">
				<div class="container-fluid">
                	<div class="row">
						<?php require_once('../blocks/msg.php');?>´
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                New Post <small><?php if($_GET['t']==0){echo'Add Gallery';}else{echo'Add Video';}?></small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-newspaper-o"></i> <a href="../news">News</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-newspaper-o"></i> Add New Post
                                </li>
                            </ol>
                        </div>
					</div>
                   	<div class="row">
                    	<form action="" method="post" role="form" enctype="multipart/form-data">
                        		<input type="hidden" name="form" value="add"/>
                                <input type="hidden" name="type" value="<?=$_GET['t'];?>"/>
                    			<div class="col-md-6 col-xs-12">
                                <div class="form-group<?php if(isset($errors['title']) && !empty($errors['title'])){ echo' has-error';}?>">
                                	<small>Title</small>
                                    <input name="title" type="text" class="form-control" placeholder="Title" required <?php if(isset($errors)){echo 'value="'.$_POST['title'].'"';}?>>
                                    <?php if(isset($errors['title']) && !empty($errors['title'])){ echo'<label class="control-label">'.$errors['title'].'</label>';}?>
                                </div>
                                	<?php if($_GET['t']==0){ ?>
                                    <div class="form-group">
                                        <small>Image(s)</small>
                                        <input name="path[]" id="file-0a" class="file <?php if(isset($errors['path']) && !empty($errors['path'])){ echo' has-error';}?>" type="file" multiple data-min-file-count="1">
                                        <?php if(isset($errors['path']) && !empty($errors['path'])){ echo'<label class="control-label">'.$errors['path'].'</label>';}?>
                                    </div>
									<?php }if($_GET['t']==1){?>
									<div class="form-group<?php if(isset($errors['path']) && !empty($errors['path'])){ echo' has-error';}?>">
                                	<small>Video URL</small>
                                    <input name="path" type="text" class="form-control" placeholder="Video URL" required <?php if(isset($errors)){echo 'value="'.$_POST['path'].'"';}?>>
                                    <?php if(isset($errors['path']) && !empty($errors['path'])){ echo'<label class="control-label">'.$errors['path'].'</label>';}?>
                                	</div>	
									<?php }?>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                	<div class="form-group<?php if(isset($errors['description']) && !empty($errors['description'])){ echo' has-error';}?>">
                                	<small>Description</small>
                                    <textarea class="classy-editor form-control" name="description" required><?php if(isset($errors)){echo $_POST['description'];}?></textarea>
                                    <?php if(isset($errors['description']) && !empty($errors['description'])){ echo'<label class="control-label">'.$errors['description'].'</label>';}?>
                                </div>
                                <script>
									$(document).ready(function() {
										$(".classy-editor").ClassyEdit();
									});
								</script>
                                </div>
                                
                                <div class="col-md-12">
                                	<input class="btn pull-right btn-primary" type="submit" value="Add Post"/>
                                </div>
							</form>
						</div>
                	</div>
            	</div>
			</div>
		</div>
	</div>
</body>
</html>