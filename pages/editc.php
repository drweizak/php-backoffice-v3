<?php
require_once('../blocks/restrict.php');
require_once('../controller/classes.php');

$classes = new classes();

$classes_result = $classes->view('WHERE class_id ='.$_GET['id'],'','');
$class = $classes_result->fetch_array();

if(isset($_POST['title'])){
	
	$class_id=$_GET['id'];
	$date = $_POST['date'].'-'.date('m', strtotime($class['date'])).'-01';	
	$errors = NULL;
	
	require_once('../model/validate.php');
	$validate = new validate();
	
	if($_POST['title']!=$class['title']){
		$title = $validate->limparCampos($_POST['title']);
		
		if (!$validate -> verTexto($title) && !$validate -> verTamanho($title, 3, 50)){
			$errors['title'] = 'Invalid title!';
		}
	}
	else{
		$title = $class['title'];
	}
	
	if($_POST['equipment']!=$class['equipment']){
		$equipment = $validate->limparCampos($_POST['equipment']);
		
		if (!$validate -> verTexto($equipment) && !$validate -> verTamanho($equipment, 3, 50)){
			$errors['equipment'] = 'Invalid equipment!';
		}
	}
	else{
		$equipment = $class['equipment'];
	}
	
	if(!$errors){
		
		try{
			$edit_result = $classes->edit($class_id, $title, $equipment, $date);
			$_SESSION['msg'] = "Class updated Successfully!";
			$_SESSION['msg_type'] = 'success';
		}
		catch(Exception $e){
			$_SESSION['msg'] = "An error occurred! Please, try again.";
			$_SESSION['msg_type'] = 'danger';
		}
		header('location: view?id=2');
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
                                <?= $class['title'];?> <small>Edit Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> Pages
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> <a href="../pages/view?id=2">Classes</a>
                                </li>
                                <li class="active">Edit Details: <?= $class['title'];?></li>
                            </ol>
                        </div>
					</div>
                    <div class="row">
                    	<div class="col-md-6">
                    		<form action="" method="post" role="form">
                            	<div class="form-group<?php if(isset($errors['title']) && !empty($errors['title'])){ echo' has-error';}?>">
                                	<input class="form-control" type="text" name="title" required <?php if(isset($errors)){echo 'value="'.$_POST['title'].'"';}else{echo 'value="'.$class['title'].'"';}?>> 
                                    <?php if(isset($errors['title']) && !empty($errors['title'])){ echo'<label class="control-label">'.$errors['title'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['equipment']) && !empty($errors['equipment'])){ echo' has-error';}?>">
                                	<input class="form-control" type="text" name="equipment" required <?php if(isset($errors)){echo 'value="'.$_POST['equipment'].'"';}else{echo 'value="'.$class['equipment'].'"';}?>> 
                                    <?php if(isset($errors['equipment']) && !empty($errors['equipment'])){ echo'<label class="control-label">'.$errors['equipment'].'</label>';}?>
                                </div>
                                <div class="form-group<?php if(isset($errors['date']) && !empty($errors['date'])){ echo' has-error';}?>">
                                	<input class="form-control" type="number" min="<?= date('Y')?>" max="<?= date('Y', strtotime('+1 year'))?>" name="date" required <?php if(isset($errors)){echo 'value="'.$_POST['date'].'"';}else{echo 'value="'.date('Y', strtotime($class['date'])).'"';}?>> 
                                    <?php if(isset($errors['date']) && !empty($errors['date'])){ echo'<label class="control-label">'.$errors['date'].'</label>';}?>
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