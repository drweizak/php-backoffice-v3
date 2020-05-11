<?php
require_once('../blocks/restrict.php');
require_once('../blocks/head.php');
$users_result = $users->view('WHERE user_id ='.$_GET['id'],'','');
$user = $users_result->fetch_array();
?>
<body>
    <div id="wrapper" class="col-md-12">
		<div>
       		<?php require_once('../blocks/menu.php');?>
            <div id="page-wrapper">
				<div class="container-fluid">
                	<div class="row">
						<?php require_once('../blocks/msg.php');?>
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                <?= $user['name'];?> <small>Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-users"></i> <a href="../users">Users</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-users"></i> <?= $user['name'];?>
                                </li>
                            </ol>
                        </div>
					</div>
                    <div class="row">
                        <div class="col-lg-12">
							<div class="row">
                            <div class="col-md-4">
                            	<div class="form-group input-group">
                                </div>
                        	</div>
                            <div class="col-md-6 col-md-offset-2">
                            	<div class="form-group input-group pull-right text-align">
								<h5>
                                	<a href="edit?id=<?= $user['user_id'];?>" class="btn btn-primary" title="Edit User">Edit User <i class="fa fa-pencil"></a></i>
                                    
								<?php
                                if($_SESSION['user_id']==$user['user_id']){?>
                                    <a href="password?id=<?= $user['user_id'];?>" class="btn btn-primary" title="Change Password">Change Password <i class="fa fa-pencil"></a></i>
                                <?php } 
								if($user['user_id']!=1){?>
                                	<a href="javascript:deleteuser();" class="btn btn-danger" title="Delete User">Delete User <i class="fa fa-trash-o"></i></a> <?php } ?>
                                </h5>
                                </div>
                            </div>
                            </div>
                            <hr/>
							<script type="text/javascript">
                            function deleteuser() {
                                var answer = confirm ("Are you sure?")
                                if (answer)
                                    window.location="delete.php?id=<?= $user['user_id'];?>";
                                }
                            </script>
                   			<div class="col-lg-12">
                                 <h4>
                                    <small>Name</small><br/>
                                    <?= $user['name'];?>
                                </h4>
                                <h4>
                                    <small>E-mail</small><br/>
                                    <?= $user['email'];?>
                                </h4>
                            </div>
						</div>
                    </div>
				</div>
            </div>            
		</div>
	</div>
</body>
</html>