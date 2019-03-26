<div class="container">
	<h3 class="student">Update Lead</h3>
	<p class="para">Note: (*) fields are mandatory</p>
	
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/update_leads'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
  
	<div class="form-group">
      <label class="control-label col-sm-4 ">Name</label>
      <div class="col-sm-2">
        <input type="text" name="first_name" class="form-control" value="<?php echo $mydata->first_name;?>" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" value="<?php echo $mydata->middle_name;?>" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" value="<?php echo $mydata->last_name;?>" >
      </div>
    </div>
    
	
    <div class="form-group">
      <label class="control-label col-sm-4 ">Gender</label>
		<div class="col-sm-6">          
			<select class="form-control branch" name="gender">
			<option <?php if(strcasecmp($mydata->gender,"Male")==0){ echo "selected" ;} ?> value="Male">Male</option>
			<option <?php if(strcasecmp($mydata->gender,"Female")==0){ echo "selected" ; } ?> value="Female">Female</option>
			</select>
			
      </div>
	  </div> 
	
    
    <div class="form-group">
      <label class="control-label col-sm-4 required"> contact number</label>
      <div class="col-sm-6">          
        <input type="text" name="mobile" class="form-control" value="<?php echo $mydata->mobile;?>" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 "> email address </label>
      <div class="col-sm-6">          
        <input type="email" name="email" class="form-control" value="<?php echo $mydata->email;?>" >
      </div>
    </div>

   <!--  <div class="form-group">
      <label class="control-label col-sm-4 ">Call Back Date</label>
      <div class="col-sm-6">-->         
		  <!-- <select class="form-control branch" name="user">
     <option value="0">--select--</option>
     <option value="manager">manager</option>
     <option value="employee">employee</option>
    </select> -->
 <!--    <input type="date" name="callback" class="form-control" >
      </div>
    </div>
-->	<!--<div class="form-group">
      <label class="control-label col-sm-4 "> Response</label>
      <div class="col-sm-6">        
		   <select class="form-control state" name="response">
     <option value="0">--select--</option>
     <option value="manager">manager</option>
     <option value="employee">employee</option>
    </select>  -->
       <!-- <input type="text" name="address2" class="form-control" placeholder=" address line2"  >-->
     <!-- </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 ">Lead Status</label>
      <div class="col-sm-6">    
		   <select class="form-control state" name="leadstatus">
     <option value="0">--select--</option>
     <option value="manager">manager</option>
     <option value="employee">employee</option>
    </select>      -->
       <!-- <input type="text" name="city" class="form-control" placeholder=" City"  >
      </div>
    </div>-->
	<!--<div class="form-group">
      <label class="control-label col-sm-4 "> Trader's Profile</label>
      <div class="col-sm-6">          
		   <select class="form-control state" name="traderprofile">
     <option value="0">--select--</option>
     <option value="manager">manager</option>
     <option value="employee">employee</option>
    </select>-->
        <!--<input type="text" name="pincode" class="form-control" placeholder=""  >-->
      <!--</div>
    </div>
	<div class="form-group">
		<label class="control-label col-sm-4 ">Trader's Experience</label>
      <div class="col-sm-6">          
         <select class="form-control state" name="traderexp">
			 <option value="0">--State--</option>
			 <option value="Andhra Pradesh">Andhra Pradesh</option>
			 <option value="Arunachal Pradesh">Arunachal Pradesh</option>
			 <option value="Assam ">Assam </option>
			 <option value="">Bihar</option>
		   </select>
      </div>
    </div>-->
	<!--<div class="form-group">
      <label class="control-label col-sm-4 "> Description</label>
      <div class="col-sm-6">          
		  <textarea class="form-control state" name="description" ></textarea>
        <input type="text" name="profession" class="form-control" placeholder="Profession"  >
      </div>
    </div>-->
   <!-- <div class="form-group">
      <label class="control-label col-sm-4 ">Address</label>
      <div class="col-sm-6">          
        <input type="text" name="address" class="form-control" value="<?php echo $mydata->address;?>"  >
      </div>
    </div>
	
	
	<div class="form-group">
      <label class="control-label col-sm-4 ">Profession</label>
      <div class="col-sm-6">          
        <input type="text" name="profession" class="form-control" value="<?php echo $mydata->profession;?>"  >
      </div>
    </div>-->
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
			<option <?php if(strcasecmp($mydata->status,"freetrial")==0){ echo "selected" ;} ?> value="freetrial">Free Trial</option>
			<option <?php if(strcasecmp($mydata->status,"switchoff")==0){ echo "selected" ; } ?> value="switchoff">Switch Off</option>
			
			<option <?php if(strcasecmp($mydata->status,"busy")==0) {echo "selected" ;} ?> value="busy">Busy</option>
			<option <?php if(strcasecmp($mydata->status,"interested")==0) {echo "selected" ;} ?> value="interested">Interested</option>
            <option <?php if(strcasecmp($mydata->status,"npc")==0) {echo "selected" ;} ?> value="npc">NPC</option>
            <option <?php if(strcasecmp($mydata->status,"notinterested")==0) {echo "selected" ;} ?> value="notinterested">Not Interested</option>
            
            <option value="does not trade" <?php if(strcasecmp($mydata->status,"does not trade")==0) {echo "selected" ;} ?>>Does not Trade</option>
     <option value="callback" <?php if(strcasecmp($mydata->status,"callback")==0) {echo "selected" ;} ?>>Callback</option>
     <option value="junk" <?php if(strcasecmp($mydata->status,"junk")==0) {echo "selected" ;} ?>>Junk</option>
		</select>
      </div>
	  </div>
	  <div class="form-group">
      <label class="control-label col-sm-4 ">Investment</label>
		<div class="col-sm-3">          
			<select class="form-control branch" name="investment">
		        <option value=""> -- Select -- </option>
		        <option <?php if(strcasecmp($mydata->investment,"0 - 50,000")==0){ echo "selected" ;} ?> value="0 - 50,000">0 - 50,000</option>
		        <option <?php if(strcasecmp($mydata->investment,"50,000 - 1,50,000")==0){ echo "selected" ;} ?>  value="50,000 - 1,50,000">50,000 - 1,50,000</option>
		        <option <?php if(strcasecmp($mydata->investment,"1,50,000 - 3,00,000")==0){ echo "selected" ;} ?> value="1,50,000 - 3,00,000">1,50,000 - 3,00,000</option>
		        <option <?php if(strcasecmp($mydata->investment,"3,00,000 - 5,00,000")==0){ echo "selected" ;} ?> value="3,00,000 - 5,00,000">3,00,000 - 5,00,000</option>
		        <option <?php if(strcasecmp($mydata->investment,"5,00,000 - 10,00,000")==0){ echo "selected" ;} ?> value="5,00,000 - 10,00,000">5,00,000 - 10,00,000</option>
		        <option <?php if(strcasecmp($mydata->investment,"above 10,00,000")==0){ echo "selected" ;} ?> value="above 10,00,000">Above 10,00,000</option>		        
		    </select>
	    </div>
	   </div>
	  <div class="form-group">
      <label class="control-label col-sm-4 ">Calling Status</label>
		<div class="col-sm-6">          
			<select class="form-control branch" name="call">
		        <option value="1">Called</option>
		        <option value="0">Not Called</option>		        
		    </select>
	    </div>
	   </div> 
	  <div class="form-group">
      <label class="control-label col-sm-4 ">Start Date</label>
      <div class="col-sm-6">          
        <input type="date" name="start_date" class="form-control" value="<?php echo $mydata->start_date;?>" >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">End Date</label>
      <div class="col-sm-6">          
        <input type="date" name="end_date" class="form-control" value="<?php echo $mydata->end_date;?>" >
      </div>
    </div>
		<div class="form-group">
			<label for="comment">Description:</label>
			<textarea name="comment" class="form-control" rows="5" id="comment"><?php foreach($comment as $c){ echo $c->comment;}?></textarea>
		</div>
		
		<div class="form-group">
			<label for="Services">Services</label><br>
			<?php foreach($result  as $r){ ?><div class="col-sm-3"><input type="checkbox" name="services[]"  <?php foreach($client_services as $cs) { if(strcasecmp($r->service_id,$cs->service_id)==0) echo "checked"; } ?>  value="<?php echo $r->service_id;?>" ><?php echo $r->service_name;?></div><?php } ?>
			
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
