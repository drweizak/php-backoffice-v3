<?php require_once('blocks/restrict.php');?>
<?php require_once('blocks/head.php'); ?>
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<?php
require_once('controller/event_logs.php');
$event_logs = new event_logs();
$date = strtotime(date('Y-m-d').' -1 year');
$visits_result = $event_logs->view('*', 'WHERE date BETWEEN \''.date('Y-m-d', $date).'\' AND \''.date('Y-m-d').'\'', '');
?>
<script>
$(function() {

    // Line Chart
    Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'morris-line-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
		<?php while($visit = $visits_result->fetch_array()){?>
		{
            d: '<?=$visit['date']?>',
            visits: <?=$visit['visits']?>
        }, 
		<?php }?>
		],
        // The name of the data record attribute that contains x-visitss.
        xkey: 'd',
        // A list of names of data record attributes that contain y-visitss.
        ykeys: ['visits'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Visits'],
        // Disables line smoothing
        smooth: false,
        resize: true
    });


});
</script>
<body>
    <div id="wrapper" class="col-md-12">
		<div>
       		<?php require_once('blocks/menu.php');?>
            <div id="page-wrapper">
				<div class="container-fluid">
                    <div class="row">
                    	<?php require_once('blocks/msg.php');?>
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Ninpo Toronto Ninjutsu
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-home"></i> Dashboard
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Visitors</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="morris-line-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Recent Posts</h3>
                                </div>
                                <div class="panel-body">
                                 <div class="list-group">
                                	<?php
									require_once('controller/posts.php');
									$posts = new posts();
									$posts_result = $posts->view('', 'ORDER BY post_id DESC', 'LIMIT 4');
									
									while($post = $posts_result->fetch_array()){?>
                                    <a href="news/view?id=<?= $post['post_id'];?>" class="list-group-item">
                                        <h4 class="list-group-item-heading"><?= $post['title'];?> (<?= date('F d, Y', strtotime($post['date']));?>)</h4>
                                        <p class="list-group-item-text"><?= $post['description'];?></p>
                                    </a>
									<?php } ?>
                                	</div>
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
