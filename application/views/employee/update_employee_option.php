<div class="container">
	<h3 class="student">Update Employee Profile</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<div class="myjumbo">
    <form name="employeeUpdateForm" class="form-horizontal" action="<?php echo base_url('ViewEmployee/reset_password'); ?>"  method="POST">
      <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Reset Password</button>
      </div>
    </div><input type="hidden" value="<?php echo $mydata->employee_id;?>" name="employee_id">
    </form>
    
    
  <form name="employeeUpdateForm" class="form-horizontal" action="<?php echo base_url('ViewEmployee/update_employee'); ?>"  onsubmit="return validateemployeeUpdateForm()" method="POST">
 <div class="form-group">
      <label class="control-label col-sm-4 required"> Designation</label>
      <div class="col-sm-6">          
        <select class="form-control branch" name="role">
     <option value="admin" <?php if(strcasecmp($mydata->role,'admin')==0){ echo "selected" ;} ?> >Admin</option>
     <option value="manager" <?php if(strcasecmp($mydata->role,'manager')==0){ echo "selected" ;} ?> >Manager</option>
     <option value="employee" <?php if(strcasecmp($mydata->role,'employee')==0){ echo "selected" ;} ?> >Employee</option>
     <option value="researcher" <?php if(strcasecmp($mydata->role,'researcher')==0){ echo "selected" ;} ?> >Researcher</option>
    </select>
      </div>
    </div>
             <div class="form-group">
      <label class="control-label col-sm-4 required">Username</label>
      <div class="col-sm-6">          
        <input type="text" name="username" class="form-control" value="<?php echo $mydata->username;?>" required>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-4 required">Sub Designation</label>
      <div class="col-sm-6">          
        <select class="form-control branch" name="subpost">
          <option value=""> Select </option>
          <?php 
          foreach($designation as $d){?>
            
           <option value="<?php echo $d->designation;?>" <?php if(strcasecmp($mydata->subpost,$d->designation)==0){ echo "selected" ;} ?> ><?php echo $d->designation;?></option>
           <?php }?>
        </select>
      </div>
     </div> 
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
	<!--<div class="form-group">
      <label class="control-label col-sm-4 ">Father's Name</label>
      <div class="col-sm-6">          
        <input type="text" name="father_name" class="form-control" value="<?php echo $mydata->father_name;?>"  >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">Address</label>
      <div class="col-sm-6">          
        <input type="text" name="address" class="form-control" value="<?php echo $mydata->address;?>"  >
      </div>
    </div>-->
	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </div>
</div> 
    <input type="hidden" value="<?php echo $mydata->employee_id;?>" name="employee_id">  
</form>
</div> 
