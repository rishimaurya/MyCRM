
<div class="container">
	<h3 class="student">Update Designation</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Designation/update'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
    
    <div class="form-group">
      <label class="control-label col-sm-4 required"> Designation</label>
      <div class="col-sm-6">          
        <input type="text" name="designation" class="form-control" value="<?php echo $designation->designation;?>" required>
      </div>
    </div>
    

	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Update Designation</button>
      </div>
    </div>
	
</div> 
    <input type="hidden" value="<?php echo $designation->id;?>" name="designation_id">  
</form>
</div> 
