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
      <label class="control-label col-sm-4 required"> name</label>
      <div class="col-sm-2">
        <input type="text" name="first_name" class="form-control" placeholder=" name" required>
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" placeholder=" middle name" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" placeholder=" last name" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> date of birth</label>
      <div class="col-sm-6">          
        <input type="date" name="dob" class="form-control" placeholder="yyyy-mm-dd" required>
      </div>
    </div>
	
     <div class="form-group">
      <label class="control-label col-sm-4 required">date of Joining  </label>
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
      <label class="control-label col-sm-4 required"> father's name</label>
      <div class="col-sm-6">          
        <input type="text" name="fname" class="form-control" placeholder=" father's name" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> contact number</label>
      <div class="col-sm-6">          
        <input type="text" name="mobile" class="form-control" placeholder=" mobile number" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> email address </label>
      <div class="col-sm-6">          
        <input type="email" name="email" class="form-control" placeholder="example@example.com" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">address line1</label>
      <div class="col-sm-6">          
        <input type="text" name="address1" class="form-control" placeholder=" address line1"  >
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 "> address line2</label>
      <div class="col-sm-6">          
        <input type="text" name="address2" class="form-control" placeholder=" address line2"  >
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 "> City</label>
      <div class="col-sm-6">          
        <input type="text" name="city" class="form-control" placeholder=" City"  >
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 "> Pincode</label>
      <div class="col-sm-6">          
        <input type="text" name="pincode" class="form-control" placeholder=""  >
      </div>
    </div>
	<div class="form-group">
		<label class="control-label col-sm-4 ">State</label>
      <div class="col-sm-6">          
         <select class="form-control branch" name="state">
			 <option value="0">--State--</option>
			 <option value="Andhra Pradesh">Andhra Pradesh</option>
			 <option value="Arunachal Pradesh">Arunachal Pradesh</option>
			 <option value="Assam ">Assam </option>
			 <option value="">Bihar</option>
			 <option value="Bihar">Chhattisgarh</option>
			 <option value="Delhi">Delhi</option>
			 <option value="Goa">Goa</option>
			 <option value="Gujrat">Gujrat</option>
			 <option value="Haryana">Haryana</option>
			 <option value="Himachal Pradesh">Himachal Pradesh</option>
			 <option value="Jammu & Kashmir">Jammu & Kashmir</option>
			 <option value="Jharkhand">Jharkhand</option>
			 <option value="Karnataka">Karnataka</option>
			 <option value="Kerala">Kerala</option>
			 <option value="Madhya Pradesh">Madhya Pradesh</option>
			 <option value="Maharashtra">Maharashtra</option>
			 <option value="Manipur">Manipur</option>
			 <option value="Meghlaya">Meghlaya</option>
             <option value="Mizoram">Mizoram</option>
			 <option value="Nagaland">Nagaland</option>
			 <option value="Odisha">Odisha</option>
			 <option value="Punjab">Punjab</option>
			 <option value="Sikkim">Sikkim</option>
			 <option value="Tamil Nadu">Tamil Nadu</option>
			 <option value="Telangana">Telangana</option>                    
			 <option value="Tripura">Tripura</option>
			 <option value="Uttar Pradesh">Uttar Pradesh</option>
			 <option value="Uttarakhand">Uttarakhand</option>
			 <option value="West Bengal">West Bengal</option>
			 <option value="Union territory">Union territory </option>
		   </select>
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 "> Profession</label>
      <div class="col-sm-6">          
        <input type="text" name="address" class="form-control" placeholder="Profession"  >
      </div>
    </div>
	
	
	
	 <div class="form-group">
      <label class="control-label col-sm-4 required"> password </label>
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

