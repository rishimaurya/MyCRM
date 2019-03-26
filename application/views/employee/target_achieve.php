<div class="container">
	<div class="col-sm-offset-4">	
		<p class="para"><?php print_r($this->session->flashdata('error'));?>	</p>
	</div>
<form name="changePassword" class="form-horizontal" action="<?php echo base_url('Employee/get_target_achieve'); ?>"  onsubmit="return updatePassword()" method="POST">
<div class="myjumbo" >
  
<div class="form-group">
      <label class="control-label col-sm-4">Target Assigned:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->target_assign; ?> </label>
		</p>
		</div>          
    </div><input type="hidden" name="target_id" value="<?php echo $data[0]->target_id; ?>" />
	<div class="form-group">
      <label class="control-label col-sm-4 required">Target Achieve</label>
      <div class="col-sm-3">          
        <input type="text" name="target_achieve" class="form-control" placeholder="Target"  required>
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-4 required">Achieve Date</label>
      <div class="col-sm-3">          
        <input type="date" name="achieve_date" class="form-control"  required>
      </div>
    </div>

	
    <div class="form-group">        
      <div class="col-sm-offset-4 col-sm-2">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
</div>   
 </form>


</div>

