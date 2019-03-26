<div class="container">
	<div class="col-sm-offset-4">	
		<p class="para"><?php print_r($this->session->flashdata('error'));?>	</p>
	</div>
<form name="changePassword" class="form-horizontal" action="<?php echo base_url('ViewEmployee/admin_resets_password'); ?>"  onsubmit="return updatePassword()" method="POST">
<div class="myjumbo" >
  
	<div class="form-group">
      <label class="control-label col-sm-4">Username:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php $row=$this->session->userdata('my_session'); if(!empty($user[0]->username)) { echo $user[0]->username;}else {
			 echo ucfirst($row['username']) ;} ?> </label>
		</p>
		</div>          
    </div><input type="hidden" name="employee_id" value="<?php if(!empty($user[0]->employee_id)) echo $user[0]->employee_id;else {
			 echo $row['employee_id'] ;} ?>" />
	<div class="form-group">
      <label class="control-label col-sm-4 required"> New Password</label>
      <div class="col-sm-3">          
        <input type="password" name="new_pswd" class="form-control" placeholder="atleast 6 characters"  required>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 required"> Confirm Password</label>
      <div class="col-sm-3">          
        <input type="password" name="new_pswd1" class="form-control" placeholder=" confirm password"  required>
      </div>
    </div>
	
    <div class="form-group">        
      <div class="col-sm-offset-4 col-sm-2">
        <button type="submit" class="btn btn-success">Change Password</button>
      </div>
    </div>
</div>   
 </form>


</div>

