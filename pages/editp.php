<?php
require_once('../blocks/restrict.php');
require_once('../controller/pages.php');

$pages = new pages();

$pages_result = $pages->view('WHERE page_id ='.$_GET['id'],'','');
$page = $pages_result->fetch_array();

if(isset($_POST['text'])){
	
	$page_id=$_GET['id'];
	$text=$_POST['text'];
	
	
	$errors = NULL;
	
	require_once('../model/validate.php');
	$validate = new validate();
	if(!empty($text)){
		$text = str_replace('<div>', '<br/>', $text);
		$text = str_replace('</div>', '', $text);
	}
	
	if(!empty($text)){
		$text = $validate->naoEscapar($text);
	}
	
	if($text != $page['text'] || !empty($text)){
		if (!$validate -> verTamanho ($text, 3)){
		$errors['text']= "Invalid text!";
		}
		if (!$validate -> verTexto ($text)){
		$errors['text']= "Invalid text!";
		}
	}
	else{
		$text = $page['text'];
	}
	
	if(!$errors){
		
		try{
			$edit_result = $pages->edit_page($page_id, $text);
			$_SESSION['msg'] = "Page updated Successfully!";
			$_SESSION['msg_type'] = 'success';
		}
		catch(Exception $e){
			$_SESSION['msg'] = "An error occurred! Please, try again.";
			$_SESSION['msg_type'] = 'danger';
		}
		header('location: view?id='.$page_id);
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
                                <?= $page['title'];?> <small>Edit Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> Pages
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> <a href="view?id=<?= $page['page_id']?>"><?= $page['title'];?></a>
                                </li>
                                <li class="active">Edit Details</li>
                            </ol>
                        </div>
					</div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<form action="" method="post" role="form">
                            	<div class="form-group<?php if(isset($errors['text']) && !empty($errors['text'])){ echo' has-error';}?>">
                                    <textarea class="classy-editor form-control" name="text" required><?php if(isset($errors)){echo $_POST['text'];}else{echo $page['text'];}?></textarea>
                                    <?php if(isset($errors['text']) && !empty($errors['text'])){ echo'<label class="control-label">'.$errors['text'].'</label>';}?>
                                </div>
                                <?php if(!empty($page['long_text2'])){ ?>
                                	<div class="form-group<?php if(isset($errors['long_text2']) && !empty($errors['long_text2'])){ echo' has-error';}?>">
                                    <textarea class="classy-editor2 form-control" name="long_text2" required><?php if(isset($errors)){echo $_POST['long_text2'];}else{echo $page['long_text2'];}?></textarea>
                                    <?php if(isset($errors['long_text2']) && !empty($errors['long_text2'])){ echo'<label class="control-label">'.$errors['long_text2'].'</label>';}?>
                                </div>
								<?php } ?>
                                <input class="btn pull-right btn-primary" type="submit" value="Change Details"/>
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