<?php
require_once('../blocks/restrict.php');
require_once('../controller/posts.php');
$posts = new posts();

$post_result = $posts->view('WHERE post_id ='.$_GET['id'],'','');
$post = $post_result->fetch_array();

if(isset($_POST['form']) && $_POST['form']=='edit'){
	
	require_once('../model/edit_post.php');
	if(!$errors){
		try{
			$year = $_POST['year'];
			$posts -> edit($post['post_id'], $title, $description);
			
			$_SESSION['msg'] = "Post updated Successfully!";
			$_SESSION['msg_type'] = 'success';
		}
		
		catch(Exception $e){
			$_SESSION['msg'] = "An error occurred! Please, try again.";
			$_SESSION['msg_type'] = 'danger';
		}
		header('location: ../news/view?id='.$post['post_id']);
		die();
		
	}
} ?>
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
                                <?= $post['title'];?> <small>Edit Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-newspaper-o"></i> <a href="../news">Newss</a>
                                </li>
                                <li>
                                    <i class="fa fa-newspaper-o"></i> <a href="../news/view?id=<?= $post['post_id']?>"><?= $post['title'];?></a>
                                </li>
                                <li class="active">Edit Details</li>
                            </ol>
                        </div>
					</div>
                    <div class="row">
                    	<form action="" method="post" role="form" enctype="multipart/form-data">
							<input type="hidden" name="form" value="edit"/>
                    		<div class="col-md-6 col-xs-12">
                            	<div class="form-group<?php if(isset($errors['title']) && !empty($errors['title'])){ echo' has-error';}?>">
                                	<small>Title</small>
                                    <input name="title" type="text" class="form-control" placeholder="Title" required <?php if(isset($errors)){echo 'value="'.$_POST['title'].'"';}else{echo 'value="'.$post['title'].'"';}?>>
                                    <?php if(isset($errors['title']) && !empty($errors['title'])){ echo'<label class="control-label">'.$errors['title'].'</label>';}?>
                                </div>
                                
							</div>
                            <div class="col-md-6 col-xs-12">
                            	<div class="form-group<?php if(isset($errors['description']) && !empty($errors['description'])){ echo' has-error';}?>">
                                	<small>Description</small>
                                    <textarea class="classy-editor form-control" name="description" required><?php if(isset($errors)){echo $_POST['description'];}else{echo $post['description'];}?></textarea>
                                    <?php if(isset($errors['description']) && !empty($errors['description'])){ echo'<label class="control-label">'.$errors['description'].'</label>';}?>
                                </div>
                                <script>
									$(document).ready(function() {
										$(".classy-editor").ClassyEdit();
									});
								</script>
                            </div>
                            <div class="col-md-12">
                            	<input class="btn pull-right btn-primary" type="submit" value="Change Details"/>
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