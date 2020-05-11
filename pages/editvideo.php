<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Change Video URL</h4>
  </div>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="modal-body">
    <input type="hidden" name="form" value="editvideo"/>
    <input type="hidden" name="page_id" value="<?=$page['page_id']?>"/>
   	<div class="form-group">
		<input name="image" type="text" class="form-control" value="<?=$page['image']?>" placeholder="Video URL" required >
    </div>
  </div>
  <div class="modal-footer">
	<input class="btn btn-primary" type="submit" value="Change Video"/>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
  </form>
</div>