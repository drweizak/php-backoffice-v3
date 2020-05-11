<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add Image</h4>
  </div>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="modal-body">
    <input type="hidden" name="form" value="addimg"/>
   	<div class="form-group">
    	<label>For a better slider performance and quality, plese manually crop your image with a following size (1900px X 650px)</label>
    	<input name="image[]" id="file-0a" class="file <?php if(isset($errors['image']) && !empty($errors['image'])){ echo' has-error';}?>" type="file" data-min-file-count="1">
		<?php if(isset($errors['image']) && !empty($errors['image'])){ echo'<label class="control-label">'.$errors['image'].'</label>';}?>
    </div>
  </div>
  <div class="modal-footer">
	<input class="btn btn-primary" type="submit" value="Add Image"/>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
  </form>
</div>