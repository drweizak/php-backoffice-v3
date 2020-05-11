<?php if(!empty($_SESSION['msg']) && !is_array($_SESSION['msg'])){?>
<div id="message" class="alert alert-<?= $_SESSION['msg_type'];?>" style="display:none;">
<a id="close-button" class="pull-right alert-<?= $_SESSION['msg_type'];?>" href="#">X</a>
    <?= $_SESSION['msg'];?>
</div>
<?php $_SESSION['msg'] = NULL; $_SESSION['msg_type'] = NULL;?>
<script>
$(document).ready(function(){
	$("#message").fadeIn("slow");
});
$(document).ready(function(){
    $("#close-button").click(function(){
        $("#message").fadeOut("slow");
    });
});
</script>
<?php }
if(!empty($_SESSION['msg']) && is_array($_SESSION['msg'])){
	$count = 0;
	foreach($_SESSION['msg'] as $imgmsg){?>
	<div id="message" class="message<?=$count;?> alert alert-<?= $imgmsg['msg_type'];?>" style="display:none;">
		<a id="close-button<?=$count;?>" class="pull-right alert-<?= $imgmsg['msg_type'];?>" href="#">X</a>
		<?= $imgmsg['text'];?>
	</div>
	<script>
		$(document).ready(function(){
			$(".message<?=$count;?>").fadeIn("slow");
		});
		$(document).ready(function(){
			$("#close-button<?=$count;?>").click(function(){
				$(".message<?=$count;?>").fadeOut("slow");
			});
		});
	</script>
<?php 
		$count = $count + 1;
	}
	$_SESSION['msg'] = NULL;
	$_SESSION['msg_type'] = NULL;
}
?>
