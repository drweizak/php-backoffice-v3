<?php
require_once('../blocks/restrict.php');
require_once('../controller/pages.php');

$pages = new pages();

$paragraphs_result = $pages->view_paragraphs('WHERE paragraph_id ='.$_GET['id'],'','');
$paragraph = $paragraphs_result->fetch_array();

if(isset($_POST['long_text1'])){
	
	$paragraph_id=$_GET['id'];
	$long_text1=$_POST['long_text1'];
	
	
	$errors = NULL;
	
	require_once('../model/validate.php');
	$validate = new validate();
	if(!empty($long_text1)){
		$long_text1 = str_replace('<div>', '<br/>', $long_text1);
		$long_text1 = str_replace('</div>', '', $long_text1);
	}
	
	if(!empty($long_text1)){
		$long_text1 = $validate->naoEscapar($long_text1);
	}
	
	if($long_text1 != $paragraph['long_text1'] || !empty($long_text1)){
		if (!$validate -> verTamanho ($long_text1, 3)){
		$errors['long_text1']= "Invalid text!";
		}
		if (!$validate -> verTexto ($long_text1)){
		$errors['long_text1']= "Invalid text!";
		}
	}
	else{
		$long_text1 = $paragraph['long_text1'];
	}
	
	if(isset($_POST['long_text2'])){
		$long_text2=$_POST['long_text2'];
		
		if(!empty($long_text2)){
			$long_text2 = str_replace('<div>', '<br/>', $long_text2);
			$long_text2 = str_replace('</div>', '', $long_text2);
			$long_text2 = $validate->naoEscapar($long_text2);
		}

		if($long_text2 != $paragraph['long_text2'] || !empty($long_text2)){
			if (!$validate -> verTamanho ($long_text2, 3)){
			$errors['long_text2']= "Invalid text!";
			}
			if (!$validate -> verTexto ($long_text2)){
			$errors['long_text2']= "Invalid text!";
			}
		}
		else{
			$long_text2 = $paragraph['long_text2'];
		}
	}
	else{
		$long_text2 = NULL;
	}
	
	if(!$errors){
		
		try{
			$edit_result = $pages->edit_paragraph($paragraph_id, $long_text1, $long_text2);
			$_SESSION['msg'] = "Page updated Successfully!";
			$_SESSION['msg_type'] = 'success';
		}
		catch(Exception $e){
			$_SESSION['msg'] = "An error occurred! Please, try again.";
			$_SESSION['msg_type'] = 'danger';
		}
		header('location: view?id='.$paragraph['page_id']);
		die();
	}
}
?>
<?php require_once('../blocks/head.php'); ?>
<body>
    <div id="wrapper" class="col-md-12">
		<div>
       		<?php require_once('../blocks/menu.php');?>
            <div id="paragraph-wrapper">
				<div class="container-fluid">
                	<div class="row">
						<?php require_once('../blocks/msg.php');?>´
                        <div class="col-lg-12">
                            <h1 class="paragraph-header">
                                <?= $paragraph['title'];?> <small>Edit Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> Pages
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> <a href="view?id=<?= $paragraph['page_id']?>"><?= $paragraph['title'];?></a>
                                </li>
                                <li class="active">Edit Details</li>
                            </ol>
                        </div>
					</div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<form action="" method="post" role="form">
                            	<div class="form-group<?php if(isset($errors['long_text1']) && !empty($errors['long_text1'])){ echo' has-error';}?>">
                                    <textarea class="classy-editor form-control" name="long_text1" required><?php if(isset($errors)){echo $_POST['long_text1'];}else{echo $paragraph['long_text1'];}?></textarea>
                                    <?php if(isset($errors['long_text1']) && !empty($errors['long_text1'])){ echo'<label class="control-label">'.$errors['long_text1'].'</label>';}?>
                                </div>
                                <?php if(!empty($paragraph['long_text2'])){ ?>
                                	<div class="form-group<?php if(isset($errors['long_text2']) && !empty($errors['long_text2'])){ echo' has-error';}?>">
                                    <textarea class="classy-editor2 form-control" name="long_text2" required><?php if(isset($errors)){echo $_POST['long_text2'];}else{echo $paragraph['long_text2'];}?></textarea>
                                    <?php if(isset($errors['long_text2']) && !empty($errors['long_text2'])){ echo'<label class="control-label">'.$errors['long_text2'].'</label>';}?>
                                </div>
								<?php } ?>
                                <input class="btn pull-right btn-primary" type="submit" value="Change Details"/>
                    		</form>
							<script>
                                $(document).ready(function() {
                                    $(".classy-editor").ClassyEdit();
									$(".classy-editor2").ClassyEdit();
                                });
                            </script> 
							</form>
                    	</div>
                	</div>
            	</div>
			</div>
		</div>
	</div>
</body>
</html>