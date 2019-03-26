<html>
	<head>
	</head>
	<body>
<div class="container">
	<h3 class="student">Make Sells Order</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/insert_sell_order'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
  
 
  <div class="form-group">  
      <label class="control-label col-sm-4 ">Name</label>
      <div class="col-sm-2">
         <input type="text" name="first_name" class="form-control" value="<?php echo $mydata[0]->first_name;?>" readonly required> 
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" value="<?php echo $mydata[0]->middle_name;?>"readonly required >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" value="<?php echo $mydata[0]->last_name;?>"readonly required >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 required"> contact number</label>
      <div class="col-sm-6">          
        <input type="text" name="mobile" class="form-control" value="<?php echo $mydata[0]->mobile;?>" readonly required>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-4 "> email address </label>
      <div class="col-sm-6">          
        <input type="email" name="email" class="form-control" value="<?php echo $mydata[0]->email;?>"readonly required >
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-4 ">Next Follow Up Date</label>
      <div class="col-sm-6">          
        <input type="date" name="follow_up_date" class="form-control" value="<?php echo $mydata[0]->follow_up_date;?>" readonly required >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">Status</label>
		<div class="col-sm-6">          
			<select class="form-control branch" name="status">
			<option <?php if(strcasecmp($mydata[0]->status,"no status")==0){ echo "selected" ;} ?> value="no status">No Status</option>
			<option <?php if(strcasecmp($mydata[0]->status,"freetrial")==0){ echo "selected" ;} ?> value="freetrial">Free Trial</option>
			<option <?php if(strcasecmp($mydata[0]->status,"pending")==0){ echo "selected" ; } ?> value="pending">Pending</option>
			<option <?php if(strcasecmp($mydata[0]->status,"paid")==0){ echo "selected"; }  ?> value="paid">Paid</option>
			<option <?php if(strcasecmp($mydata[0]->status,"rejected")==0) {echo "selected" ;} ?> value="rejected">Rejected</option>
			<option <?php if(strcasecmp($mydata[0]->status,"interested")==0) {echo "selected" ;} ?> value="intrested">Interested</option>
            <option <?php if(strcasecmp($mydata[0]->status,"npc")==0) {echo "selected" ;} ?> value="npc">NPC</option>
		</select>
      </div>
      <br><br>
      <div class="form-group" style="align:center;" id="services">
			<label class="col-sm-3 ">Services</label>
			
			<br/><br/>
			<?php $i=1;$j=0;foreach($services  as $r){ $j++; ?><div class="col-sm-3"><input type="radio"  id="services<?php echo $i;?>" name="services<?php echo $i;?>" data-contact_avl="val" value="1" ><?php echo $r->service_name;?></div>
				<input type="hidden" name="ser_id<?php echo $i;?>" value="<?php echo $r->service_id;?>"/>
				
      
      
      <!--<label class="control-label col-sm-3 ">start Date of Service</label>
      <div class="col-sm-3">          
        <input type="date" name="start_date<?php echo $i; ?>" class="form-control" value="<?php echo $r->start_date;?>"  >
      </div>
   -->

     <!-- <label class="control-label col-sm-4 ">End Date of Service </label>
      <div class="col-sm-3">          
        <input type="date" name="end_date<?php echo $i++; ?>" class="form-control" value="<?php echo $r->end_date;?>" >
      
    </div><br/><br/><br/>-->
     <?php  } ?>
			
			
			
      
		</div>
      
      </div>
      
<div class="form-group">
      <label class="control-label col-sm-4 required">Start Date</label>
      <div class="col-sm-3">          
        <input type="date" name="start_date" class="form-control" value="<?php echo $mydata[0]->start_date; ?>" readonly required>
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-4 required">End Date</label>
      <div class="col-sm-3">          
        <input type="date" name="end_date" class="form-control" value="<?php echo $mydata[0]->end_date; ?>" readonly required>
      </div>
    </div>

    <input type="hidden" value="<?php echo $mydata[0]->client_id;?>" name="client_id">  
    <input type="hidden" value="<?php echo $i; ?>" name="nums">  
</form>
</div>
</body>
</html>
