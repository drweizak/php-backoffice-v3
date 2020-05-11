<?php
include('../blocks/restrict.php');
include('../controller/posts.php');
$posts = new posts();?>
<?php require_once('../blocks/head.php'); ?>
<script>
$(document).ready(function () {
	(function ($) {
		$('#filter').keyup(function () {
			var rex = new RegExp($(this).val(), 'i');
			$('.searchable a').hide();
			$('.searchable a').filter(function () {
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
                                News <small>List</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-newspaper-o"></i> News
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
                                    	<a href="../news/add?t=2" class="btn btn-success" title="Add Text">Add Text <i class="fa fa-plus"></i></a>
                                    	<a href="../news/add?t=0" class="btn btn-success" title="Add Gallery">Add Gallery <i class="fa fa-plus"></i></a>
                                    	<a href="../news/add?t=1" class="btn btn-success" title="Add Video">Add Video <i class="fa fa-plus"></i></a>
                                    </h5>
                                </div>
                            </div>
                            </div>
                            <hr/>
							<div class="col-lg-12">
                                <div class="list-group">
                                 <?php
                                $posts_result = $posts->view('','ORDER BY post_id DESC','');
                                while($post = $posts_result->fetch_array()){ ?>
                                    <div class="searchable">
                                    <a href="../news/view?id=<?= $post['post_id'];?>" class="list-group-item col-md-3 col-sm-4">
                                        <h4 class="list-group-item-heading"><?= $post['title'];?> (<?= date('F d, Y', strtotime($post['date']));?>)</h4>
                                        <p class="list-group-item-text"><?= $post['description'];?></p>
                                    </a>
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