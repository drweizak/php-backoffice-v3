<?php
require_once('../blocks/restrict.php');
require_once('../blocks/head.php');
require_once('../controller/pages.php');
require_once('../controller/classes.php');

$pages = new pages();
$classes = new classes();
$pages_result = $pages->view('WHERE page_id ='.$_GET['id'],'','');
$page = $pages_result->fetch_array();

if(isset($_POST['form']) && $_POST['form']=='editimg'){
	$image = $pages->upload($_FILES['image'], $page['page_id']);
	die();
}
if(isset($_POST['form']) && $_POST['form']=='editvideo'){

	$pattern = '#^(?:https?://)?';    # Optional URL scheme. Either http or https.
    $pattern .= '(?:www\.)?';         #  Optional www subdomain.
    $pattern .= '(?:';                #  Group host alternatives:
    $pattern .=   'youtu\.be/';       #    Either youtu.be,
    $pattern .=   '|youtube\.com';    #    or youtube.com
    $pattern .=   '(?:';              #    Group path alternatives:
    $pattern .=     '/embed/';        #      Either /embed/,
    $pattern .=     '|/v/';           #      or /v/,
    $pattern .=     '|/watch\?v=';    #      or /watch?v=,    
    $pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
    $pattern .=   ')';                #    End path alternatives.
    $pattern .= ')';                  #  End host alternatives.
    $pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
    $pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.
	if(preg_match($pattern, $_POST['image'], $matches)) {
    	$image = $matches[1];
		$pages->edit_page_img($_POST['page_id'], $image);
		$_SESSION['msg']="Video Changed Successfully!";
		$_SESSION['msg_type']='success';
	}
	else{
		$_SESSION['msg']="Invalid Youtube URL video!";
		$_SESSION['msg_type']='danger';
	}
	header('location: '.$_SERVER['HTTP_REFERER']);
}
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
                                <?= $page['title'];?> <small>Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> Pages
                                </li>
                                <li class="active">
                                    <i class="fa fa-file-text"></i> <?= $page['title'];?>
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
                                </div>
                            </div>
                            </div>
                            <hr/>
                            <div class="col-lg-6 col-sm-12">
                                <?php if(!empty($page['text'])){?>
                                <div class="col-md-12">
                                <a href="editp?id=<?= $page['page_id'];?>" class="btn btn-primary pull-right" title="Change Paragraph"><i class="fa fa-pencil"></i></a>
                                	<?= $page['text']; ?>
                                 </div>
                                <?php } $paragraphs_result = $pages->view_paragraphs('WHERE page_id='.$_GET['id'],'','');
								if($paragraphs_result->num_rows>0){
									while($paragraph = $paragraphs_result->fetch_array()){
								?>
                                <h4>
                                    <small>Title</small><a href="edit?id=<?= $paragraph['paragraph_id'];?>" class="btn btn-primary pull-right" title="Edit Paragraph"><i class="fa fa-pencil"></i></a><br/>
                                    <?= $paragraph['title'];?>
                                    
                                </h4>
                                <div class="col-md-12">
                                
                                    <?= $paragraph['long_text1'];?>
								<?php if(!empty($paragraph['long_text2'])){
                                	echo $paragraph['long_text2'];
									}?>
                                </div>
                                    <hr/>
                                <?php } }?>
                            </div>
                            <div class="col-lg-6 col-sm-12">
								<?php if(!empty($page['image']) && $page['page_id']!=4){?>
                                <img src="../../img/upload/pages/<?= $page['image']?>" class="img-responsive thumbnail"/>
                                <a href="" data-toggle="modal" data-target="#editImg" class="btn btn-primary delete-img-btn" title="Change Image"><i class="fa fa-pencil"></i></a>
                                <div id="editImg" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <?php include('editimg.php'); ?>
                                    </div>
                                </div>
									<?php }if(!empty($page['image']) && $page['page_id']==4){?>
                                    <div class="panel-heading text-right">
                                        <a href="" data-toggle="modal" data-target="#editVideo" class="btn btn-primary" title="Change Video">Change Video <i class="fa fa-pencil"></i></a>
                                    </div>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $page['image'];?>?rel=0"></iframe>
                                    </div>
                                    
                                    <div id="editVideo" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <?php include('editvideo.php'); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
						</div>
                        </div>
                        <?php if($_GET['id']==2){ ?>
                        <hr/>
                        <div class="row">
                        <div class="col-lg-12">
                        <h3>Monthly Updates <small>Edit each field for each month that you need to update</small></h3>
                        	 <?php $classes_result=$classes->view('','ORDER BY date ASC','LIMIT 12');
							$count = 1;
							while($class = $classes_result->fetch_array()){
								if($count == 1){
									echo '<div class="col-md-4"><div class="list-group">';
								}?>
							  <li class="list-group-item">
                              <a href="editc?id=<?= $class['class_id'];?>" class="btn btn-primary pull-right" title="Change Paragraph"><i class="fa fa-pencil"></i></a>
								<h4><?= date('F', strtotime($class['date'])).' '.date('Y', strtotime($class['date']));?></h4>
								<p><?= $class['title'].'<br/>'.$class['equipment']?></p>
							  </li>
							<?php 
							if($count == 4){ $count = 1; echo '</div></div>';}else{$count = $count + 1;}} ?>
                        </div>
                        </div>
                        <?php } ?>
                    </div>
				</div>
            </div>            
		</div>
	</div>
</body>
</html>