<div class="container">
	<div class="col-sm-offset-4">	
		<p class="para"><?php print_r($this->session->flashdata('error'));?>	</p>
	</div>
<form name="changePassword" class="form-horizontal" action=""  onsubmit="return updatePassword()" method="POST">
<div class="myjumbo" >
  
<div class="form-group">
      <label class="control-label col-sm-4">Target Assigned:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->target_assign; ?> </label>
		</p>
		</div>          
    </div><input type="hidden" name="target_id" value="<?php echo $data[0]->target_id; ?>" />
	<div class="form-group">
      <label class="control-label col-sm-4 required">Total Target Achieve</label>
      <div class="col-sm-3">          
        <label class="control-label">  <p><?php echo $data[0]->total; ?> </label>
      </div>
    </div>
</div>   
 </form>


</div>
