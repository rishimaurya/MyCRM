<div class="container">
	
	
<form name="updateProfileForm" class="form-horizontal" action="<?php echo base_url('Manager/update_profile'); ?>"  onsubmit="return validateUpdateProfileForm()" method="POST">
<div class="myjumbo" >
  <div class="form-group">
      <label class="control-label col-sm-4">Role:</label>
	  <div class="col-sm-6">
         <p><?php $row=$this->session->userdata('my_session');echo $row['role'];?></p>
		</div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4">Username:</label>
      <div class="col-sm-6">
      <p><?php $row=$this->session->userdata('my_session');
			echo $row['username'];?>
		</p>
		</div>          
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-4 required"> Name</label>
      <div class="col-sm-2">
        <input type="text" name="first_name" class="form-control" placeholder=" name"  value="<?php $row=$this->session->userdata('my_session');echo $row['first_name'];?>" required>
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" placeholder=" middle name" value="<?php $row=$this->session->userdata('my_session');echo $row['middle_name'];?>" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" placeholder=" last name" value="<?php $row=$this->session->userdata('my_session');echo $row['last_name'];?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> Date of Birth</label>
      <div class="col-sm-6">          
        <input type="date" name="dob" class="form-control" placeholder="yyyy-mm-dd" value="<?php $row=$this->session->userdata('my_session');echo $row['dob'];?>" required>
      </div>
    </div>
	
     <div class="form-group">
      <label class="control-label col-sm-4 required">Date of Joining  </label>
      <div class="col-sm-6">          
        <p><?php $row=$this->session->userdata('my_session');
			echo $row['doj'];?>
		</p>
      </div>
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-4 required">Gender:  </label>
      <div class="col-sm-6">          
        <p><?php $row=$this->session->userdata('my_session');
			echo $row['gender'];?>
		</p>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> Father's name</label>
      <div class="col-sm-6">          
        <input type="text" name="fname" class="form-control" placeholder=" father's name" value="<?php $row=$this->session->userdata('my_session');echo $row['father_name'];?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> contact number</label>
      <div class="col-sm-6">          
        <input type="text" name="mobile" class="form-control" placeholder=" mobile number" value="<?php $row=$this->session->userdata('my_session');echo $row['mobile'];?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> email address </label>
      <div class="col-sm-6">          
        <input type="email" name="email" class="form-control" placeholder="example@example.com" value="<?php $row=$this->session->userdata('my_session');echo $row['email'];?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">Address</label>
      <div class="col-sm-6">          
        <input type="text" name="address" class="form-control" placeholder=" address line1" value="<?php $row=$this->session->userdata('my_session');echo $row['address'];?>"  >
      </div>
    </div>
	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Update Profile</button>
      </div>
    </div>
</div> 
</div>   
 </form>


</div>

