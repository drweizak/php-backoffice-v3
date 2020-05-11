<?php
require_once('../blocks/restrict.php');
require_once('../blocks/head.php');
require_once('../controller/instructors.php');
$instructors = new instructors();

$instructors_result = $instructors->view('WHERE instructor_id ='.$_GET['id'],'','');
$instructor = $instructors_result->fetch_array();

if(isset($_POST['form']) && $_POST['form']=='editimg'){
	$image = $instructors->upload($_FILES['image'], $instructor['instructor_id']);
	die();
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
                                <?= $instructor['name'];?> <small>Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-file-text"></i> <a href="../instructors">Instructors</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-user"></i> <?= $instructor['name'];?>
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
                                	<a href="edit?id=<?= $instructor['instructor_id'];?>" class="btn btn-primary" title="Edit Instructor">Edit Instructor <i class="fa fa-pencil"></a></i>
                                	<?php if($instructor['head_instructor']==0){?>
                                    <a href="javascript:deleteinstructor();" class="btn btn-danger" title="Delete Instructor">Delete Instructor <i class="fa fa-trash-o"></i></a>
                                    <?php } ?>
                                </h5>
                                </div>
                            </div>
                            </div>
                            <hr/>
							<script type="text/javascript">
                            function deleteinstructor() {
                                var answer = confirm ("Are you sure?")
                                if (answer)
                                    window.location="delete.php?id=<?= $instructor['instructor_id'];?>";
                                }
                            </script>
                   			<div class="col-lg-6 col-sm-12">
                                 <h4>
                                    <small>Name</small><br/>
                                    <?= $instructor['name'];?>
                                </h4>
                                <h4>
                                    <small>Short Description</small><br/>
                                    <?= $instructor['short_description'];?>
                                </h4>
                                <?php if($instructor['long_description1']!=NULL){?>
                               	<h4>
                                    <small>Long Description</small><br/>
                                    <?= $instructor['long_description1'];?>
                                    <?php if($instructor['long_description2']!=NULL){
                                    	echo $instructor['long_description2'];
                                    } ?>
                                </h4>
								<?php } ?>
                            </div>
                            <div class="col-lg-6 col-sm-12">
								<?php if(!empty($instructor['image'])){?>
								<div class="col-md-12">
                                    <img src="../../img/upload/instructors/<?= $instructor['image']?>" class="img-responsive thumbnail"/>
                                    <a href="" data-toggle="modal" data-target="#editImg" class="btn btn-primary delete-img-btn" title="Change Image"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div id="editImg" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <?php include('editimg.php'); ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
						</div>
                    </div>
				</div>
            </div>            
		</div>
	</div>
</body>
</html>