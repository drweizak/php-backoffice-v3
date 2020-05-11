<?php require_once('../blocks/restrict.php');

if(isset($_POST['form']) && $_POST['form']=='signup'){
	
	require_once('../controller/instructors.php');
	$instructors = new instructors();
	
	require_once('../model/add_instructor.php');	
	if(!$errors){
		
		try{
			
			$password = md5($password);
			$instructors->add($name, $short_description, NULL, NULL, NULL, 0);
			$_SESSION['msg'] = 'Instructor added with success!';
			$_SESSION['msg_type'] = 'success';
		}
		catch(Exception $e){
			$_SESSION['msg'] = 'An error occurred! Please, try again.';
			$_SESSION['msg_type'] = 'danger';
		}
		header('location: ../instructors');
		die();
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
                                Add New Instructor
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> <a href="../instructors">Instructors</a>
                                </li>
                                <li class="active">
                                   <i class="fa fa-user"></i> Add New Instructor
                                </li>
                            </ol>
                        </div>
					</div>
                   	<div class="row">
                    	<div class="col-md-6">
                        <form action="" method="post" role="form" enctype="multipart/form-data">
            				<input type="hidden" name="form" value="signup"/>
                                <div class="form-group<?php if(isset($errors['name']) && !empty($errors['name'])){ echo' has-error';}?>">
                                	<small>Name</small>
                                    <input name="name" type="text" class="form-control" placeholder="Name" required <?php if(isset($errors)){echo 'value="'.$_POST['name'].'"';}?>>
                                    <?php if(isset($errors['name']) && !empty($errors['name'])){ echo'<label class="control-label">'.$errors['name'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['short_description']) && !empty($errors['short_description'])){ echo' has-error';}?>">
                                	<small>Short Desription</small>
                                    <textarea name="short_description" class="form-control" required> <?php if(isset($errors)){echo $_POST['short_description'];}?></textarea>
                                    <?php if(isset($errors['short_description']) && !empty($errors['short_description'])){ echo'<label class="control-label">'.$errors['short_description'].'</label>';}?>
                                </div>
                                <input class="btn pull-right btn-primary" type="submit" value="Add User"/>
							</form>
						</div>
                	</div>
            	</div>
			</div>
		</div>
	</div>
</body>
</html>