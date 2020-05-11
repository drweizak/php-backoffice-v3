<?php require_once('../blocks/restrict.php');

if(isset($_POST['form']) && $_POST['form']=='signup'){
	
	require_once('../controller/users.php');
	$users = new users();
	
	require_once('../model/add_user.php');	
	if(!$errors){
		
		try{
			
			$password = md5($password);
			$users->add($name, $email, $password);
			$_SESSION['msg'] = 'User added with success!';
			$_SESSION['msg_type'] = 'success';
			
			header('location: ../users');
			die();
		}
		catch(Exception $e){
			$_SESSION['msg'] = 'An error occurred! Please, try again.';
			$_SESSION['msg_type'] = 'danger';
			
			header('location: ../users');
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
                                Add New User <small>Sign up form</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-users"></i> <a href="../users">Users</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-users"></i> Add New User
                                </li>
                            </ol>
                        </div>
					</div>
                   	<div class="row">
                    	<div class="col-md-6">
                        <form action="" method="post" role="form" enctype="multipart/form-data">
            				<input type="hidden" name="form" value="signup"/>
                                <div class="form-group<?php if(isset($errors['email']) && !empty($errors['email'])){ echo' has-error';}?>">
                                	<small>Email</small>
                                    <input name="email" type="email" class="form-control" placeholder="Email" required <?php if(isset($errors)){echo 'value="'.$_POST['email'].'"';}?>>
                                    <?php if(isset($errors['email']) && !empty($errors['email'])){ echo'<label class="control-label">'.$errors['email'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['name']) && !empty($errors['name'])){ echo' has-error';}?>">
                                	<small>Name</small>
                                    <input name="name" type="text" class="form-control" placeholder="Name" required <?php if(isset($errors)){echo 'value="'.$_POST['name'].'"';}?>>
                                    <?php if(isset($errors['name']) && !empty($errors['name'])){ echo'<label class="control-label">'.$errors['name'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['password']) && !empty($errors['password'])){ echo' has-error';}?>">
                                	<small>Password</small>
                                    <input name="password" type="password" class="form-control" placeholder="Password" required >
                                    <?php if(isset($errors['password']) && !empty($errors['password'])){ echo'<label class="control-label">'.$errors['password'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['cpassword']) && !empty($errors['cpassword'])){ echo' has-error';}?>">
                                	<small>Confirm Password</small>
                                    <input name="cpassword" type="password" class="form-control" placeholder="Confirm Password" required >
                                    <?php if(isset($errors['cpassword']) && !empty($errors['cpassword'])){ echo'<label class="control-label">'.$errors['cpassword'].'</label>';}?>
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