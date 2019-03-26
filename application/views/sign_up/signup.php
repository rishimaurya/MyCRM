<div class="container">
	<h3 class="student">Please Register Yourself</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="insertForm" class="form-horizontal" action="<?php echo base_url('signup/insert'); ?>"  onsubmit="return validateInsertForm()" method="POST">
<div class="myjumbo" >
  <div class="form-group">
      <label class="control-label col-sm-4 required">Register yourself as</label>
      <div class="col-sm-6">          
        <select class="form-control branch" name="user">
     <option value="0">--select--</option>
     <option value="manager">manager</option>
     <option value="employee">employee</option>
    </select>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 required">Create Username</label>
      <div class="col-sm-6">          
        <input type="text" name="username" class="form-control" placeholder="username" required>
      </div>          
	  <?php if($msg=="username already exist")?>
	    <p style="color:red"><?php	echo $msg;?></p>
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-4 required">Enter your name</label>
      <div class="col-sm-2">
        <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" placeholder="Enter middle name" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required">Enter your date of birth</label>
      <div class="col-sm-6">          
        <input type="date" name="dob" class="form-control" placeholder="yyyy-mm-dd" required>
      </div>
    </div>
	
     <div class="form-group">
      <label class="control-label col-sm-4 required">Enter your date of Joining  </label>
      <div class="col-sm-6">          
        <input type="date" name="doj" class="form-control" placeholder="yyyy-mm-dd" required>
      </div>
    </div>
	
    <div class="form-group">
      <label class="control-label col-sm-4 required">Gender:  </label>
      <div class="col-sm-6">          
        <input type="radio" name="gender" value="male" checked>&nbsp;Male&nbsp;&nbsp;&nbsp;
		<input type="radio" name="gender" value="female">&nbsp;Female
     </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required">Enter your father's name</label>
      <div class="col-sm-6">          
        <input type="text" name="fname" class="form-control" placeholder="Enter your father's name" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required">Enter your contact number</label>
      <div class="col-sm-6">          
        <input type="text" name="mobile" class="form-control" placeholder="Enter mobile number" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required">Enter your email address </label>
      <div class="col-sm-6">          
        <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required">Enter your address line1</label>
      <div class="col-sm-6">          
        <input type="text" name="address" class="form-control" placeholder="Enter your address" required >
      </div>
    </div>
	
	
	 <div class="form-group">
      <label class="control-label col-sm-4 required">Enter password </label>
      <div class="col-sm-6">          
        <input type="password" name="password" class="form-control" placeholder="atleast 6 characters" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required">Confirm password  </label>
      <div class="col-sm-6">          
        <input type="password" name="password2" class="form-control" placeholder="confirm password">
      </div>
    </div>
	
    <div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Register me</button>
      </div>
    </div>
</div> 
</div>   
 </form>


</div>

