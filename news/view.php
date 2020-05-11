<?php
require_once('../blocks/restrict.php');
require_once('../blocks/head.php');
require_once('../controller/posts.php');
$posts = new posts();

$posts_result = $posts->view('WHERE post_id ='.$_GET['id'],'','');
$post = $posts_result->fetch_array();

if(isset($_POST['form']) && $_POST['form']=='addimg'){

	$image = $posts->upload($_FILES['image'], $post['post_id']);
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
	if(preg_match($pattern, $_POST['path'], $matches)) {
    	$path = $matches[1];
		$post_results = $posts->view_content('WHERE post_id='.$_GET['id'],'','');
		if($post_results->num_rows > 0){
			$posts->edit_content($_POST['content_id'], $path);
		}else{
			$posts->add_content('1', $path, $_GET['id']);
		}
		$_SESSION['msg']="Video Submited Successfully!";
		$_SESSION['msg_type']='success';
	}
	else{
		$_SESSION['msg']="Invalid Youtube URL video!";
		$_SESSION['msg_type']='danger';
	}
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
                                <?= $post['title'];?> <small>Details</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i> <a href="../dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <i class="fa fa-newspaper-o"></i> <a href="../news">News</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-newspaper-o"></i> <?= $post['title'];?>
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
                                	<a href="../news/edit?id=<?= $post['post_id'];?>" class="btn btn-primary" title="Edit Post">Edit Post <i class="fa fa-pencil"></a></i>
                                	<a href="javascript:deletepost();" class="btn btn-danger" title="Delete Post">Delete Post <i class="fa fa-trash-o"></i></a>
                                </h5>
                                </div>
                            </div>
                            </div>
                            <hr/>
							<script type="text/javascript">
                            function deletepost() {
                                var answer = confirm ("Are you sure?")
                                if (answer)
                                    window.location="delete.php?id=<?= $post['post_id'];?>";
                                }
                            </script>
                            <div class="col-lg-6 col-sm-12">
                                 <h4>
                                    <small>Title</small><br/>
                                    <?= $post['title'];?>
                                </h4>
                                <h4>
                                    <small>Description</small><br/>
                                    <?= $post['description'];?>
                                </h4>
                                <h4>
                                    <small>Cresated at</small><br/>
                                    <?= date('F d, Y', strtotime($post['date']));?>
                                </h4>
                            </div>
                            <div class="col-lg-6 col-sm-12">
								<?php
								$content_result = $posts->view_content('WHERE post_id='.$post['post_id'],'ORDER BY content_id DESC','');
								$content_result2 = $posts->view_content('WHERE post_id='.$post['post_id'],'ORDER BY content_id DESC','');
								$numrows = $content_result->num_rows;
								$numrows2 = $content_result2->num_rows;
								if($numrows != 0 || $numrows2 != 0){
								$content_type = $content_result2->fetch_array();
								if($content_type['type']==0){ ?>
                                <div class="panel-heading text-right">
									<a href="" data-toggle="modal" data-target="#addImg" class="btn btn-success" title="Add Image">Add Image <i class="fa fa-plus"></i></a>
                                </div>
                                <div id="addImg" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <?php include('addimg.php'); ?>
                                    </div>
                                </div>
								<?php while($content = $content_result->fetch_array()){?>
                                <script type="text/javascript">
									function deletecontent<?= $content['content_id'];?>() {
										var answer = confirm ("Are you sure?")
										if (answer)
											window.location="deletecontent.php?id=<?= $content['content_id'];?>";
									}
								</script>
                                
                                <div class="col-md-6 col-sx-12">
                                    <img src="../../img/upload/news/<?= $content['path']?>" class="img-responsive thumbnail"/>
                                    <a href="javascript:deletecontent<?= $content['content_id']?>();" class="btn btn-danger delete-img-btn" title="Delete Image"><i class="fa fa-trash-o"></i></a>

                                </div>
                                <?php } } if($content_type['type']==1){?>
                                 <script type="text/javascript">
									function deletecontent<?= $content_type['content_id'];?>() {
										var answer = confirm ("Are you sure?")
										if (answer)
											window.location="deletecontent.php?id=<?= $content_type['content_id'];?>";
									}
								</script>
                                <div class="panel-heading text-right">
									<a href="" data-toggle="modal" data-target="#editVideo" class="btn btn-primary" title="Change Video">Change Video <i class="fa fa-pencil"></i></a>
                                    <a href="javascript:deletecontent<?= $content_type['content_id']?>();" class="btn btn-danger" title="Delete Video">Delete Video <i class="fa fa-trash-o"></i></a>
                                </div>
                                <div id="editVideo" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <?php include('editvideo.php'); ?>
                                    </div>
                                </div>
                               
                                <div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $content_type['path'];?>?rel=0"></iframe>
								</div>
                                <?php } }else{?>
                                	<div class="panel-heading text-right">
                                        <a href="" data-toggle="modal" data-target="#addImg" class="btn btn-success" title="Add Image">Add Image <i class="fa fa-plus"></i></a>
                                        <a href="" data-toggle="modal" data-target="#editVideo" class="btn btn-success" title="Add Video">Add Video <i class="fa fa-plus"></i></a>
                                    </div>
                                    <div id="addImg" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <?php include('addimg.php'); ?>
                                        </div>
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
				</div>
            </div>            
		</div>
	</div>
</body>
</html>