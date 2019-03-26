
<div class="container">
	<h3 class="student">Update Service</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Services/update'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
    
    <div class="form-group">
      <label class="control-label col-sm-4 required"> Service</label>
      <div class="col-sm-6">          
        <input type="text" name="service" class="form-control" value="<?php echo $service->service_name;?>" required>
      </div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-4 required"> Service Amount</label>
      <div class="col-sm-6">          
        <input type="text" name="service_amoun" class="form-control" value="<?php echo $service->service_amount;?>" required>
      </div>
    </div> 
   
    <div class="form-group">
      <label class="control-label col-sm-4 required">Quaterly amount</label>
      <div class="col-sm-2">
        <input type="text" name="quaterly_amount" class="form-control" value="<?php echo $service->quaterly_amount;?>" required>
      </div>
	  </div>
	  
	  <div class="form-group">
      <label class="control-label col-sm-4 required">Half Yearly amount</label>
      <div class="col-sm-2">
        <input type="text" name="halfyearly_amount" class="form-control" value="<?php echo $service->halfyearly_amount;?>">
      </div>
	  </div>
	  
	  <div class="form-group">
      <label class="control-label col-sm-4 required">Yearly amount</label>
      <div class="col-sm-2">
        <input type="text" name="yearly_amount" class="form-control" value="<?php echo $service->yearly_amount;?>"
      </div>
	  </div>
   
	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Update Service</button>
      </div>
    </div>
	
</div> 
    <input type="hidden" value="<?php echo $service->service_id;?>" name="service_id">  
</form>
</div> 
