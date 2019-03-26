<div class="container">
	<h3 class="student">Update Lead</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/update_leads'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
  
	<div class="form-group">
      <label class="control-label col-sm-4 required">Name</label>
      <div class="col-sm-2">
        <input type="text" name="first_name" class="form-control" value="<?php echo $mydata->first_name;?>" required>
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" value="<?php echo $mydata->middle_name;?>" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" value="<?php echo $mydata->last_name;?>" required>
      </div>
    </div>
    
	
     
	
    <div class="form-group">
      <label class="control-label col-sm-4 required">Gender:  </label>
      <div class="col-sm-6">          
		<input type="text" name="gender" class="form-control" value="<?php echo $mydata->gender;?>" readonly>
     </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-4 required"> contact number</label>
      <div class="col-sm-6">          
        <input type="text" name="mobile" class="form-control" value="<?php echo $mydata->mobile;?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> email address </label>
      <div class="col-sm-6">          
        <input type="email" name="email" class="form-control" value="<?php echo $mydata->email;?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">Address</label>
      <div class="col-sm-6">          
        <input type="text" name="address" class="form-control" value="<?php echo $mydata->address;?>"  >
      </div>
    </div>
	
	
	<div class="form-group">
      <label class="control-label col-sm-4 "> Profession</label>
      <div class="col-sm-6">          
        <input type="text" name="profession" class="form-control" value="<?php echo $mydata->profession;?>"  >
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 ">Next Follow Up Date</label>
      <div class="col-sm-6">          
        <input type="date" name="follow_up_date" class="form-control" value="<?php echo $mydata->follow_up_date;?>"  >
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 ">Status</label>
		<div class="col-sm-6">          
			<select class="form-control branch" name="status">
			<option <?php if(strcasecmp($mydata->status,"no status")==0){ echo "selected" ;} ?> value="no status">No Status</option>
			<option <?php if(strcasecmp($mydata->status,"pending")==0){ echo "selected" ; } ?> value="pending">Pending</option>
			<option <?php if(strcasecmp($mydata->status,"converted")==0){ echo "selected"; }  ?> value="converted">Converted</option>
			<option <?php if(strcasecmp($mydata->status,"rejected")==0) {echo "selected" ;} ?> value="pejected">Rejected</option>
		</select>
      </div>
	  </div>
	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Update Lead</button>
      </div>
    </div>
	
</div> 
    <input type="hidden" value="<?php echo $mydata->client_id;?>" name="client_id">  
</form>
</div> 
