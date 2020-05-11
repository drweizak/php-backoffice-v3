<?php
require_once('../blocks/restrict.php');
require_once('../controller/instructors.php');
$instructors = new instructors();

$instructors_result = $instructors->view('WHERE instructor_id ='.$_GET['id'],'','');
$instructor = $instructors_result->fetch_array();

if(isset($_POST['name'])){
	include('../model/edit_instructor.php');

	if(!$errors){
		try{
			$instructors->edit($_GET['id'], $name, $short_description, $long_description1, $long_description2);
						
			$_SESSION['msg'] = 'Instructor updated Successfully!';
			$_SESSION['msg_type'] = 'success';
		}
		catch(Exception $e){
			$_SESSION['msg'] = 'An error occurred! Please, try again.';
			$_SESSION['msg_type'] = 'danger';
		}
		echo '<script>window.location="instructors/view?id='.$_GET['id'].'"</script>';
		header('location: view?id='.$_GET['id']);
		die();
	}	
}?>
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
                                <?= $instructor['name'];?> <small>Edit Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> <a href="../instructors">Instructors</a>
                                </li>
                                <li>
                                    <i class="fa fa-user"></i> <a href="view?id=<?= $instructor['instructor_id']?>"><?= $instructor['name'];?></a>
                                </li>
                                <li class="active">Edit Details</li>
                            </ol>
                        </div>
					</div>
                    <div class="row">
                    	
                        	<form action="" method="post" role="form">
                            <div class="col-md-6">
                            	<input name="instructor_id" type="hidden" value="<?= $instructor['instructor_id'];?>" />
                            	<div class="form-group<?php if(isset($errors['name']) && !empty($errors['name'])){ echo' has-error';}?>">
                                	<small>Name</small>
                                    <input name="name" type="text" class="form-control" placeholder="Name" required <?php if(isset($errors)){echo 'value="'.$_POST['name'].'"';}else{echo 'value="'.$instructor['name'].'"';}?>>
                                    <?php if(isset($errors['name']) && !empty($errors['name'])){ echo'<label class="control-label">'.$errors['name'].'</label>';}?>
                                </div>
                                
                                
                                <div class="form-group<?php if(isset($errors['short_description']) && !empty($errors['short_description'])){ echo' has-error';}?>">
                                	<smalçl>Short Description</small>
                                    <textarea name="short_description" class="classy-editor form-control" required>
                                    	<?php if(isset($errors)){echo $_POST['short_description'];}else{echo $instructor['short_description'];}?>
                                    </textarea>
                                    <?php if(isset($errors['short_description']) && !empty($errors['short_description'])){ echo'<label class="control-label">'.$errors['short_description'].'</label>';}?>
                                </div>
                                
							</div>
                            <div class="col-md-6">
                            <?php if($instructor['head_instructor']==1){?>
                            	<div class="form-group<?php if(isset($errors['long_description1']) && !empty($errors['long_description1'])){ echo' has-error';}?>">
                                	<smalçl>Long Description</small>
                                    <textarea name="long_description1" class="classy-editor2 form-control" required>
                                    	<?php if(isset($errors)){echo $_POST['long_description1'];}else{echo $instructor['long_description1'];}?>
                                    </textarea>
                                    <?php if(isset($errors['long_description1']) && !empty($errors['long_description1'])){ echo'<label class="control-label">'.$errors['long_description1'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['long_description2']) && !empty($errors['long_description2'])){ echo' has-error';}?>">
                                    <textarea name="long_description2" class="classy-editor3 form-control" required>
                                    	<?php if(isset($errors)){echo $_POST['long_description2'];}else{echo $instructor['long_description2'];}?>
                                    </textarea>
                                    <?php if(isset($errors['long_description2']) && !empty($errors['long_description2'])){ echo'<label class="control-label">'.$errors['long_description2'].'</label>';}?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-12">
                            	<input class="btn pull-right btn-primary" type="submit" value="Change Details"/>
                            </div>
                            </form>
                            <script>
                                $(document).ready(function() {
                                    $(".classy-editor").ClassyEdit();
									$(".classy-editor2").ClassyEdit();
									$(".classy-editor3").ClassyEdit();
                                });
                            </script> 
                	</div>
            	</div>
			</div>
		</div>
	</div>
</body>
</html>