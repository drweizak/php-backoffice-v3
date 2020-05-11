<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Submit Video URL</h4>
  </div>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="modal-body">
    <input type="hidden" name="form" value="editvideo"/>
    <input type="hidden" name="content_id" value="<?= $_GET['id']; ?>"/>
   	<div class="form-group">
		<input name="path" type="text" class="form-control" value="<?php if(isset($content_type['path'])){echo $content_type['path']; }?>" placeholder="Video URL" required >
    </div>
  </div>
  <div class="modal-footer">
	<input class="btn btn-primary" type="submit" value="Submit Video"/>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
  </form>
</div>