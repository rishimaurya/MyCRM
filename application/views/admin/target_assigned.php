<div class="container">
	<div class="col-sm-offset-4">	
		<p class="para"><?php print_r($this->session->flashdata('error'));?>	</p>
	</div>
<form name="changePassword" class="form-horizontal" action="<?php echo base_url('ViewEmployee/get_target_assigned'); ?>"  onsubmit="return updatePassword()" method="POST">
<div class="myjumbo" >
  
	<div class="form-group">
      <label class="control-label col-sm-4">Username:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo ucfirst($data[0]->username) ; ?> </label>
		</p>
		</div>          
    </div><input type="hidden" name="employee_id" value="<?php echo $data[0]->employee_id; ?>" />
	<div class="form-group">
      <label class="control-label col-sm-4 required">Target</label>
      <div class="col-sm-3">          
        <input type="text" name="target_assign" class="form-control" placeholder="Target"  required>
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-4 required">Start Date</label>
      <div class="col-sm-3">          
        <input type="date" name="start_date" class="form-control"  required>
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-4 required">End Date</label>
      <div class="col-sm-3">          
        <input type="date" name="end_date" class="form-control"required>
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

