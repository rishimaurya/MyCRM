<html>
	<head>
	<script>
		 $(document).ready(function(){
	 var $cBox = $('#services input[type="checkbox"]');
	 var c = $('#services input[type="checkbox"]').length;
	 var netAmount = 0,charges = 0;var total;
     
     $('#discount').keyup(function(){
		 var service_amount = $('#subpost').val();
		     service_amount = service_amount*1;
		 var discount = $('#discount').val();
		     discount = discount*1;
		 var sub_net = service_amount - discount;
		 if(sub_net > 0)
		 {
			 $('#total').val(sub_net);
		 }else $('#total').val(0);
	 });
    
    $('#subpost').keyup(function(){
		 var service_amount = $('#subpost').val();
		     service_amount = service_amount*1;
		 var discount = $('#discount').val();
		     discount = discount*1;
		     
		 var sub_net = service_amount - discount;
		 if(sub_net > 0)
		 {
			 $('#total').val(sub_net);
		 }else $('#total').val(0);
	 });
	 
    $cBox.change(function(){
       
        for(i=1;i<=c;i++)
        { 
		   if($('#services'+i).is(':checked'))
			{
				var month = $('#period').val();
				    month = month*1;
				charges = $('#amount'+i).val();
				total = charges*1;
				total = total*month;
				netAmount = netAmount + total;
			}
		} 
		$('#subpost').val(netAmount);
		netAmount=0;
    });
    
    $('#period').change(function(){
       
        for(i=1;i<=c;i++)
        { 
		   if($('#services'+i).is(':checked'))
			{
				var month = $('#period').val();
				    month = month*1;
				charges = $('#amount'+i).val();
				total = charges*1;
				total = total*month;
				netAmount = netAmount + total;
			}
		} 
		$('#subpost').val(netAmount);
		netAmount=0;
    });

});
		</script>

	</head>
	<body>
<div class="container">
	<h3 class="student">Make Sales Order</h3>
	<p class="para">Note: (*) fields are mandatory</p>
<form name="leadRegisterForm" class="form-horizontal" action="<?php echo base_url('Leads/insert_sell_order'); ?>"  onsubmit="return validateLeadRegisterForm()" method="POST">
<div class="myjumbo">
  
	<div class="form-group">  
      <label class="control-label col-sm-4 ">Name</label>
      <div class="col-sm-2">
        <input type="text" name="first_name" class="form-control" value="<?php echo $mydata[0]->first_name;?>" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="middle_name" class="form-control" value="<?php echo $mydata[0]->middle_name;?>" >
      </div>
	  <div class="col-sm-2">
        <input type="text" name="last_name" class="form-control" value="<?php echo $mydata[0]->last_name;?>" >
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
        <input type="email" name="email" class="form-control" value="<?php echo $mydata[0]->email;?>" >
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-4 ">Next Follow Up Date</label>
      <div class="col-sm-6">          
        <input type="date" name="follow_up_date" class="form-control" value="<?php echo $mydata[0]->follow_up_date;?>"  >
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4 ">Status</label>
		<div class="col-sm-6">          
			<select class="form-control branch" name="status">
			<option  value="paid">Paid</option>
					</select>
      </div>
      <div class="form-group" style="align:center;" id="services">
			<label class="col-sm-3 ">Services</label><br/><br/>
			<?php $i=1;$j=0;foreach($services  as $r){ $j++; ?><div class="col-sm-3"><input type="checkbox"  id="services<?php echo $i;?>" name="services<?php echo $i;?>" data-contact_avl="val" value="1" ><?php echo $r->service_name;?></div>
				<input type="hidden" name="ser_id<?php echo $i;?>" value="<?php echo $r->service_id;?>"/>
				<input type="hidden" id="amount<?php echo $i; ?>" name="ser_amount<?php echo $i++;?>" value="<?php echo $r->service_amount;?>"/>
     <?php  } ?>
		</div>
      </div>
      <!--<label class="control-label col-sm-3 ">start Date of Service</label>
      <div class="col-sm-3">          
        <input type="date" name="start_date<?php echo $i; ?>" class="form-control"  >
      </div>-->
   

     <!-- <label class="control-label col-sm-4 ">End Date of Service </label>
      <div class="col-sm-3">          
        <input type="date" name="end_date<?php echo $i++; ?>" class="form-control" >
      
    </div>-->
          <div class="form-group">
      <label class="control-label col-sm-4 ">Period</label>
		<div class="col-sm-6">          
			<select class="form-control branch" name="period" id ="period">
			<option  value="1">Monthly</option>
			<option  value="3">Quaterly</option>
			<option  value="6">Half Yearly</option>
			<option  value="12">Yearly</option>
			
		</select>
      </div>
      <br><br>
      
      
    <div class="form-group">
      <label class="control-label col-sm-4 required"> Services Amount:</label>
      <div class="col-sm-3">          
        <input type="text" name="service_amount" id="subpost" class="form-control" value="<?php // echo $mydata[0]->service_amount;?>" required>
      </div>
    </div>
   
	  <div class="form-group">
      <label class="control-label col-sm-4 required"> Discount</label>
      <div class="col-sm-3">          
        <input type="text" name="discount" class="form-control" placeholder="Discount" id="discount"  required>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-4 required"> Net Payment </label>
      <div class="col-sm-3">          
        <input type="text" name="total" class="form-control" placeholder="Discount" id="total" required>
      </div>
    </div>
    
		 <div class="form-group">
		
      <label class="control-label col-sm-4 required">Payment Mode</label>
      <div class="col-sm-3">          
        <select type="date" name="mode" class="form-control">
		     <option value="">-- Select --</option>
		     <option value="cash">Cash</option>
		     <option value="debitcard">Debit Card</option>
		     <option value="creditcard">Credit Card</option>
		     <option value="netbanking">Net Banking</option>
		     <option value="wallet">Wallets</option>
	     <option value="website">Website</option>		     
		</select>	
      </div>
    </div>
<div class="form-group">
      <label class="control-label col-sm-4 required">Payment Date</label>
      <div class="col-sm-3">          
        <input type="date" name="date" class="form-control"  required>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-4 required">Start Date</label>
      <div class="col-sm-3">          
        <input type="date" name="start_date" class="form-control"  required>
      </div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-4 required">End Date</label>
      <div class="col-sm-3">          
        <input type="date" name="end_date" class="form-control"  required>
      </div>
    </div>
<div class="form-group">        
      <div class="col-sm-offset-8 col-sm-2">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
</div> 
    <input type="hidden" value="<?php echo $mydata[0]->client_id;?>" name="client_id">  
    <input type="hidden" value="<?php echo $i; ?>" name="nums">  
</form>
</div>
</body>
</html>
