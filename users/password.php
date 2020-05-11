<?php require_once('../blocks/restrict.php');

$users_result = $users->view('WHERE user_id ='.$_GET['id'],'','');
$user = $users_result->fetch_array();

if(isset($_POST['password'])){
	
	$user_id=$_GET['id'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	
	require_once('../model/password.php');
	if(!$errors){
		try{
			$edit_result = $users -> editpassword($user_id, $password);
			$_SESSION['msg'] = "Password successfully updated!";
			$_SESSION['msg_type'] = 'success';
			header('location: ../users/view?id='.$_GET['id']);
		}
		
		catch(Exception $e){
			$_SESSION['msg'] = "An error occorred! Please, try again.";
			$_SESSION['msg_type'] = 'warning';
		}
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
                                <?= $user['name'];?> <small>Change Password</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-users"></i> <a href="../users">Users</a>
                                </li>
                                <li>
                                    <i class="fa fa-users"></i> <a href="view?id=<?= $user['user_id']?>"><?= $user['name'];?></a>
                                </li>
                                <li class="active">Change Password</li>
                            </ol>
                        </div>
					</div>
                   	<div class="row">
                    	<div class="col-md-6">
                        	<form action="" method="post" role="form">
                                <input name="user_id" type="hidden" value="<?= $user['user_id'];?>" />
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
                                <input class="btn pull-right btn-primary" type="submit" value="Change Password"/>
							</form>
                    	</div>
                	</div>
            	</div>
			</div>
		</div>
	</div>
</body>
</html>