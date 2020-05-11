<?php
include('../blocks/restrict.php');
include('../controller/slides.php');
$slides = new slides();

if(isset($_POST['form']) && $_POST['form']=='addimg'){
	$slide = $slides->upload($_FILES['image']);
	die();
}

?>
<?php require_once('../blocks/head.php'); ?>
<script>
$(document).ready(function () {
	(function ($) {
		$('#filter').keyup(function () {
			var rex = new RegExp($(this).val(), 'i');
			$('.searchable div').hide();
			$('.searchable div').filter(function () {
				return rex.test($(this).text());
			}).show();
		})
	}(jQuery));
});
</script>
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
                                Slides <small>List</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-picture-o"></i> Slides
                                </li>
                            </ol>
                        </div>
                        
                    </div>
                    <div class="row">
                    	
                        <div class="col-lg-12">
							<div class="row">
                            <div class="col-md-4">
                            	<div class="form-group input-group">
                                    <input type="search" class="form-control" id="filter" placeholder="Search...">
                                    <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                                </div>
                        	</div>
                            <div class="col-md-6 col-md-offset-2">
                            	<div class="form-group input-group pull-right text-align">
                                	<h5>
                                    	<a data-toggle="modal" data-target="#addImg" class="btn btn-success" title="Add Image">Add Image <i class="fa fa-plus"></i></a>
                                    </h5>
                                    <div id="addImg" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <?php include('addimg.php'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <hr/>
							<div class="col-lg-12">
                                <div class="list-group">
                                 <?php
                                $slides_result = $slides->view('','ORDER BY slide_id DESC','');
                                while($slide = $slides_result->fetch_array()){ ?>
                                <script type="text/javascript">
									function deletecontent<?= $slide['slide_id']?>() {
										var answer = confirm ("Are you sure?")
										if (answer)
											window.location="delete.php?id=<?= $slide['slide_id'];?>";
									}
								</script>
                                    <div class="searchable">
                                    <div class="list-group-item col-md-3 col-sm-4">
                                    <a>
                                        <h4 class="list-group-item-heading"><img src="../../img/upload/slides/<?= $slide['path'];?>" class="img-responsive" /></h4>
                                    </a>
                                    <a href="javascript:deletecontent<?= $slide['slide_id']?>();" class="btn btn-danger delete-img-btn" title="Delete Post"><i class="fa fa-trash-o"></i></a>
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
	</div>
</body>
</html>