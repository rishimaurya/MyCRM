<div class="col-sm-offset-4">
<h4 style="color:red;"><?php print_r($this->session->flashdata('error'));?></h4>
</div>
<div class="col-sm-offset-4">
<h4 style="color:green;"><?php print_r($this->session->flashdata('insert'));?></h4>
</div>
<div class="container">
	<h3 class="student">Register Lead</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/insert_leads'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
  
	<div class="form-group">
      <label class="control-label col-sm-4 required">Name</label>
      <div class="col-sm-2">
        <input type="text" name="first_name" class="form-control" placeholder=" name" required>
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" placeholder=" middle name" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" placeholder=" last name">
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
      <label class="control-label col-sm-4 required"> contact number</label>
      <div class="col-sm-6">          
        <input type="text" name="mobile" class="form-control" placeholder=" mobile number" required>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-4"> email address </label>
      <div class="col-sm-6">          
        <input type="email" name="email" class="form-control" placeholder="example@example.com">
      </div>
    </div>
    

    
     <div class="form-group">
      <label class="control-label col-sm-4">Call Back Date</label>
      <div class="col-sm-6">         	
     <input type="date" name="callback" class="form-control" >
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-4 ">Lead Status</label>
      <div class="col-sm-6">    
		   <select class="form-control state" name="leadstatus">
     <option value="0">--select--</option>
     <option value="no status">no status</option>
     <option value="freetrial">free trial</option>
    </select>      

      </div>
    </div>

	<div class="form-group">
		<label class="control-label col-sm-4 ">Trader's Experience</label>
      <div class="col-sm-6">          
         <select class="form-control state" name="traderexp">
			 <option value="0">--State--</option>
			 <option value="1">1</option>
			 <option value="2">2</option>
			 <option value="3">3</option>
			 <option value="4">4</option>
			  <option value="5">5</option>
			 <option value="6">6</option>
			 <option value="7">7</option>
			 <option value="8">8</option>
		   </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">Start Date</label>
      <div class="col-sm-6">          
        <input type="date" name="start_date" class="form-control" placeholder="Start Date" >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">End Date</label>
      <div class="col-sm-6">          
        <input type="date" name="end_date" class="form-control" placeholder="End Date" >
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-4 "> Description</label>
      <div class="col-sm-6">          
		  <textarea class="form-control state" name="description" ></textarea>
        <!--<input type="text" name="profession" class="form-control" placeholder="Profession"  >-->
      </div>
    </div>
    
    <div class="form-group">
			<label for="Services">Services</label><br>
			<?php if(!empty($services))
			{
				foreach($services  as $r){ ?><div class="col-sm-3"><input type="checkbox" name="services[]" value="<?php echo $r->service_id;?>" ><?php echo $r->service_name;?></div><?php }}else echo "No Services Available."; ?>
			
		</div>

    
	<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Register Lead</button>
      </div>
    </div>
</div> 
</div>   
</form>


</div>


