<div class="container">
	<div class="col-sm-offset-4">	
		<p class="para"><?php print_r($this->session->flashdata('error'));?>	</p>
	</div>
	<h3 class="student">Generate Sales Order</h3>
	<p class="para">Note: (*) fields are mandatory</p>
	
	<form  action="<?php echo base_url('Leads/search_mobile');?>" class="form-search" method="POST">
								<label >Mobile Tracker</label>&nbsp;&nbsp;
								<span class="input-icon">
									<input type="text" placeholder="track anyone....." class="nav-search-input" name="mobile" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>

<!--<form name="changePassword" class="form-horizontal" action="<?php echo base_url('Leads/insert_sell_order'); ?>"  onsubmit="return updatePassword()" method="POST">
<div class="myjumbo" >
 <div class="form-group">
      <label class="control-label col-sm-4">Client Name:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->first_name. " ".$data[0]->last_name; ?> </label>
		</p>
		</div>   
  <br><br>
<div class="form-group">
      <label class="control-label col-sm-4">Client Mobile:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->mobile; ?> </label>
		</p>
		</div>      
		<br><br>
	<div class="form-group">
      <label class="control-label col-sm-4">Follow Up Date:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data[0]->follow_up_date; ?> </label>
		</p>
		</div>      
		<br><br>	
		<div class="form-group">
      <label class="control-label col-sm-4">Services:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data1[0]->service_name; ?> </label>
		</p>
		</div>    
		<br><br>
		   <div class="form-group">
      <label class="control-label col-sm-4">Services Amount:</label>
      <div class="col-sm-3">
    <label class="control-label">  <p><?php echo $data1[0]->service_amount; ?> </label>
		</p><input type="hidden" name="amount" value="<?php echo $data1[0]->service_amount; ?>" />
		</div>    
    </div><input type="hidden" name="client_id" value="<?php echo $data[0]->client_id; ?>" />
	<div class="form-group">
      <label class="control-label col-sm-4 required"> Discount</label>
      <div class="col-sm-3">          
        <input type="text" name="discount" class="form-control" placeholder="Discount"  required>
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
      <div class="col-sm-offset-4 col-sm-2">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
</div>   
 </form>-->


</div>

