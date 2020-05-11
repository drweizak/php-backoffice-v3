<?php
require_once('../blocks/restrict.php');
$users_result = $users->view('WHERE user_id ='.$_GET['id'],'','');
$user = $users_result->fetch_array();

if(isset($_POST['name'])){
	include('../model/edit_user.php');
	if(!$errors){
		try{
			$users->editdetails($_GET['id'], $name, $email);
						
			$_SESSION['msg'] = 'User updated Successfully!';
			$_SESSION['msg_type'] = 'success';
		}
		catch(Exception $e){
			$_SESSION['msg'] = 'An error occurred! Please, try again.';
			$_SESSION['msg_type'] = 'danger';
		}
		echo '<script>window.location="users/view?id='.$_GET['id'].'"</script>';
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
                                <?= $user['name'];?> <small>Edit Details</small>
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
                                <li class="active">Edit Details</li>
                            </ol>
                        </div>
					</div>
                    <div class="row">
                    	<div class="col-md-6">
                        	<form action="" method="post" role="form">
                            	<input name="user_id" type="hidden" value="<?= $user['user_id'];?>" />
                            	<div class="form-group<?php if(isset($errors['name']) && !empty($errors['name'])){ echo' has-error';}?>">
                                	<small>Name</small>
                                    <input name="name" type="text" class="form-control" placeholder="Name" required <?php if(isset($errors)){echo 'value="'.$_POST['name'].'"';}else{echo 'value="'.$user['name'].'"';}?>>
                                    <?php if(isset($errors['name']) && !empty($errors['name'])){ echo'<label class="control-label">'.$errors['name'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['email']) && !empty($errors['email'])){ echo' has-error';}?>">
                                	<small>Email</small>
                                    <input name="email" type="email" class="form-control" autocomplete="off" placeholder="E-mail" required <?php if(isset($errors)){echo 'value="'.$_POST['email'].'"';}else{echo 'value="'.$user['email'].'"';}?>>
                                    <?php if(isset($errors['email']) && !empty($errors['email'])){ echo'<label class="control-label">'.$errors['email'].'</label>';}?>
                                </div>
                                <input class="btn pull-right btn-primary" type="submit" value="Change Details"/>
							</form>
                    	</div>
                	</div>
            	</div>
			</div>
		</div>
	</div>
</body>
</html>